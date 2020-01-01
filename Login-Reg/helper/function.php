
<?php
require_once './connect.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendCode($code,$email){

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.lfsbd.com ';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                   // SMTP username
    $mail->Password   = '';                              // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('phpdoc@lfsbd.com', 'LFSIT');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Confirmation Code';
    $mail->Body    = 'Thank you for joining us! Your confirmation code is:'.$code;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $_SESSION['user_email']=$email;
    $_SESSION['account_create']="Your account successfully created!!!";
    header('Location:confirm.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:", $mail->ErrorInfo;
}
}


function confirm_email(){
 GLOBAL $db;
 if(isset($_POST['confirm'])){
 	$code=trim($_POST['confirm_code']);
 	$user_email=$_SESSION['user_email'];
 	if(empty($code)){
 		echo "<div class='alert alert-danger'>Please insert the code!!!!</div>";
 	}
 	else{
 		$query=$db->prepare("select code from users where email=? && code=?");
 		$query->execute([$user_email,$code]);
 		if($query->rowCount()==1){
 			$update_code=1;
 			$query_update=$db->prepare("Update users SET status=? where email=? && code=?");
 			$query_update->execute([$update_code,$user_email,$code]);
 			if($query_update){
 				$_SESSION['confirm_success']="Your account is confirmed!";
 				header("Location:index.php");
 			}
 			else{
 				echo "<div class='alert alert-danger'>Query not work!!!!</div>";
 			}
 		}else{
 			echo "<div class='alert alert-danger'>invalid code!!!!</div>";
 		}
 	}
 }	
}

function user_login(){
	GLOBAL $db;
	if(isset($_POST['login'])){
	$email=trim($_POST['email']);
	$password=trim($_POST['password']);
		if(empty($email) || empty($password)){
			echo "<div class='alert alert-danger'>Please enter email and password</div>";
		}
		else{
			$query=$db->prepare("SELECT * FROM users where email=?");
			$query->execute([$email]);
			if($query->rowCount()==1){ 
				$row=$query->fetch(PDO::FETCH_OBJ);
				$id=$row->id;
				$first_name=$row->first_name;
				$db_password=$row->password;
				$status=$row->status;
				if($status==0){
					$_SESSION['user_email']=$email;
					$_SESSION['please_confirm']="Please confirm your email";
					header('Location:confirm.php');
				}
				else{
					if(password_verify($password,$db_password)){
						$_SESSION['user_id']=$id;
						$_SESSION['user_name']=$first_name;
						header('Location:profile.php');
						
					}else{
						echo "<div class='alert alert-danger'>Please enter the correct password....</div>";
					}
				}
			}else{
					echo "<div class='alert alert-danger'>Please enter the correct email...</div>";
				}
		}
	}

}

 ?>