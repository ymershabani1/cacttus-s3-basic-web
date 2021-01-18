<?php

session_start();
require_once "util.php";

if(isUserLoggedIn()){
    header("Location: /cacttus-s3-basic-web/task-management-tool/add-task.php");
    die();
}

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$password = $_POST['password'];

$user = [
    'fullName' => $fullName,
    'email' => $email,
    'password' => $password,
];

storeUserToFile($user);

echo "Welcome to Trello. Click <a href='/cacttus-s3-basic-web/task-management-tool/'>here</a> to login"

?>