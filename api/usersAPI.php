<?php
require_once '../src/models/User.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        switch($_GET['action'])
        {
            case 'login':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $user = new User();
                $auth_status = $user->authUser($username, $password);
                echo json_encode(['auth_status' => $auth_status, 'user'=>$user->getUserId(), 'role' => $user->getUserRole()]);
                break;
            case 'register':
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
                echo json_encode(['success' => $success]);
                break;
            case 'deactivate':
                // validar que este setteado userId
                if(!isset($_GET['userId']))
                {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'error'=>"Faltan parametros en la llamada de la API"]);
                    break;
                }
                $user = new User($_GET['userId']);
                echo json_encode(['success' => true, 'deactivated' => $user->deactivate()]);
                break;
            case 'update':
                ////id, email, password, role, nombre, apellido, genero, cumple, visibili, activo, last, profile
                $user = new User();
                $user->setUserId($_POST['user_id']);
                $user->setEmail($_POST['email']);
                $user->setUsername($_POST['username']);
                $user->setUserPassword($_POST['password']);
                $user->setFirstName($_POST['first_name']);
                $user->setLastName($_POST['last_name']);
                $user->setGender($_POST['gender']);
                $user->setBirthDate($_POST['birth_date']);
                $user->setVisibility($_POST['visibility']);
                $user->setProfileImage(isset($_POST['profile_image']) ? $_POST['profile_image'] : null);
                echo json_encode(['success' => $user->update()]);
                break;
            //case 'update':
            //    
            //    break;
        }
        break;

    case 'GET':
        switch($_GET['action'])
        {
            case 'user':
                // validar que este setteado userId e isOwner
                if(!isset($_GET['userId']) || !isset($_GET['isOwner']))
                {
                    http_response_code(400);
                    echo json_encode(['error'=>"Faltan parametros en la llamada de la API"]);
                    break;
                }
                // ID del usuario en sesión
                $userId = $_GET['userId'];
                // Bandera de si el usuario esta setteado o no
                $isOwner = $_GET['isOwner'];
                $user = new User($userId);
                $user->getUser($isOwner);
                echo json_encode(['user_info' => $user->toArray()]);
                break;
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
exit;
?>