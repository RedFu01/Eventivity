<?php
header('Content-Type: application/jsonp');

$name = $_GET['name'];
$password = $_GET['password'];

$server = "fu.no-ip.biz";
$usr = "Android";
$pwd = "kk13";
$database = "eventivity";

mysql_connect ($server,$usr, $pwd) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($database);
$result = mysql_query("SELECT * FROM events");
$response = [];
while($event = mysql_fetch_object($result)){
array_push($response,$event);
}
mysql_close();
echo $_GET['callback'] . '('.json_encode($response).')';
?>