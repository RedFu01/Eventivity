<?php
header('Content-Type: application/jsonp');

$name = $_GET['name'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$description = $_GET['description'];
$id = $_GET['id'];
$message = "";

$server = "fu.no-ip.biz";
$usr = "Android";
$pwd = "kk13";
$database = "eventivity";

mysql_connect ($server,$usr, $pwd) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($database);

$result = mysql_query("SELECT * FROM events WHERE (name ='".$name."') AND (ownerId ='".$id."')");
if(!($result && mysql_num_rows($result) > 0)){
mysql_query("INSERT INTO events (name, lat, lng, description, ownerId) VALUES ('".$name."', '".$lat."', '".$lng."', '".$description."', '".$id."')");
$messgae = "Name schon vergeben";
$response =  array('success' => 1,'message'=> $message, 'time' => microtime());
}else{
$response =  array('success' => 0,'message'=> $message, 'time' => microtime());
}
mysql_close();
echo $_GET['callback'] . '('.json_encode($response).')';
?>