<?php

/* To use gps recalibrate you need to install sudo and add
   the www-data user to sudoers file as root permitted.
   /etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL

   Also you have to compile the recalibrate tool from the
   Naza V2 interface main repository. And add the resulting binary as ccontrol.exe
   to this directory.
   */

echo shell_exec ("sudo ./bins/recalibrate.exe");
?>
