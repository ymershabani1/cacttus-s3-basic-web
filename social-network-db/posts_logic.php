<?php
session_start();
require_once "util.php";

$title = $_POST['title'];
$description = trim($_POST['description']);
$dateTimeCreated = date("F j, Y, g:i a"); 

$email = $_SESSION['email'];
$userId = $_SESSION['id_user'];

$post = [
    'title' => $title,
    'description' => $description
];

if(!empty($title) && !empty($description)){
    storePostToFile($post, $userId);
}

if (isUserLoggedIn()) {
    header("Location: /social-network-db/timeline.php");
    die();
}


?>