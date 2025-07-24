<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($userId) {
    $payload = [
        'sub' => $userId,
        'iat' => time(),
        'exp' => time() + (60 * 60) // 1 hour
    ];
    return JWT::encode($payload, JWT_SECRET, 'HS256');
}

function validateJWT($token) {
    try {
        return JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
    } catch (Exception $e) {
        return null;
    }
}