<?php

session_start();
require_once "util.php";



$fullName = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$user = [
    'full_name' => $fullName,
    'email' => $email,
    'password' => $password,
];

storeUserToFile($user);

echo "Welcome to Trello. Click <a href='/cacttus-s3-basic-web/task-management-tool/'>here</a> to login"

?>