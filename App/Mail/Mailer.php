<?php
namespace Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function sendEmail()
    {
        try {
            // Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = getenv('SMTP_USERNAME'); // Use environment variables instead of hardcoding
            $this->mail->Password   = getenv('SMTP_PASSWORD');
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = 465;

            // Recipients
            $this->mail->setFrom("zobirofkir19@gmail.com", "zobir");
            $this->mail->addAddress("contact@zobirofkir.com");

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = "Hello";
            $this->mail->Body    = "Hello World";
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
        } catch (Exception $e) {
            // Handle error gracefully
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
