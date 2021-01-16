<?php

session_start();
require_once "util.php";

if(isUserLoggedIn()){
    header("Location: /cacttus-s3-basic-web/task-management-tool/add-task.php");
    die();
}

?>


<html>
<head>
    <title>Task Management Tool</title>
</head>
<body>
    <center>
        <img width="400" src="/Trello-logo.png"></img>
        <form method="POST" action="/cacttus-s3-basic-web/task-management-tool/login_logic.php">
        <label>Email:</label><br>
        <input type="email" name="email"/><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"/><br><br>
        <input type="submit" value="Login">
        </form>
        <br><br>
        <a href="/cacttus-s3-basic-web/task-management-tool/register.php">Create new account!</a>     
    </center>
</body>
</html>