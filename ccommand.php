<?php

/* To use core command interface you need to install sudo and add
   the www-data user to sudoers file as root permitted.
   /etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL

   Also you have to compile the core_control example/tool from the
   Naza V2 interface main repository. And add the resulting binary as ccontrol.exe
   to this directory.
   */

$forward = $_GET["forward"];
$back = $_GET["back"];
$throttle = $_GET["throttle"];
$left = $_GET["left"];
$right = $_GET["right"];
$tright = $_GET["tright"];
$tleft = $_GET["tleft"];
$flm = $_GET["flm"];
$arm = $_GET["arm"];
$neutral = $_GET["neutral"];

if($forward!=""){
  echo "forward with $forward \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe forward $forward");
} else if($back!=""){
  echo "back with $back \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe back $back");
} else if($throttle!=""){
  echo "throttle with $throttle \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe throttle $throttle");
} else if($left!=""){
  echo "left with $left \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe left $left");
} else if($right!=""){
  echo "right with $right \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe right $right");
} else if($tright!=""){
  echo "tright with $tright \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe tright $tright");
} else if($tleft!=""){
  echo "tleft with $tleft \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe tleft $tleft");
} else if($flm!=""){
  echo "flm with $flm \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe flm $flm");
} else if($arm!=""){
  echo "arm with $arm \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe arm");
} else if($neutral!=""){
  echo "neutral \n"; ?><br><?php
  echo shell_exec ("sudo ./ccontrol.exe neutral");
}
?>
