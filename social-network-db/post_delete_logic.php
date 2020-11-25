<?php
    session_start();
    require_once 'util.php';

    if(!isUserLoggedIn()){
        header("Location: /social-network-db/");
        die();
    }

    $postId = $_GET['post_id'];
    deletePostByIdAndUser($postId, $_SESSION['id_user']);
    header("Location: /social-network-db/timeline.php");
?>