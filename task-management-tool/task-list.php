<?php

session_start();
require_once "util.php";

if(!isUserLoggedIn()){
    header("Location: /cacttus-s3-basic-web/task-management-tool/index.php");
    die();
}


?>




<html>
    <head>
        <title>Task Management Tool | Task List</title>
    </head>

    <body>
        <center>
        </center>
    </body>
</html>