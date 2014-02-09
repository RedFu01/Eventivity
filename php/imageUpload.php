<?php
$id = $_POST['id'];
$url= $_POST['url'];

$server = "fu.no-ip.biz";
$usr = "Android";
$pwd = "kk13";
$database = "eventivity";

$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$max_size = 20000 * 102400; // max file size
$path = 'user_images/'; // upload directory

mysql_connect ($server,$usr, $pwd) or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($database);

if( ! empty($_FILES['image']) ) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
		$path = $path . uniqid(). '.' .$ext;
		$oldFile =  mysql_fetch_row(mysql_query("SELECT image FROM user WHERE (id ='".$id."')"))[0];
		$filename = substr($oldFile,strpos($oldFile,'/')+1,strlen($oldFile));
		$old = getcwd();
		chdir('user_images');
		if (is_readable($filename)) {
			unlink($filename);
		}
		chdir($old);
		if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
			$result = mysql_query("UPDATE user SET image='".$path."' WHERE (id ='".$id."')");
			echo "<img src='$path' />";
		}
    } 
}
mysql_close();
//header("Location:".$url);
die();

?>