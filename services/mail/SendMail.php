<?php

namespace Services\Mail;

use Services\Mail\PHPMailerAdapter;
use Services\Mail\MailService;

class SendMail
{
    public static function sendOtpEmail($to, $subject, $otpCode = null)
    {
        $mailer = new PHPMailerAdapter();
        $mailService = new MailService($mailer);
        $body = '
    <div style="max-width:480px;margin:30px auto;padding:32px 24px;background:#f9fafb;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.07);font-family:sans-serif;">
        <div style="text-align:center;">
            <img src="https://cdn-icons-png.flaticon.com/512/2910/2910791.png" alt="OTP" width="60" style="margin-bottom:18px;">
            <h2 style="color:#2d3748;margin-bottom:8px;">Your Verification Code</h2>
        </div>
        <p style="color:#4a5568;font-size:16px;line-height:1.6;margin-bottom:24px;text-align:center;">
            Please use the following One-Time Password (OTP) to complete your verification process:
        </p>
        <div style="text-align:center;margin-bottom:24px;">
            <span style="display:inline-block;background:#3182ce;color:#fff;font-size:28px;letter-spacing:8px;padding:14px 32px;border-radius:8px;font-weight:bold;">
                ' . htmlspecialchars($otpCode) . '
            </span>
        </div>
        <p style="color:#718096;font-size:14px;text-align:center;margin-bottom:0;">
            This code is valid for 10 minutes. If you did not request this, please ignore this email.
        </p>
        <hr style="margin:32px 0 16px 0;border:none;border-top:1px solid #e2e8f0;">
        <p style="color:#a0aec0;font-size:13px;text-align:center;margin:0;">
            &copy; ' . date('Y') . ' Your Ecommerce. All rights reserved.
        </p>
    </div>';
        if ($mailService->sendPhpMailer($to, $subject, $body, $otpCode)) {
            echo 'Email sent successfully.';
        } else {
            echo 'Failed to send email.';
        }
    }
}
