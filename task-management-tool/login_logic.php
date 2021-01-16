<?php

    session_start();
    require_once "util.php";

    if(isUserLoggedIn()){
        header("Location: /cacttus-s3-basic-web/task-management-tool/add-task.php");
        die();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = findUserByEmailAndPassword($email, $password);

    if($user != null){
        // logged in
        echo "Logged in!!!";
        $_SESSION['logged_in'] = true;
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user['id'];
        header("Location: /cacttus-s3-basic-web/task-management-tool/add-task.php");
        die();
    }else {
        echo "Wrong crendentials!!!";
        $_SESSION['logged_in'] = false;
    }

?>