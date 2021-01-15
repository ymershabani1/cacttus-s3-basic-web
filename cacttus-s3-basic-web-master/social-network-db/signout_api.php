<?php
    header('Content-Type: application/json');
    
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo json_encode([
            'success' => false,
            'message' => 'POST HTTP Method required!'
        ]);
        die();
    }


    require_once "util.php";
    signOut();
    
    echo json_encode([
        "success" => true,
        "message" => "User session is destroyed!"
    ]);
    die();
?>