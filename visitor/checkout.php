<?php

	$email = $_REQUEST['email'];

	$username = "root";
	$password = "";
	$servername = "localhost";

	session_start();

	$conn = new mysqli($servername,$username,$password);

	$sql = "use entry";
	$conn->query($sql);

	$sql =  "select *,count(*) from entrylog where email ='".$_SESSION['visitoremail']."';";
	$result=$conn->query($sql)->fetch_assoc();

	$sql = "delete from entrylog where email ='".$_SESSION['hostemail']."';";
	$conn->query($sql);

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	use Twilio\Rest\Client;

	if($result['count(*)']==0){
		echo "No prior checkin detected";
	}

	else{

	$sql = "select * from user where email = '".$email."';";
	$row=$conn->query($sql)->fetch_assoc();

	$sql = "select curtime() as checkout";
	$result2 = $conn->query($sql)->fetch_assoc();

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
	$mail->Body = 'Greetings!<br><br>Here are your visit details:<br>Host: '.$row["name"].'<br>Email: '.$row["email"].'<br>Phone: '.$row["phone"].'<br>Check-in time: '.$result["checkin"].'<br>Check-out time: '.$result2["checkout"];
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
        'body' => 'Greetings!
        			Here are your visit details:
        			Host: '.$row["name"].'
        			Email: '.$row["email"].'
        			Phone: '.$row["phone"].'
        			Check-in time: '.$result["checkin"].'
        			Check-out time: '.$result2["checkout"]
    ));

    echo "Successful check out";
}

?>