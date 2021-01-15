<?php
session_start();
require_once "util.php";

// if logged in then redirect to timeline.php
if (isUserLoggedIn()) {
    header("Location: /social-network-db/timeline.php");
    die();
}

$userId = $_POST['user_id'];
$userId = urldecode($userId);
var_dump(decrypt($userId));die();
$password = $_POST['password'];

updateUserPassword($userId, $password);
echo "Password updated!";
?>