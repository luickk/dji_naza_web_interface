# Dji Naza Webinterface
A webinterface for the Naza V2 flight controller which is built on top of the [Naza V2 C++ Interface](https://github.com/MrGrimod/dji_naza_interface_c-) project and uses the it's tools/ binaries to access the Naza. It's based on PHP and Js Ajax, the PHP scripts directly access the binaries compiled by the core project.<br>

To use core command interface you need to install sudo and add <br>
the www-data user to sudoers file as root permitted. <br>
`/etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL` - only for debugging purposes <br>

And chown the main dir to www-data (php) user <br>
`sudo chown -R www-data:www-data dji_naza_web_interface/` <br>

Also you have to compile the tools/ binaries from the <br>
[Naza V2 C++ interface](https://github.com/MrGrimod/dji_naza_interface_c-) and move them to the bins/ folder. <br>


## Dependecies:
### Camera livestream (python3): <br>
-opencv  <br>
-picamera

### Webinterface:
-PHP  <br>
-Apache2  <br>
-sudo 
