<?php

require 'PHPMailer/PHPMailerAutoload.php';

session_start();

 $email = $_SESSION['email'];

$mail = new PHPMailer;
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'chandan.bhalala@gmail.com';          // SMTP username
$mail->Password = 'Chandan@2699'; 						   // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to
$mail->setFrom($email, 'Cake shop');
$mail->addReplyTo($email, 'Cake shop');
$mail->addAddress($email);   
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = "<h1>Thank you <b>$email</b>,</h1>";
$bodyContent .= "<p>For subscibe our website.</p>";

$mail->Subject = 'Email From Aroma Shop';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header("location:index.php");
    // echo "sent";
 
}
?>