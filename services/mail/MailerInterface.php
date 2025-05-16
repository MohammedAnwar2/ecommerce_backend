<?php
namespace Services\Mail;

interface MailerInterface
{
    public function send(string $to, string $subject, string $body): bool;
}
