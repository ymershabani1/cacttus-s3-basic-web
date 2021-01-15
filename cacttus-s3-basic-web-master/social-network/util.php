<?php
    function isUserLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    function doesUserExistByEmail($email){
        $users = getUsers();

        foreach($users as $user){
            if($email == $user['email']){
                return true;
            }
        }

        return false;
    }

    function findUserByEmailAndPassword($email, $password){
        $users = getUsers();

        foreach($users as $user){
            if($email == $user['email'] && $password == $user['password']){
                return $user;
            }
        }

        return null;
    }

    

    function storeUserToFile(array $user){
        $users = getUsers();
        $users[] = $user;
        file_put_contents("users.db", json_encode($users));
    }

    function getUsers(){
        $users = [];

        if (file_exists("users.db")) {
            $fileContent = file_get_contents("users.db");
            $users = json_decode($fileContent, true);
        }

        return $users;
    }

    function signOut(){
        session_start();
        session_destroy();
    }

    //function to store posts in file

    
    function storePostToFile(array $post, $email){
        $users = getUsers();
        $userIndex = -1;

        for($i=0; $i<count($users); $i++){
            if($users[$i]['email'] == $email){
                $userIndex = $i;
                break;
            }
        }

        if($userIndex == -1){
            return;
        }

        $users[$userIndex]['posts'][] = $post;
        file_put_contents("users.db", json_encode($users));
    }

    function getPosts(){
        $posts = [];

        if (file_exists("posts.db")) {
            $postContent = file_get_contents("posts.db");
            $posts = json_decode($postContent, true);
        }

        return $posts;
    }

    function getUserPosts($email) {
        $users = getUsers();

        foreach ($users as $user) {
            if($user['email'] == $email){
                return array_reverse($user['posts']);
            }
        }

        return [];
    }


?>