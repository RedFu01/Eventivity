<?php
header('Content-Type: application/jsonp');

$name = $_GET['name'];
$password = $_GET['password'];
$email = $_GET['email'];
$message = "";

$server = "fu.no-ip.biz";
$usr = "Android";
$pwd = "kk13";
$database = "eventivity";

mysql_connect ($server,$usr, $pwd) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($database);

$result = mysql_query("SELECT * FROM user WHERE (name ='".$name."') OR (email ='".$email."')");
if(!($result && mysql_num_rows($result) > 0)){
mysql_query("INSERT INTO user (name, password, email) VALUES ('".$name."', '".$password."', '".$email."')");
$response =  array('success' => 1,'message'=> $message, 'time' => microtime());
}else{
$response =  array('success' => 0,'message'=> $message, 'time' => microtime());
}
mysql_close();
echo $_GET['callback'] . '('.json_encode($response).')';
?>