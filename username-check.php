<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername,$username,$password);

$sql = "use entry";

$conn->query($sql);

$user = strtolower($_POST['email']);

$sql = "select email from user where username = '".$user."';";

$result = $conn->query($sql)->fetch_assoc();

if ($result['email']==$user)
{
	echo 'false';
}
else {
 	echo 'true';
 } 

?>
