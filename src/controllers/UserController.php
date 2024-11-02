<?php
require_once '../src/models/User.php';
header('Content-Type: application/json');

class UserController
{
    public function register() 
    {
        // Lógica de registro
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo json_encode(['status' => 'success', 'success' => true]);

    }
}