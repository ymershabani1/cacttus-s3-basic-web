<?php
require_once "util.php";

$receivers = [
    [
        "email" => "egzon@cacttus.com",
        "name" => "Egzon"
    ],
    [
        "email" => "aulona@cacttus.com",
        "name" => "Aulona"
    ],
    [
        "email" => "ardit@cacttus.com",
        "name" => "Ardit"
    ]
];

foreach ($receivers as $receiver) {
    $confirmationLink = 
    "http://cacttus-s3-basic-web.test/emails/smtp-mailer/verify.php?email=". $receiver['email'];
    sendEmail([$receiver], "Welcome ". $receiver['name']." to our Platform!", 
        "Please confirm your email by using the link below: 
        <a href=".$confirmationLink.">Confirm Account</a>",
    "php-logo.svg");
}