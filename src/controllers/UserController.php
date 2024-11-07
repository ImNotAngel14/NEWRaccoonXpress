<?php
require_once '../src/models/User.php';
header('Content-Type: application/json');

class UserController
{
    public function register() 
    {
        // Lógica de registro
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_role = $_POST['user_role'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $birth_date = $_POST['birth_date'];
        $user = new User();
        $success = $user->registerUser($email, $username, $password, $user_role, $first_name, $last_name, $gender, $birth_date);
        echo json_encode(['status' => $username, 'success' => $success]);
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User();
        $found_user = $user->authUser($username, $password);
        echo json_encode(['auth_status'=>$found_user]);
    }
}

?>