<?php

?>

<html>

<head>
    <title>Task Management Tool | Add Task</title>
</head>

<body>
    <center>
        <img width="400" src="/Trello-Logo.png"> </img>
        <form method="POST" action="">
            <label>Title:</label><br>
            <input type="title" name="title" /><br><br>
            <label>Description:</label><br>
            <input type="description" name="description"></input><br><br>
            <label>Status:</label><br>
            <select>
                <option value="to_do">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </form>
        <br>
        <a href="/cacttus-s3-basic-web/task-management-tool/task-list.php">Go to see Task List!</a>
    </center>
</body>

</html>