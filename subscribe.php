<?php
require("phpMQTT.php");

$host   = "riset.revolusi-it.com";
$port     = 1883;
$username = "";
$password = "";
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
if(!$mqtt->connect(true,NULL,$username,$password)){
  exit(1);
}

// subscribe ke topik
$topics['iot/suhu'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){
}

$mqtt->close();
function procmsg($topic,$msg){
  echo "Msg Recieved: $msg";
}

?>