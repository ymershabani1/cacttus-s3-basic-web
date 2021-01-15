<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail(array $to, $subject, $messageHTML, $attachment=null){
    require_once 'php-mailer/src/Exception.php';
    require_once 'php-mailer/src/PHPMailer.php';
    require_once 'php-mailer/src/SMTP.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = "smtp.mailtrap.io";
    $mail->Port = "25"; // typically 587 
    $mail->SMTPSecure = 'tls'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = "f88850a80f4d3f";
    $mail->Password = "c3989b3ac67f46";
    $mail->setFrom("edon@test.com", "Edon Sekiraqa");
    foreach($to as $receiver){
        $mail->addAddress($receiver["email"], $receiver["name"]);
    }
    $mail->Subject = $subject;
    $mail->msgHTML($messageHTML); // remove if you do not want to send HTML email
    $mail->AltBody = 'HTML not supported';
    if($attachment !== null){
        $mail->addAttachment($attachment); //Attachment, can be skipped
    }
   
    $mail->send();
}
?>