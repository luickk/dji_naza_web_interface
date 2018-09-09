<?php
$action = $_GET["action"];
$screen_id = $_GET["id"];
$command = $_GET["command"];

if($action=="stop" && $screen_id != ""){
  shell_exec ("sudo screen -X -S ".$screen_id." quit");
  echo "stopped ".$screen_id;
} else if($action=="start" && $command != ""){
  shell_exec ($command);
  echo "started ".$command;
}
?>
