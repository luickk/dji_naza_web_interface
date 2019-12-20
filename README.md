# Dji Naza Webinterface
A webinterface for the Naza V2 flight controller. The webinterface is built on top of the [Naza V2 C++ Interface](https://github.com/MrGrimod/dji_naza_interface_c-) project. The binaries required for the webinterface can be compiled with the given tools in ´Naza V2 C++ Interface/tools/binaries´. This project is based on PHP and JavaScript Ajax, the PHP scripts directly accesses the binaries compiled by the [core project](https://github.com/MrGrimod/dji_naza_interface_c-).<br>

## Installation

To use the web interface you needto  add <br>
the www-data user to sudoers file as root permitted. <br>
`/etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL` - only for debugging purposes <br>

And chown the main dir to www-data (php) user <br>
`sudo chown -R www-data:www-data dji_naza_web_interface/` <br>

You also have to compile the tools/binaries from the <br>
[Naza V2 C++ interface project](https://github.com/MrGrimod/dji_naza_interface_c-) and move the compiled binary to bins/ccontrol.exe . <br>

## Demo Video:
https://www.youtube.com/watch?v=JNzVcIv4pL8

## Dependecies:
### Camera livestream (python3): <br>
-opencv  <br>
-picamera

### Webinterface:
-PHP  <br>
-Apache2  <br>
-sudo 
