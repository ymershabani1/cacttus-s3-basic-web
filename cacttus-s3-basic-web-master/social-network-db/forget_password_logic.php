<?php
session_start();
require_once "util.php";

// if logged in then redirect to timeline.php
if (isUserLoggedIn()) {
    header("Location: /social-network-db/timeline.php");
    die();
}

$email = $_POST['email'];

$user = getUserByEmail($email);

if(empty($user)){
    echo "User doesn't exist!";
    die();
}

// approach 1 - send a new password
/*$newPassword = "pwd_".time()."_".$user['id'];
// update user in database
if(updateUserPassword($user['id'], $newPassword)){
    // send email
    $messageHTML = "You have requested a new password!<br>Please use the password below to login next time.<br>";
    $messageHTML .= "The new password is:".$newPassword;
    sendEmail([
        [
            'email'=> $email,
            'name' => $user['first_name']
        ]
    ], "New Password Requested!", $messageHTML);
}*/

// approach 2 - send reset password link
$encryptedUserId = encrypt($user['id']);
$encryptedUserId = urlencode($encryptedUserId);
$link = "http://cacttus-s3-basic-web.test/social-network-db/reset_password.php?user_id=". $encryptedUserId;
// send email
$messageHTML = "You have requested a new password!<br>Please use the link below to reset your password<br>";
$messageHTML .= "<a href='". $link."'>Click here to reset password!</a>";
sendEmail([
    [
        'email' => $email,
        'name' => $user['first_name']
    ]
], "New Password Requested!", $messageHTML);
?>