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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <center>
        <img width="400" src="/Trello-logo.png"></img>
        <form  method="POST" action="/cacttus-s3-basic-web/task-management-tool/login_logic.php">
            <label>Email:</label><br>
            <input id="login_email" type="email" name="email"/><br><br>
            <label>Password:</label><br>
            <input id="login_password" type="password" name="password"/><br><br>
            <input type="submit" value="Log In" id="btnLogin">
        </form>
        <br><br>
        <a href="/cacttus-s3-basic-web/task-management-tool/register.php">Create new account!</a>     
    </center>
</body>
<script>

$(document).ready(function(){
    $("#btnLogin").click(function(){
        var email = $("#login_email").val();
        var password = $("#login_password").val();

        if(email!="" && password!==){
            $.ajax({
                url: '/cacttus-s3-basic-web/task-management-tool/login_logic.php',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response){
                    if(response=="success"){
                        window.location.href="/cacttus-s3-basic-web/task-management-tool/add-task.php";
                    }else{
                        alert("Wrong Details!")
                    }

                }
            })
        }
    })
})


</script>


</html>