<?php

    require_once 'db.php';

    function isUserLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    function doesUserExistByEmail($email){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM `users` WHERE email = :email";
        
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":email", $email);
    
        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user !== false){
            return true;
            }
        }else{
            return false;
        }
    
    }

    function findUserByEmailAndPassword($email, $password){
        global $dbConnection;
    
        $sqlQuery = "SELECT * FROM users WHERE email = :email AND password = :password";
        
        $encryptedPassword = md5($password);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $encryptedPassword);

        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user != false){
                return $user;
            }
        }
        return null;
    }
     

    

    function storeUserToFile(array $user){
       global $dbConnection;
        $sqlQuery = " INSERT INTO `users` (`first_name`,`last_name`, `email`, `password`)
        VALUES (:firstName, :lastName, :email, :password); ";

        $encryptedPassword = md5($user['password']);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":firstName", $user['first_name']);
        $statement->bindParam(":lastName", $user['last_name']);
        $statement->bindParam(":email", $user['email']);
        $statement->bindParam(":password", $encryptedPassword);
        
        if($statement->execute()){
            return true;
        }else{
            echo "Wrong!"; 
            die();
            return false;
        }
    }

    function getAllUserPosts(){
        global $dbConnection;

        $sqlQuery = "SELECT posts.*, users.first_name, users.last_name FROM posts INNER JOIN users ON users.id_user = posts.id_user order by created_at DESC";
        $statement = $dbConnection->prepare($sqlQuery);
        
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function signOut(){
        session_start();
        session_destroy();
    }

    //function to store posts in file

    
    function storePostToFile(array $post, $userId){
        global $dbConnection;
        $sqlQuery = " INSERT INTO `posts` (`title`,`description`, `id_user`)
        VALUES (:title, :description, :userId); ";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":title", $post['title']);
        $statement->bindParam(":description", $post['description']);
        $statement->bindParam(":userId", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }


    function getUserPosts($userId) {
        global $dbConnection;

        $sqlQuery = "SELECT * FROM posts WHERE id_user = :userId order by created_at DESC";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":userId", $userId);
        
        if($statement->execute()){
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }
        
    }

    function deletePostByIdAndUser($postId, $userId){
        global $dbConnection;

        $sqlQuery = "DELETE FROM `posts` WHERE `id_post`=:id_post AND `id_user`=:id_user;";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":id_post", $postId);
        $statement->bindParam(":id_user", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }

    }

    function updatePost($postId, $userId, $title, $description){
        global $dbConnection;
        
        $sqlQuery = "UPDATE `posts` SET `title`=:title, `description`=:description WHERE `id_post`=:id_post AND `id_user`=:id_user;";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":id_post", $postId);
        $statement->bindParam(":id_user", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function getPostByIdAndUser($postId, $userId){
        global $dbConnection;
        $sqlQuery = "SELECT * FROM posts WHERE id_post=:id_post AND id_user=:id_user";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':id_post', $postId);
        $statement->bindParam(':id_user', $userId);

        if($statement->execute()){
            $post = $statement->fetch(PDO::FETCH_ASSOC);
            if($post !== false){
                return $post;
            }
        }
        return null;
    }
?>