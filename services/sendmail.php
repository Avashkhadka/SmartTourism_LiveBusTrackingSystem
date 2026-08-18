<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../config/constants.php';
require 'emailTemplate.php';
$mail = new PHPMailer(true);


try {

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = HOST_USER;
    $mail->Password = HOST_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = PORT;

    //Recipients
    $mail->setFrom('avash2063@gmail.com', 'My Ecommerce Website');
    $mail->addAddress('avash2063@gmail.com', 'Avash kahdak');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('avash2063@gmail.com', 'Information');
    /*   $mail->addCC('cc@example.com');
      $mail->addBCC('bcc@example.com'); */

    //Attachments
/*     $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name */

    $mail->isHTML(true);
    $mail->Subject = 'This is the test';
    $message = emailTemplate([
        "passcode" => "153456",
        "expiresOn" => "08:56",
        "requestId" => "TRT 34-2"
    ]);

    $mail->Body = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPDebug = 0;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}