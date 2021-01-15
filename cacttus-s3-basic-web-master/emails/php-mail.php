<?php
    $to = "edon.sekiraqa@faculty.cacttus.education";
    $subject = "Reset Password!";
    $message = "You have requested to reset your password!";

    var_dump(mail($to, $subject, $message));
?>