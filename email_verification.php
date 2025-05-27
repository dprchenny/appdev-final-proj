<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_verification($full, $email, $otp){


    $mail = new PHPMailer(true);                              // Passing true enables exceptions
    try {

       
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'chenisecaro@gmail.com';                 // SMTP username
        $mail->Password = 'yrdw cvnx vxcd irid';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('winecraftstore@gmail.com','Wine Craft');
        $mail->addAddress($email);     // Add a recipient
        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "OTP Verification";
        $mail->Body    = "Hello ".$full."<br> This your account verification code:".$otp;

        $mail->send();
        ?>
            <script>
                alert("Email Successfully Sent!!")
            </script>
        <?php
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }



}


?>
