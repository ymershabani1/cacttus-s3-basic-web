<?php
session_start();
require_once "util.php";

// if logged in then redirect to timeline.php
if (isUserLoggedIn()) {
    header("Location: /social-network-db/timeline_ajax.php");
    die();
}
?>
<html>

<head>
    <title>Cacttus Social Network</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <center>
        <img width="400" src="https://cacttus.education/wp-content/uploads/2019/07/fb_CACTTUS_logo.png"> </img>
        <form onsubmit="return login();">
            <label>E-mail:</label><br>
            <input id="login_email" type="email" name="email" /><br>
            <label>Password:</label><br>
            <input id="login_password" type="password" name="password" /><br><br>
            <input type="submit" value="Log In" />
        </form>
        <br>
        <a href="/social-network-db/register.php">Create new account!</a>
    </center>
</body>
<script>
    function login() {
        const email = $("#login_email").val();
        const password = $("#login_password").val();

        const apiEndpoint = "http://cacttus-s3-basic-web.test/social-network-db/login_api.php";

        // post request to login_api.php
        $.post(apiEndpoint, {
            'email': email,
            'password': password
        }, function(response) {
            if (response.success == false){
                alert(response.message);
            }else{
                location.reload();
            }
        });

        return false;
    }
</script>

</html>