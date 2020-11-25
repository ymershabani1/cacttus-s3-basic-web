<?php

session_start();
require_once "timeline.php";


$posts = fopen("posts.txt","a");
if(!$posts){
header('Location: timeline.php');
die();
}

$title=$_POST[title];
$description=$_POST[description];
// fputs($posts,date("m/j/y h:i \n ",time()));
fputs($posts,"Title: $title\r\n");
fputs($posts,"Description: $description\r\n\n");
fclose($posts);
header('Location: timeline.php');
die();
?>