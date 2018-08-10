<?php

/* To use take off interface you need to install sudo and add
   the www-data user to sudoers file as root permitted.
   /etc/sudoers -> www-data ALL=(ALL)    NOPASSWD: ALL

   Also you have to compile the take off positions from the
   Naza V2 interface main repository. And add the resulting binary as ccontrol.exe
   to this directory.
   */

$alt = $_GET["alt"];
$heading = $_GET["heading"];
$lat = $_GET["lat"];
$lon = $_GET["lon"];
$numsat = $_GET["numsat"];

$data  = array($numsat, $lat, $lon, $heading, $alt);

$PATH = 'nazaTakeOfPos/';

if($alt!="" && $heading!="" && $lat!="" && $lon!="" && $numsat!=""){
  if (!file_exists($PATH)) {
    mkdir($PATH, 0777, true);
    echo 'creating folder';
  }
  $fh = fopen($PATH.'pos.json', 'w') or die("Can't create file");
  $jsonData = json_encode($data);
  file_put_contents($PATH.'pos.json', $jsonData);
}
?>
