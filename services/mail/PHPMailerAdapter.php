<?php
namespace Services\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Services\Mail\MailerInterface;
class PHPMailerAdapter implements MailerInterface
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    private function configureMailer($nameOfServices = 'Ecommerce App Service'): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host       = 'smtp.gmail.com';
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = 'moanbm123@gmail.com';       // Replace with your Gmail address
        $this->mailer->Password   = 'mbtp jzxr yylb pmnq';          // Replace with your Gmail App Password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = 587;
        $this->mailer->setFrom('moanbm123@gmail.com', $nameOfServices); // Replace with your name or name of your service
    }

    public function send(string $to, string $subject, string $body): bool
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->isHTML(true);
            $this->mailer->AltBody = strip_tags($body);
            return $this->mailer->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
