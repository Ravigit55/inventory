<?php 
header("Content-Type: application/json"); 
require_once 'auth.php';
require 'db.php';
$input = json_decode(file_get_contents("php://input"), true);
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
$token = str_replace('Bearer ', '', $authHeader);
$authenticatedUser = validateJWT($token);
$username = $input['name'] ?? null;
$password = $input['password'] ?? null;
$action = $_GET['action'] ?? null;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'login') {
    

    if ($username === 'admin' && $password  === 'admin123'){
        $token = generateJWT(1); // Replace 1 with actual user ID
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
    }
    exit;

}

?>