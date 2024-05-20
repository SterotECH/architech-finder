<?php


use PHPMailer\PHPMailer\PHPMailer;

return [
    'host' => env('MAIL_HOST', 'smtp.google.com'),
    'port' => env('MAIL_PORT', 465),
    'encryption' => env('MAIL_ENCRYPTION', PHPMailer::ENCRYPTION_SMTPS),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),

    'from' => env('MAIL_FROM_ADDRESS'),

    'from_name' => env('MAIL_FROM_NAME'),
];
