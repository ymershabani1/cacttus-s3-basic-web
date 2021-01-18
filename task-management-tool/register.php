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
    <title>Task Management Tool | Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <center>
        <img width="400" src="/Trello-Logo.png"> </img>
        <form onsubmit="return register();">
            <label>Full Name:</label><br>
            <input type="text" name="fullName" id="fullName" /><br><br>
            <label>E-mail:</label><br>
            <input type="email" name="email" id="email" /><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" id="password" /><br><br>
            <input type="submit" value="Register" id="btnRegister" />
        </form>
        <br>
        <a href="/cacttus-s3-basic-web/task-management-tool/">Login if you already have an account!</a>
    </center>
</body>

<script>

$(document).ready(function(){
    $("#btnRegister").click(function(){
        var fullName = $("#fullName").val();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            url: '/cacttus-s3-basic-web/task-management-tool/register_logic.php',
            method: 'POST',
            data: {
                fullName: fullName,
                email: email,
                password: password
            },
            success: function(response){
                window.location.href="/cacttus-s3-basic-web/task-management-tool/success.php";
            }
        });
    });
});



</script>

    

</html>
