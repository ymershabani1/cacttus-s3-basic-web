<?php

session_start();
require_once "util.php";

if(!isUserLoggedIn()){
    header("Location: /cacttus-s3-basic-web/task-management-tool/");
    die();
}

?>

<html>

<head>
    <title>Task Management Tool | Add Task</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <center>
        <img width="400" src="/Trello-Logo.png"> </img>
        <form>
            <label>Title:</label><br>
            <input type="title" name="title" id="title" /><br><br>
            <label>Description:</label><br>
            <input type="description" name="description" id="description"></input><br><br>
            <label>Status:</label><br>
            <select name="status" id="status">
                <option value="to_do">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select><br><br>
            <input type="submit" value="Add Task" id="btnAddTask" />
        </form>
        <br>
        <a href="/cacttus-s3-basic-web/task-management-tool/task-list.php">Go to see Task List!</a>
    </center>
</body>

<script>

$(document).ready(function(){
    $("#btnAddTask").click(function(){
        var title = $("#title").val();
        var description = $("#description").val();
        var status = $("#status").val();

        $.ajax({
            url: '/cacttus-s3-basic-web/task-management-tool/add-task_logic.php',
            method: 'POST',
            data: {
                title: title,
                description: description,
                status: status
            },
            success: function(response){
                    die();
            }
        });
    });
});

</script>

</html>