<?php
include ('includes/db_connect.php');
$config = parse_ini_file('includes/config.ini.php', 1, true);
require_once('phpmailer/PHPMailerAutoload.php');
$captcha;

if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=SECRETKEYHERE&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }else
        {
		// Create connection
		$conn = new mysqli($host, $user, $pass, $db);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

$username=$_POST['username'];
$email=$_POST['email'];
$age=$_POST['age'];
$comment=$_POST['comment'];

//Notification EMAIL Message
$address = "mcadmins@icarey.net";  //Address to send new register notifications to.

$subject = "iCarey.net Whitelist New Registration"; //SUBJECT

//Message in HTML format.
$message = "Admins, <br>";
$message .= "There has been a new whitelist application submitted!<br>";
$message .= "<h4>Please visit https://mc.icarey.net/whitelist to review application.</h4><br>";
$message .= "There is also a copy of the user's application attached at the end of this message.<br>";
$message .= "<br>";
$message .= "Thank You, <br> Smashedbotatos<br>";
$message .= "<br>";
$message .= "<Strong> User Information:</strong>";
$message .= "<hr>";
$message .= "Minecraft User - $username<br>";
$message .= "Email - $email<br>";
$message .= "Age - $age<br>";
$message .= "Description - $comment<hr>";

//END Notification EMAIL Message
		
$sql = "INSERT INTO whitelist (username, age, email, comment, approved)
VALUES ('$username', '$age', '$email', '$comment', '0')";

if ($conn->query($sql) === TRUE) {
	
//Notification EMAIL SEND	
	$config = parse_ini_file('includes/config.ini.php', 1, true);
	$mail             = new PHPMailer();
	$body             = $message;
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = $config['email']['host']; // SMTP server
	$mail->SMTPDebug  = 0;                 // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = $config['email']['host']; // sets the SMTP server
	$mail->Port       = $config['email']['port'];                    // set the SMTP port for the server
	$mail->Username   = $config['email']['username']; // SMTP account username
	$mail->Password   = $config['email']['password'];        // SMTP account password
	
	$mail->SetFrom($config['email']['from'], $config['email']['fromname']); //FROM
	
	$mail->AddReplyTo($config['email']['reply'], $config['email']['replyname']); //REPLY TO
	
	$mail->Subject    = $subject;
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, Alternate Body for those who can't view HTML mail.
	
	$mail->MsgHTML($body);
	
	$mail->AddAddress($address, "McAdmins"); 
	
	if(!$mail->Send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo '<script type="text/javascript">window.alert("Thanks for your registration! Your registration will be reviewed soon."); window.location.href = "https://mc.icarey.net"</script>';  //Edit this address to your website
	}
	
		
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//END Email SEND		
$conn->close();

		}
?>