<?php

namespace Support;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['EMAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['EMAIL_PORT'];
        $this->mail->Username = $_ENV['EMAIL_USERNAME'];
        $this->mail->Password = $_ENV['EMAIL_PASSWORD'];

    }

    /**
     * @throws Exception
     */
    public function sendEmail(string $to, string $name, string $subject, string $message): void
    {
        $this->mail->setFrom('from@example.com', 'Mailer');
        $this->mail->addAddress($to, $name);

        $this->mail->isHTML();
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Subject = $subject;
        $this->mail->Body    = $message;

        $this->mail->send();
    }
}