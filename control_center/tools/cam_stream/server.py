#!/usr/bin/env python

import sys
import io
import os
import shutil
import datetime
import cv2
import numpy as np
import queue as queue
from subprocess import Popen, PIPE
from string import Template
from struct import Struct
from threading import Thread
from time import sleep, time
from http.server import HTTPServer, BaseHTTPRequestHandler
from wsgiref.simple_server import make_server
import time
import collections
import picamera

from ws4py.websocket import WebSocket
from ws4py.server.wsgirefserver import (
    WSGIServer,
    WebSocketWSGIHandler,
    WebSocketWSGIRequestHandler,
)
from ws4py.server.wsgiutils import WebSocketWSGIApplication

###########################################
# CONFIGURATION
WIDTH = 640
HEIGHT = 480
FRAMERATE = 20
WS_PORT = 8084
RECORDINGS_PATH = "/var/www/html/dji_naza_web_interface/control_center/tools/recordings/"
COLOR = u'#444'
BGCOLOR = u'#333'
JSMPEG_MAGIC = b'jsmp'
JSMPEG_HEADER = Struct('>4sHH')
VFLIP = True
HFLIP = True

###########################################

def convertYUV(stream):
    fwidth = (WIDTH + 31) // 32 * 32
    fheight = (HEIGHT + 15) // 16 * 16
    A = np.frombuffer(stream, dtype=np.uint8)
    Y = A[:fwidth*fheight]
    U = A[fwidth*fheight:fwidth*fheight+(fwidth//2)*(fheight//2)]
    V = A[fwidth*fheight+(fwidth//2)*(fheight//2):]
    Y = Y.reshape((fheight, fwidth))
    U = U.reshape((fheight//2, fwidth//2))
    V = V.reshape((fheight//2, fwidth//2))

    U = cv2.resize(U, (fwidth,fheight), interpolation = cv2.INTER_NEAREST )
    V = cv2.resize(V, (fwidth,fheight), interpolation = cv2.INTER_NEAREST )
    YUV = (np.dstack([Y,U,V])).astype(np.uint8)
    RGB = cv2.cvtColor(YUV, cv2.COLOR_YUV2RGB, 3)

    return RGB

class StreamingWebSocket(WebSocket):
    def opened(self):
        self.send(JSMPEG_HEADER.pack(JSMPEG_MAGIC, WIDTH, HEIGHT), binary=True)

class BroadcastOutput(object):
    def __init__(self, camera, q):
        print('Spawning background conversion process')
        self.q = q
        self.converter = Popen([
            'ffmpeg',
            '-f', 'rawvideo',
            '-pix_fmt', 'yuv420p',
            '-s', '%dx%d' % camera.resolution,
            '-r', str(float(camera.framerate)),
            '-i', '-',
            '-f', 'mpeg1video',
            '-b', '800k',
            '-r', str(float(camera.framerate)),
            '-'],
            stdin=PIPE, stdout=PIPE, stderr=io.open(os.devnull, 'wb'),
            shell=False, close_fds=True)

    def write(self, b):
        self.converter.stdin.write(b)
        self.q.append(b)
    def flush(self):
        print('Waiting for background conversion process to exit')
        self.converter.stdin.close()
        self.converter.wait()


class BroadcastThread(Thread):
    def __init__(self, converter, websocket_server, q):
        super(BroadcastThread, self).__init__()
        self.converter = converter
        self.websocket_server = websocket_server

    def run(self):
        try:
            while True:
                buf = self.converter.stdout.read1(32768)
                if buf:
                    self.websocket_server.manager.broadcast(buf, binary=True)
                elif self.converter.poll() is not None:
                    break
        finally:
            self.converter.stdout.close()

class RecordThread(Thread):
    def __init__(self, q):
        Thread.__init__(self)
        self.q = q
        print("Starting recording thread")
        self.vidw = cv2.VideoWriter(time.strftime(RECORDINGS_PATH + "%Y-%m-%d %H:%M:%S", time.gmtime())+'-output.avi', cv2.VideoWriter_fourcc(*'XVID'), FRAMERATE, (WIDTH, HEIGHT))
        self.killb=False

    def run(self):
        while True:
            try:
                b = self.q.pop()
                self.vidw.write(convertYUV(b))
            except IndexError:
                pass
            if self.killb:
                break

    def kill(self):
        self.killb = True

def main():
    print('Initializing camera')
    with picamera.PiCamera() as camera:
        camera.resolution = (WIDTH, HEIGHT)
        camera.framerate = FRAMERATE
        camera.vflip = VFLIP # flips image rightside up, as needed
        camera.hflip = HFLIP # flips image left-right, as needed
        sleep(1) # camera warm-up time
        print('Initializing websockets server on port %d' % WS_PORT)
        WebSocketWSGIHandler.http_version = '1.1'
        websocket_server = make_server(
            '', WS_PORT,
            server_class=WSGIServer,
            handler_class=WebSocketWSGIRequestHandler,
            app=WebSocketWSGIApplication(handler_cls=StreamingWebSocket))
        websocket_server.initialize_websockets_manager()
        websocket_thread = Thread(target=websocket_server.serve_forever)
        print('Initializing broadcast thread')
        q = collections.deque()
        output = BroadcastOutput(camera, q)
        broadcast_thread = BroadcastThread(output.converter, websocket_server, q)
        print('Starting recording')
        camera.start_recording(output, 'yuv')
        record_thread = RecordThread(q)
        try:
            print('Starting websockets thread')
            websocket_thread.start()
            print('Starting broadcast thread')
            broadcast_thread.start()
            print('Starting file recording thread')
            record_thread.start()

            while True:
                camera.wait_recording(1)
        except KeyboardInterrupt:
            pass
        finally:
            record_thread.kill()
            print('Waiting for websockets thread to finish')
            print('Stopping recording')
            camera.stop_recording()
            print('Waiting for broadcast thread to finish')
            broadcast_thread.join()
            print('Shutting down websockets server')
            websocket_server.shutdown()
            print('Waiting for recording to shutdown')
            websocket_thread.join()


if __name__ == '__main__':
    main()
