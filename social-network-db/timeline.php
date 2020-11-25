<?php
session_start();
require_once "util.php";
// if not logged in then redirect to login.php
if (!isUserLoggedIn()) {
    header("Location: /social-network-db/");
    die();
}

?>
<html>

<head>
    <title>Cacttus Social Network  |   Timeline</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <center>
        Welcome <b><?php echo $_SESSION['first_name'] ?></b>
        <a href="/social-network-db/signout.php">Sign out!</a>
        <br>
        <form class="col-6"  method="POST" action="/social-network-db/posts_logic.php">
            <h2>New Post:</h2><br>
            <label>Title:</label><br>
            <input type="text" class="form-control" name="title" /><br>
            <label>Description:</label><br>
            <textarea class="form-control" rows = "5" cols = "40" name = "description">
                
            </textarea>
            <br><br>
            <input id="submitBtn"type="submit" class="btn btn-success" value="Save" />
        </form>

        <div class="card">
            <div class="card-header">
                Recent Posts | From newest to oldest created
            </div>
            <div class="card-body">
                <div class="savedPosts" name="savedPosts">
                    <?php 

                        $userId = $_SESSION['id_user'];
                        // $posts = getUserPosts($userId);

                        $posts = getAllUserPosts();
                        if (empty($posts)) {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Nuk ka postime te ketij shfrytezuesi.
                    </div>
                    
                    <?php

                    } else {
                        foreach($posts as $post) {
                            ?>
                                <h5 class="card-title">Title: <?php echo htmlspecialchars($post['title']); ?> </h5>
                                <p class="card-text">Desc: <?php echo htmlspecialchars($post['description']); ?> </p>
                                <small>Created by: <?php echo $post['first_name']. " ".$post['last_name'];?></small>
                                <br>
                                <small class="card-text">Created on: <?php echo $post['created_at']; ?> </small>
                                <br>
                                <?php
                                    if($_SESSION['id_user'] == $post['id_user']){
                                        ?>
                                        <a href="/social-network-db/post_edit.php?post_id=<?php echo $post['id_post']?>">Edit</a>  |  <a href="/social-network-db/post_delete_logic.php?post_id=<?php echo $post['id_post']?>" style="color: red;">Delete</a>
                                        <?php
                                    }
                                ?>

                                <hr>
                            <?php
                        }
                    }
                         ?>
                </div>
            </div>
        </div>
    </center>
</body>

</html>