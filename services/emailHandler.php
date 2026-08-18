<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/emailTemplate.php';

class EmailHandler
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = HOST_USER;
        $this->mail->Password = HOST_PASSWORD;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = PORT;

        $this->mail->setFrom(HOST_USER, 'My Ecommerce Website');
        $this->mail->isHTML(true);
    }

    public function send(
        string $to,
        string $name,
        string $subject,
        string $body,
        string $altBody = ''
    ): bool {
        try {
            $this->mail->clearAddresses();

            $this->mail->addAddress($to, $name);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = $altBody ?: strip_tags($body);

            return $this->mail->send();

        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    public function sendOTP(
        string $to,
        string $name,
        string $passcode,
        string $expiresOn,
        string $requestId
    ): bool {
        $message = emailTemplate([
            'passcode' => $passcode,
            'expiresOn' => $expiresOn,
            'requestId' => $requestId
        ]);

        return $this->send(
            $to,
            $name,
            'Your OTP Verification Code',
            $message,
            "Your OTP is: {$passcode}. It expires at {$expiresOn}."
        );
    }
}
