<?php
$authToken = "ljdklvj32kjdjk23jkh4jkh34kjhjk345kh34kj5";

$token = isset($_GET['token']) ? $_GET['token'] : null;

$response = [
    'success' => false,
    'message' => 'Invalid Token!'
];

header('Content-Type: application/json');

if($token != $authToken){
    echo json_encode($response);
    die();
}

$response['success'] = true;
$response['message'] = 'Data';

echo json_encode($response);
die();
?>