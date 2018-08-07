<?php

/* To use gps interface you need to install sudo and add
   the www-data user to sudoers file as root permitted.
   /etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL

   Also you have to compile the gps tool from the
   Naza V2 interface main repository. And add the resulting binary as ccontrol.exe
   to this directory.
   */

$alt = $_GET["alt"];
$heading = $_GET["heading"];
$lat = $_GET["lat"];
$lon = $_GET["lon"];
$numsat = $_GET["numsat"];
$all = $_GET["all"];

$raw_gps_data = shell_exec ("sudo ./bins/rgps.exe");
$gps_data = explode(",", $raw_gps_data);

if($alt!=""){
  echo $gps_data[4];
} else if($heading!=""){
  echo $gps_data[3];
} else if($lat!=""){
  echo $gps_data[2];
} else if($lon!=""){
  echo $gps_data[1];
} else if($numsat!=""){
  echo $gps_data[0];
} else if($all!=""){
  echo $raw_gps_data;
}
?>
