<?php
header('Content-Type: application/jsonp');
$name = $_GET['name'];
$password = $_GET['password'];
$server = "fu.no-ip.biz";
$usr = "Android";
$pwd = "kk13";
$database = "eventivity";
$message = "no message";
mysql_connect ($server,$usr, $pwd) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($database);
$result = mysql_query("SELECT * FROM user WHERE (name ='".$name."') AND (password ='".$password."')");
if($result && mysql_num_rows($result) > 0){
$response =  array('access' => 1,'message'=> $message, 'time' => microtime());
}else{
$response =  array('access' => 0,'message'=> $message, 'time' => microtime());
}
mysql_close();
echo $_GET['callback'] . '('.json_encode($response).')';
?>