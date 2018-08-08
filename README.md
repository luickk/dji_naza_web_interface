# Dji Naza Web Interface
A web interface for the Naza V2 flight controller. <br>

To use core command interface you need to install sudo and add <br>
the www-data user to sudoers file as root permitted. <br>
`/etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL` - only for debugging purposes <br>

And chown the main dir to www-data (php) user <br>
`sudo chown -R www-data:www-data dji_naza_web_interface/` <br>

Also you have to compile the core_control example/tool from the <br>
Naza V2 interface [main repository](https://github.com/MrGrimod/dji_naza_interface_c-). <br>
And add the resulting binary as ccontrol.exe to this directory.

## Dependecies:
### Cam (python3):
-opencv
-picamera
