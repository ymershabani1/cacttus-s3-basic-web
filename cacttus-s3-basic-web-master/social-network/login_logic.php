<?php
    session_start();

    require_once "util.php";

    // if logged in then redirect to timeline.php
    if (isUserLoggedIn()) {
        header("Location: /social-network/timeline.php");
        die();
    }

    // get the data
    $email = $_POST['email'];
    $password= $_POST['password'];

    $user = findUserByEmailAndPassword($email, $password);
    
    if($user != null){
        // logged in
        echo "Logged in!!!";
        $_SESSION['logged_in'] = true;
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['email'] = $email;
        header("Location: /social-network/timeline.php");
        die();
    }else {
        echo "Wrong crendentials!!!";
        $_SESSION['logged_in'] = false;
    }
?>