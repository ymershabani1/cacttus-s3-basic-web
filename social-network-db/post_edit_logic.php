<?php
    session_start();
    require_once 'util.php';

    if(!isUserLoggedIn()){
        header("Location: /social-network-db/");
        die();
    }


    $postId = $_POST['post_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    updatePost($postId, $_SESSION['id_user'], $title, $description);

    header("Location: /social-network-db/timeline.php");


?>