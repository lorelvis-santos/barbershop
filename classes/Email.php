<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    protected static $mail = null;
    protected static $host = $_ENV["EMAIL_HOST"];
    protected static $port = $_ENV["EMAIL_PORT"];
    protected static $username = $_ENV["EMAIL_USERNAME"];
    protected static $password = $_ENV["EMAIL_PASSWORD"];
    protected static $SMTPsecure = "tls";
    protected static $SMTPauth = true;
    protected static $charset = "UTF8";

    public static function send($fromEmail, $fromName, $toEmail, $toName, $subject, $body, $altBody, $isHtml = false) : bool {
        self::checkConnection();

        self::$mail->isHtml($isHtml);
        self::$mail->setFrom($fromEmail, $fromName);
        self::$mail->addAddress($toEmail, $toName);
        self::$mail->Subject = $subject;
        self::$mail->Body = $body;
        self::$mail->AltBody = $altBody;

        return self::$mail->send();
    }

    protected static function start() : bool {
        // Creating a phpmailer instance.
        self::$mail = new PHPMailer();

        // Configuring SMTP.
        self::$mail->isSMTP();
        self::$mail->SMTPAuth = self::$SMTPauth;
        self::$mail->Host = self::$host;
        self::$mail->Port = self::$port;
        self::$mail->Username = self::$username;
        self::$mail->Password = self::$password;
        self::$mail->SMTPSecure = self::$SMTPsecure;
        self::$mail->CharSet = self::$charset;

        return true;
    }

    protected static function checkConnection() : void {
        if (self::$mail === null) 
            self::start();
    }
}