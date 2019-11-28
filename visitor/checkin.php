<?php

	$email = $_REQUEST['email'];

	$username = "root";
	$password = "";
	$servername = "localhost";

	session_start();

	$conn = new mysqli($servername,$username,$password);

	$sql = "use entry";
	$conn->query($sql);

	$sql = "select count(*) from entrylog where email ='".$_SESSION['visitoremail']."';";
	$row = $conn->query($sql)->fetch_assoc();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	use Twilio\Rest\Client;

	if($row['count(*)']>0)
	{
		echo "User already checked in with another host";
	}

	else {
		echo "Successfully checked in";
	

	$sql = "insert into entrylog values('".$_SESSION['visitoremail']."','".$email."',curtime());";
	$conn->query($sql) or die($conn->error);

	$sql = "select * from user where email = '".$_SESSION['visitoremail']."';";
	$result=$conn->query($sql)->fetch_assoc();

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '465';
	$mail->isHTML();
	$mail->Username = 'noreplyvisitorentry@gmail.com';
	$mail->Password = 'Tyash2208';
	$mail->SetFrom('noreply@visitorentry.com');
	$mail->Subject = 'New visitor entry';
	$mail->Body = 'Greetings!<br><br>A new user has checked in:<br>Name: '.$result["name"].'<br>Email: '.$result["email"].'<br>Phone: '.$result["phone"];
	$mail->AddAddress($email);

	$mail->Send();

	$sql = "select phone from user where email = '".$email."';";
	$row = $conn->query($sql)->fetch_assoc();

	require __DIR__ . '/twilio-php-master/src/Twilio/autoload.php';

	$account_sid = 'ACdfdc37133c9d8552bdc01b7927853b57';
	$auth_token = '25f48e824de030837c1506396357b8ce';
	$twilio_number = "+16364421058";
	$client = new Client($account_sid, $auth_token);
	$client->messages->create($row['phone'],array(
        'from' => $twilio_number,
        'body' => 'Greetings!A new user has checked in
        			Name: '.$result["name"].'
        			Email: '.$result["email"].'
        			Phone: '.$result["phone"]
    ));
}


?>

