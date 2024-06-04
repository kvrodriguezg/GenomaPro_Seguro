<?php

class AuthController {
    private $jwtService;

    public function __construct() {
        $this->jwtService = new JwtService();
    }

    public function login($username, $password) {
        // Aquí debes verificar el usuario y la contraseña, esto es solo un ejemplo.
        if ($username == 'usuario' && $password == 'contraseña') {
            $userData = ['id' => 1, 'username' => $username]; // Información del usuario
            $token = $this->jwtService->createToken($userData);
            echo json_encode(['token' => $token]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Credenciales incorrectas']);
        }
    }

    public function protectedRoute() {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $token = str_replace('Bearer ', '', $headers['Authorization']);
            $userData = $this->jwtService->validateToken($token);
            if ($userData) {
                echo json_encode(['message' => 'Acceso permitido', 'user' => $userData]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Token inválido']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Token no proporcionado']);
        }
    }
}
