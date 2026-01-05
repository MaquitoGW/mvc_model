<?php
namespace lib;

require 'email/Exception.php';
require 'email/PHPMailer.php';
require 'email/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use lib\IsConfig;

class Mail
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = IsConfig::env("MAIL_HOST");
        $this->mail->SMTPAuth = true;
        $this->mail->Username = IsConfig::env("MAIL_USERNAME");
        $this->mail->Password = IsConfig::env("MAIL_PASSWORD");
        $encryption = IsConfig::env('MAIL_ENCRYPTION');
        switch ($encryption) {
            case 'ssl':
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                break;
            case 'tls':
            default:
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                break;
        }
        $this->mail->Port = IsConfig::env("MAIL_PORT");
        $this->mail->setFrom(IsConfig::env("MAIL_USERNAME"), IsConfig::env("MAIL_NAME"));
    }

    public function send($subject, $body, $recipients)
    {
        foreach ($recipients as $mail) {
            $this->mail->addAddress($mail);
        }

        $this->mail->isHTML(true);
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        try {
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            $logData = [
                "Erro ao enviar email: " . $e->getMessage(),
                "PHPMailer Error: {$this->mail->ErrorInfo}"
            ];
            file_put_contents(dirname(__DIR__) . '../Private/logs/access.log', json_encode($logData) . PHP_EOL, FILE_APPEND);
            return false;
        }
    }
}
