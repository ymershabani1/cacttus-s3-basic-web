<?php
session_start();
require_once "util.php";

// if not logged in then redirect to login.php
if (!isUserLoggedIn()) {
    header("Location: /social-network/");
    die();
}
?>
<html>

<head>
    <title>Cacttus Social Network  |   Timeline</title>
<style>
    div{
        display: table-cell; 
        width: 400px;  
        font-family: sans-serif;
        
    }

    label{
        float: left; 
        color: red;
    }

    input{
        width:400px; 
        border: 2px solid red; 
        float:left;
    }
    textarea{
        resize: none;
        height:60px;
        width:400px; 
        border: 2px solid red; 
        float:left;       
    }

    .save{
        margin-top: 10px;
        float: left;
        border: 2px solid red;
        color:red;
        padding: 10px 24px;
    }

</style>
</head>

<body>
    <center>
        Welcome <b><?php echo $_SESSION['first_name'] ?></b>
        <a href="/social-network/signout.php">Sign out!</a>
        The content
    </center>
    <br><br>
    <center>
        <form method="POST" action="/social-network/timeline_logic.php">
            <div>
                <label><b>New Post:</b></label><br><br>
                <label>Title:</label><br>
                <input type="text" name="title"/><br><br>
                <label for="description">Description:</label><br>
                <textarea name="description" cols=50 rows=10></textarea><br><br>
                <input type="submit" name="submit" value="Save">
                <?php
echo nl2br(file_get_contents( "posts.txt" )); // get the contents, and echo it out.
?>
        </form>
    </center>
</body>

</html>