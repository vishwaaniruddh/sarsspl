<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

class EmailSender {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer\PHPMailer\PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.hostinger.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'mail@orchiddining.com';
        $this->mailer->Password = 'ul4yHO1*653Q';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 587;
    }
    
    public function sendEmail($recipient, $subject, $body) {
        try {
            $this->mailer->setFrom('mail@orchiddining.com', 'Orchid');
            $this->mailer->addAddress($recipient);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Error: ', $this->mailer->ErrorInfo;
        }
    }
}



$emailSender = new EmailSender();
$emailSender->sendEmail('vishwaaniruddh@gmail.com', 'Test Email', 'This is a test email.');


?>