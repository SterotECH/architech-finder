<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    protected array $config;
    private PHPMailer $mail;

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function __construct()
    {
        $this->config = config('mail');

        $this->mail = new PHPMailer(true);

//        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->config['username'];
        $this->mail->Password = $this->config['password'];
        $this->mail->SMTPSecure = $this->config['encryption'];
        $this->mail->Port = $this->config['port'];
    }

    /**
     * @throws Exception
     */
    public function send(string $email, string $subject, string $body, string $from = null): bool
    {

        $this->mail->addAddress($email);

        $this->mail->setFrom($from ?: $this->config['from'], $this->config['from_name'] ?? null);


        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        if (!$this->isNetworkAvailable()) {
            Session::flash('error','No internet connection available. Email cannot be sent.');
            Response::redirect(Router::previousUrl());
            return false;
        } else {
           $this->mail->send();
           return true;
        }
    }
    private function isNetworkAvailable(): bool
    {
        $hostname = "google.com";
        $port = 80;
        $timeout = 5;

        $fp = @fsockopen($hostname, $port, $errno, $error, $timeout);
        if ($fp) {
            fclose($fp);
            return true;
        } else {
            return false;
        }
    }

}
