<?php

/* To use read takeoff Pos interface you need to install sudo and add
   the www-data user to sudoers file as root permitted.
   /etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL

   Also you have to compile the takeoff Pos tool from the
   Naza V2 interface main repository. And add the resulting binary as ccontrol.exe
   to this directory.
   */

$PATH = 'nazaTakeOfPos/';

$jsondata = file_get_contents($PATH.'pos.json');
$json = json_decode($jsondata, true);

echo $json[0].','.$json[1].','.$json[2].','.$json[3].','.$json[4];

?>
