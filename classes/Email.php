<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected static $mail = null;

    public static function send($fromEmail, $fromName, $toEmail, $toName, $subject, $body, $altBody, $isHtml = false) : bool {
        self::checkConnection();

        self::$mail->isHtml($isHtml);
        self::$mail->setFrom($fromEmail, $fromName);
        self::$mail->addAddress($toEmail, $toName);
        self::$mail->Subject = $subject;
        self::$mail->Body = $body;
        self::$mail->AltBody = $altBody;

        debug(self::$mail->send());

        return true;
    }

    protected static function start() : bool {
        // Creating a phpmailer instance.
        self::$mail = new PHPMailer();

        // Configuring SMTP.
        self::$mail->isSMTP();
        self::$mail->SMTPAuth = true;
        self::$mail->Host = $_ENV["EMAIL_HOST"];
        self::$mail->Port = $_ENV["EMAIL_PORT"];
        self::$mail->Username =  $_ENV["EMAIL_USERNAME"];
        self::$mail->Password = $_ENV["EMAIL_PASSWORD"];
        self::$mail->SMTPSecure = "tls";
        self::$mail->CharSet = "UTF8";

        return true;
    }

    protected static function checkConnection() : void {
        if (self::$mail === null) 
            self::start();
    }
}