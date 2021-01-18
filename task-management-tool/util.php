<?php

    require_once 'db.php';

    function storeUserToFile(array $user){
        global $dbConnection;

        $sqlQuery = "INSERT INTO `users`(`fullName`, `email`, `password`)
        VALUES (:fullName, :email, :password);";

        $encryptedPassword = md5($user['password']);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":fullName", $user['fullName']);
        $statement->bindParam(":email", $user['email']);
        $statement->bindParam(":password", $encryptedPassword);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function isUserLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    function findUserByEmailAndPassword($email, $password){
        global $dbConnection;

        $sqlQuery = "SELECT * FROM `users` WHERE email=:email and password=:password";
        $encryptedPassword = md5($password);
        $statement = $dbConnection -> prepare($sqlQuery);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $encryptedPassword);

        if($statement->execute()){
            $user = $statement ->fetch(PDO::FETCH_ASSOC);
            if($user !== false){
                return $user;
            }
        }
        return null;
    }

    function doesUserExistByEmail($email){
        global $dbConnection;

        return getUserByEmail($email) != null;
    } 

    function getUserByEmail($email){
        global $dbConnection;

        $sqlQuery = "SELECT * FROM `users` WHERE email=:email";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement -> bindParam(':email', $email);
        if($statement->execute()){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user !== false){
                return $user;
            }
        }
        return null;
    }

    function storePostToFile(array $post, $userId){
        global $dbConnection;

        $sqlQuery = "INSERT INTO `tasks` (`title`, `description`,`status`, `user_id`)
                        VALUES (:title, :description, :status, :user_id);";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement ->bindParam(":title", $post['title']);
        $statement->bindParam(":description", $post['description']);
        $statement->bindParam(":status", $post['status']);
        $statement->bindParam(":user_id", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }

    }



?>