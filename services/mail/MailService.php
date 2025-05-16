<?php

namespace Services\Mail;

class MailService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendPhpMailer($to, $subject, $body = null, $otpCode = null): bool
    {
        return $this->mailer->send($to, $subject, $body);
    }
}
