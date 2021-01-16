<?php

    require_once 'db.php';

    function storeUserToFile(array $user){
        global $dbConnection;

        $sqlQuery = "INSERT INTO `users`(`full_name`, `email`, `password`)
        VALUES (:fullName, :email, :password);";

        $encryptedPassword = md5($user['password']);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":fullName", $user['full_name']);
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

?>