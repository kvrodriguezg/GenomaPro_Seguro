<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService {
    private static $secretKey;

    public function __construct() {
        self::$secretKey = $_ENV['JWT_SECRET'];
    }

    public function createToken($data) {
        $payload = [
            'iat' => time(),
            'exp' => time() + (60*60), // 1 hora
            'data' => $data
        ];

        return JWT::encode($payload, self::$secretKey, 'HS256');
    }

    public function validateToken($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$secretKey, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    }
}
