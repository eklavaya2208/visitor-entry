 <?php
	$username = "root";
	$password = "";
	$servername = "localhost";

	$conn = new mysqli($servername,$username,$password);

	if ($conn->connect_error)
	{
		die("Connection failed".$conn->connect_error);
	}

	$sql = "use entry";

	$conn->query($sql);

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$pass = md5($_POST['pass']);
	$status = $_POST['status'];

	$sql = "select count(*) from user;";

	$result = $conn->query($sql)->fetch_assoc() or die($conn->error);

	$userID = $result['count(*)'] + 1;

	$sql = "Insert into user values ('".$userID."','".$name."','".$email."',+91".$phone.",'".$pass."','".$status."');";
	$conn->query($sql) or die($conn->error);

	header("Location:index.php");

	$conn->close();

?>