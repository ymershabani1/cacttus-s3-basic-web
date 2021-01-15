<?php
    require_once 'db.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendEmail(array $to, $subject, $messageHTML, $attachment = null)
    {
        require_once 'php-mailer/src/Exception.php';
        require_once 'php-mailer/src/PHPMailer.php';
        require_once 'php-mailer/src/SMTP.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.mailtrap.io";
        $mail->Port = "25"; // typically 587 
        $mail->SMTPSecure = 'tls'; // ssl is depracated
        $mail->SMTPAuth = true;
        $mail->Username = "f88850a80f4d3f";
        $mail->Password = "c3989b3ac67f46";
        $mail->setFrom("edon@test.com", "Edon Sekiraqa");
        foreach ($to as $receiver) {
            $mail->addAddress($receiver["email"], $receiver["name"]);
        }
        $mail->Subject = $subject;
        $mail->msgHTML($messageHTML); // remove if you do not want to send HTML email
        $mail->AltBody = 'HTML not supported';
        if ($attachment !== null) {
            $mail->addAttachment($attachment); //Attachment, can be skipped
        }

        $mail->send();
    }

    function isUserLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    function doesUserExistByEmail($email){
        global $dbConnection;

        return getUserByEmail($email) != null;
    }

    function getUserByEmail($email){
        global $dbConnection;

        $sqlQuery = "SELECT * FROM user WHERE email=:email";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':email', $email);
        if ($statement->execute()) {
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if($user !==  false){
                return $user;
            }
        }
        return null;
    }

    function findUserByEmailAndPassword($email, $password){
        global $dbConnection;

        $sqlQuery = "SELECT * FROM user WHERE email=:email
                         AND password=:password";
        $encryptedPassword = md5($password);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $encryptedPassword);

        if ($statement->execute()) {
           $user = $statement->fetch(PDO::FETCH_ASSOC);
           if($user !== false){
                return $user;
           }
        }
        return null;
    }


    function storeUserToFile(array $user){
        global $dbConnection;

        $sqlQuery = "INSERT INTO `user` 
            (`first_name`, `last_name`, `email`, `password`) 
            VALUES (:firstName, :lastName, :email, :password);";

        $encryptedPassword = md5($user['password']);
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":firstName", $user['first_name']);
        $statement->bindParam(":lastName", $user['last_name']);
        $statement->bindParam(":email", $user['email']);
        $statement->bindParam(":password", $encryptedPassword);
            
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function signOut(){
        session_start();
        session_destroy();
    }

    //function to store posts in file
    function storePostToFile(array $post, $userId){
        global $dbConnection;

        $sqlQuery = "INSERT INTO `post` (`title`, `description`, `user_id`) 
                        VALUES (:title, :description, :user_id);";

        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":title", $post['title']);
        $statement->bindParam(":description", $post['description']);
        $statement->bindParam(":user_id", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function deletePostByIdAndUserId($postId, $userId){
        global $dbConnection;

        $sqlQuery = "DELETE FROM `post` WHERE id=:id AND user_id=:user_id;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":id", $postId);
        $statement->bindParam(":user_id", $userId);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function getPostByIdAndUserId($postId, $userId){
        global $dbConnection;

        $sqlQuery = "SELECT * FROM `post` WHERE id = :post_id AND user_id=:user_id";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':post_id', $postId);
        $statement->bindParam(':user_id', $userId);

        if ($statement->execute()) {
            $post = $statement->fetch(PDO::FETCH_ASSOC);
            if($post !== false){
                return $post;
            }
        }
        return null;
    }

    function updateUserPassword($userId, $password){
        global $dbConnection;
        $hashedPassword = md5($password);
        $sqlQuery = "UPDATE `user` SET `password`=:password
                        WHERE id=:user_id;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':user_id', $userId);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function updatePost($postId, $userId, $title, $description){
        global $dbConnection;

        $sqlQuery = "UPDATE `post` SET `title`=:title, `description`=:description
                        WHERE id=:post_id AND user_id=:user_id;";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(':post_id', $postId);
        $statement->bindParam(':user_id', $userId);
        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);

        if($statement->execute()){
            return true;
        }else{
            return false;
        }
    }

    function getUserPosts($userId) {
        global $dbConnection;

        $sqlQuery = "SELECT * FROM `post` WHERE `user_id`=:user_id ORDER BY created_at DESC";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->bindParam(":user_id", $userId);

        if($statement->execute()){
            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        }else{
            return [];
        }
    }

function getAllUserPosts()
{
    global $dbConnection;

    $sqlQuery = "SELECT `post`.*, `user`.first_name, `user`.last_name FROM `post` 
                    INNER JOIN `user` ON `user`.id = `post`.user_id
                    ORDER BY created_at DESC";
    $statement = $dbConnection->prepare($sqlQuery);

    if ($statement->execute()) {
        $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    } else {
        return [];
    }
}
/**
 * Returns an encrypted & utf8-encoded
 */
function encrypt($pure_string, $encryption_key = "TheKey")
{
    $cipher     = 'AES-256-CBC';
    $options    = OPENSSL_RAW_DATA;
    $hash_algo  = 'sha256';
    $sha2len    = 32;
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($pure_string, $cipher, $encryption_key, $options, $iv);
    $hmac = hash_hmac($hash_algo, $ciphertext_raw, $encryption_key, true);
    return $iv . $hmac . $ciphertext_raw;
}
function decrypt($encrypted_string, $encryption_key = "TheKey")
{
    $cipher     = 'AES-256-CBC';
    $options    = OPENSSL_RAW_DATA;
    $hash_algo  = 'sha256';
    $sha2len    = 32;
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($encrypted_string, 0, $ivlen);
    $hmac = substr($encrypted_string, $ivlen, $sha2len);
    $ciphertext_raw = substr($encrypted_string, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $encryption_key, $options, $iv);
    $calcmac = hash_hmac($hash_algo, $ciphertext_raw, $encryption_key, true);
    if (function_exists('hash_equals')) {
        if (hash_equals($hmac, $calcmac)) return $original_plaintext;
    } else {
        if (hash_equals_custom($hmac, $calcmac)) return $original_plaintext;
    }
}

function hash_equals_custom($knownString, $userString)
{
    if (function_exists('mb_strlen')) {
        $kLen = mb_strlen($knownString, '8bit');
        $uLen = mb_strlen($userString, '8bit');
    } else {
        $kLen = strlen($knownString);
        $uLen = strlen($userString);
    }
    if ($kLen !== $uLen) {
        return false;
    }
    $result = 0;
    for ($i = 0; $i < $kLen; $i++) {
        $result |= (ord($knownString[$i]) ^ ord($userString[$i]));
    }
    return 0 === $result;
}


?>