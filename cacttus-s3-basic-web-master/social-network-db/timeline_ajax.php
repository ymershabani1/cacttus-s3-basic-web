<?php
session_start();
require_once "util.php";
// if not logged in then redirect to login.php
if (!isUserLoggedIn()) {
    header("Location: /social-network-db/index_ajax.php");
    die();
}

?>
<html>

<head>
    <title>Cacttus Social Network | Timeline</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <center>
        Welcome <b><?php echo $_SESSION['first_name'] ?></b>
        <a href="#" id="signout_anchor">Sign out!</a>
        <br>
        <form class="col-6" method="POST" action="/social-network-db/posts_logic.php">
            <h2>New Post:</h2><br>
            <label>Title:</label><br>
            <input type="text" class="form-control" name="title" /><br>
            <label>Description:</label><br>
            <textarea class="form-control" rows="5" cols="40" name="description">

            </textarea>
            <br><br>
            <input id="submitBtn" type="submit" class="btn btn-success" value="Save" />
        </form>

        <div class="card">
            <div class="card-header">
                Recent Posts | From newest to oldest created
            </div>
            <div class="card-body">
                <div class="savedPosts" id="savedPosts" name="savedPosts">
                    Loading posts...
                </div>
            </div>
        </div>
    </center>
</body>
<script>
    $("#signout_anchor").click(function() {
        const apiEndpoint = "http://cacttus-s3-basic-web.test/social-network-db/signout_api.php";
        $.post(apiEndpoint, function(response) {
            location.reload();
        })
    });

    const noPostsTemplate = '<div class="alert alert-primary" role="alert">' +
        'Nuk ka postime te ketij shfrytezuesi.' +
        '</div>';
    const postTemplate = '<h5 class="card-title">Title: {{title}}</h5>' +
        '<small>{{publisher_name}}</small>' +
        '<p class="card-text">Desc: {{description}} </p>' +
        '<p>Date created: {{created_at}} </p>' +
        '<hr>';

    $(document).ready(function() {
        loadPosts();
    });

    function loadPosts() {
        const apiEndpoint = "http://cacttus-s3-basic-web.test/social-network-db/posts_api.php";
        $.get(apiEndpoint, function(response) {
            if (response.success == false || response.data.length == 0) {
                $("#savedPosts").html(noPostsTemplate);
            } else {
                let allPostsTemplate = "";
                for (let i = 0; i < response.data.length; i++) {
                    const currentPost = response.data[i];
                    allPostsTemplate += postTemplate.replace("{{title}}", escapeHtml(currentPost.title))
                        .replace("{{publisher_name}}", currentPost.first_name +
                            " " + currentPost.last_name)
                        .replace("{{description}}", escapeHtml(currentPost.description))
                        .replace("{{created_at}}", currentPost.created_at);
                }
                $("#savedPosts").html(allPostsTemplate);
            }
        });
    }

    function escapeHtml(str) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, function(m) {
            return map[m];
        });
    }
</script>

</html>