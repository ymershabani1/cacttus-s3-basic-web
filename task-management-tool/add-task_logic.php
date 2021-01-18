<?php

session_start();
require_once "util.php";

$title = $_POST['title'];
$description = trim($_POST['description']);
$status = $_POST['status'];

$userId = $_SESSION['user_id'];

$post = [
    'title' => $title,
    'description' => $description,
    'status' => $status
];

if(!empty($title) && !empty($description)){
    storePostToFile($post, $userId);
    
}

if(isUserLoggedIn()){
    header("Location: /cacttus-s3-basic-web/task-management-tool/add-task.php");
    die();
}







?>