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
        $auth_status = $user->authUser($username, $password);
        if($auth_status)
        {
            session_start();
            $_SESSION['user'] = $user->getUserId();
            $_SESSION['role'] = $user->getUserRole();
        }
        echo json_encode(['auth_status' => $auth_status, 'user'=>$user->getUserId(), 'role' => $user->getUserRole()]);
    }

    public function logout()
    {
        session_start();
        unset($_SESSION["user"]);
        unset($_SESSION["role"]);
        echo json_encode(['logout' => !isset($_SESSION["user"]) && !isset($_SESSION["role"])]);
    }

    public function deactivate()
    {
        session_start();
        $user = new User($user_id = $_SESSION['user']);
        if($user->deactivate())
        {
            echo json_encode(['deactivated' => true]);
            unset($_SESSION["user"]);
            unset($_SESSION["role"]);
        }
        else
        {
            echo json_encode(['deactivated' => false]);
        }
    }

    public function update()
    {
        session_start();
        $user = new User();
        if($user->update())
        {

        }
        else
        {

        }
    }

    public function getProfile($userId)
    {
        session_start();
        
        // ID del usuario en sesión
        $currentUserId = $_SESSION['user'] ?? null;

        // Si no hay ID en la URL, usamos el ID de la sesión (es decir, se quiere el perfil personal)
        if (is_null($userId)) {
            $userId = $currentUserId;
        }
        $user = new User($userId);
        $user->getUser($userId === $currentUserId);
        try
        {
            echo json_encode(['user_info' => $user->toArray()]);
        }
        catch(exception $e)
        {
            error_log($e . "\r\n", 3, "../logs/error_logs.log");
            echo json_encode(['error' => $e]);
        }
    }
}

?>