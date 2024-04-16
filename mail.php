<?php
$receiver = "22pc02@psgtech.ac.in";
$subject = "Email Test via PHP using Gmail SMTP";
$body = "Hi, there...This is a test email sent from PHP using Gmail SMTP.";
$sender = "22pc08@psgtech.ac.in";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\PHPMailer/src/PHPMailer.php';
require 'C:\xampp\PHPMailer/src/SMTP.php';
require 'C:\xampp\PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '22pw30@psgtech.ac.in';
    $mail->Password = 'RaidMaster24';
    $mail->SMTPSecure = 'ssl';  // Use 'ssl' for SSL connection
    $mail->Port = 465;  // Use 465 for SSL

    // Sender and recipient
    $mail->setFrom($sender, 'Your Name');
    $mail->addAddress($receiver, 'Recipient Name');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
?>
