<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/User.php";
    class UserController
    {
        private $userModel = null;

        public function ShowMyPurchases()
        {
            require "src/views/my_purchases.php";
        }

        public function ShowLogin()
        {
            require "src/views/login.php";
        }

        public function Login()
        {
            if (isset($_POST['username']) && isset($_POST['password'])) 
            {
                $username = $_POST['username'];
                $password = $_POST['password'];
                // La URL de la API local (ajusta la URL de acuerdo a tu configuración)
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=login";

                // Inicializa una sesión cURL
                $ch = curl_init();

                // Configura la solicitud cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que se devuelva la respuesta en vez de imprimirla
                curl_setopt($ch, CURLOPT_POST, true); // Hacemos una solicitud POST

                // Los datos a enviar a la API
                $data = [
                    'username' => $username,
                    'password' => $password
                ];

                // Añade los datos a la solicitud POST
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                // Ejecuta la solicitud y guarda la respuesta
                $response = curl_exec($ch);

                // Verifica si ocurrió algún error
                if ($response === false) {
                    echo "cURL Error: " . curl_error($ch);
                }

                // Cierra la sesión cURL
                curl_close($ch);

                // Procesa la respuesta, si la API devuelve JSON, por ejemplo:
                $data = json_decode($response, true);
                // Muestra la respuesta (esto depende de lo que haga tu API)
                if (isset($data['auth_status']) && $data['auth_status'] === true) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user'] = $data['user'];
                    $_SESSION['role'] = $data['role'];
                    echo json_encode(['auth_status' => true, 'user' => $data['user'], 'role' => $data['role']]);
                } else {
                    echo json_encode(['auth_status' => false, 'message' => 'Error en la autenticación']);
                }
                exit;
            }
            else
            {
                echo json_encode(['auth_status' => false, 'message' => 'No se recibieron los parámetros necesarios']);
                exit;
            }
        }

        public function ShowRegister()
        {
            require "src/views/register.php";
        }

        public function Register()
        {
            if (
                isset($_POST['username']) 
                && isset($_POST['password']) 
                && isset($_POST['email'])
                && isset($_POST['first_name'])
                && isset($_POST['last_name'])
                && isset($_POST['birth_date'])
                && isset($_POST['gender'])
                && isset($_POST['user_role'])
                ) 
            {
                
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $birth_date = $_POST['birth_date'];
                $gender = (int)$_POST['gender'];
                $user_role = (int)$_POST['user_role'];
                // La URL de la API local (ajusta la URL de acuerdo a tu configuración)
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=register";

                // Inicializa una sesión cURL
                $ch = curl_init();

                // Configura la solicitud cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que se devuelva la respuesta en vez de imprimirla
                curl_setopt($ch, CURLOPT_POST, true); // Hacemos una solicitud POST

                // Los datos a enviar a la API
                $data = [
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'birth_date' => $birth_date,
                    'gender' => $gender,
                    'user_role' => $user_role
                ];

                // Añade los datos a la solicitud POST
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                // Ejecuta la solicitud y guarda la respuesta
                $response = curl_exec($ch);

                // Verifica si ocurrió algún error
                if ($response === false) {
                    echo "cURL Error: " . curl_error($ch);
                }

                // Cierra la sesión cURL
                curl_close($ch);

                // Procesa la respuesta, si la API devuelve JSON, por ejemplo:
                $data = json_decode($response, true);
                // Muestra la respuesta (esto depende de lo que haga tu API)
                if (isset($data['success']) && $data['success'] === true) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error en el registro']);
                }
                exit;
            }
            else
            {
                echo json_encode(['auth_status' => false, 'message' => 'No se recibieron los parámetros necesarios']);
                exit;
            }
        }

        public function DeactivateUser()
        {
            if(isset($_SESSION['user']))
            {
                $currentUserId = (int)$_SESSION['user'];
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=deactivate&userId=$currentUserId";
                // Inicializa una sesión cURL
                $ch = curl_init();

                // Configura la solicitud cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que se devuelva la respuesta en vez de imprimirla
                curl_setopt($ch, CURLOPT_POST, true); // Hacemos una solicitud POST
                // Si tu API requiere algún dato (como credenciales), puedes agregarlo aquí

                // Ejecuta la solicitud y guarda la respuesta
                $response = curl_exec($ch);

                // Verifica si ocurrió algún error
                if ($response === false) {
                    echo json_encode(['success' => false, 'error' => curl_error($ch)]);
                    exit;
                }

                // Cierra la sesión cURL
                curl_close($ch);

                // Procesa la respuesta, si la API devuelve JSON, por ejemplo:
                $data = json_decode($response, true);

                // Si la API regresa algo como { "success": true, "auth_status": true, ... }
                if (isset($data['success'])) 
                {
                    if($data['deactivated'])
                    {
                        unset($_SESSION["user"]);
                        unset($_SESSION["role"]);
                        header("Location: index.php?controller=home&action=home");
                    }
                    else
                    {
                        echo json_encode(['deactivated' =>$data['deactivated']]);
                    }
                } else {
                    echo json_encode(['deactivated' => false, 'message' => 'Error de la API al regresar la respuesta.']);
                }
            }
        }

        public function Logout()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            unset($_SESSION["user"]);
            unset($_SESSION["role"]);
            header("Location: index.php");
            // echo json_encode(['logout' => !isset($_SESSION["user"]) && !isset($_SESSION["role"])]);
        }

        public function ShowProfile()
        {
            $user = UserController::GetUser();
            $username = $user['username'];
            if(isset($user['profile_image']))
            {
                $profileImage = "data:image/png;base64," . $user["profile_image"];
            }
            else
            {
                $profileImage = "/NewRaccoonXpress/src/views/assets/no-profile-user.png";
            }
            switch((int)$user['user_role'])
            {
                case 0: // Admin
                    $role = "Admin";
                    break;
                case 1: // Seller
                    $role = "Vendedor";
                    break;
                case 2: // Buyer
                    $role = "Comprador";
                    break;
            }
            $visibility = (int)$user['visibility'];
            $email = $user['email'];
            $firstname = $user['first_name'];
            $lastname = $user['last_name'];
            $birthdate = $user['birth_date'];
            $password = $user['user_password'];
            $gender = $user['gender'];
            require "src/views/profile.php";
        }

        public function GetUser()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if(isset($_SESSION['user']))
            {
                $currentUserId = (int)$_SESSION['user'];
                if(isset($_GET['userId']))
                {
                    $userId = (int)$_GET['userId'];
                }
                else
                {
                    $userId = $currentUserId;
                }
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=user&userId=$userId&isOwner=".($userId === $currentUserId)."";
                // Inicializa una sesión cURL
                $ch = curl_init();

                // Configura la solicitud cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que se devuelva la respuesta en vez de imprimirla
                // Si tu API requiere algún dato (como credenciales), puedes agregarlo aquí

                // Ejecuta la solicitud y guarda la respuesta
                $response = curl_exec($ch);

                // Verifica si ocurrió algún error
                if ($response === false) {
                    echo json_encode(['user_info' => null, 'error' => curl_error($ch)]);
                    exit;
                }

                // Cierra la sesión cURL
                curl_close($ch);

                // Procesa la respuesta, si la API devuelve JSON, por ejemplo:
                $data = json_decode($response, true);

                // Si la API regresa algo como { "success": true, "auth_status": true, ... }
                if (isset($data['user_info']) && $data['user_info'] != false) {
                    return $data['user_info'];
                } else {
                    return ['user_info' => null, 'message' => 'Error al obtener la información'];
                }
            }
        }

        public function UpdateUser()
        {
            if (
                isset($_POST['username']) 
                && isset($_POST['password']) 
                && isset($_POST['email'])
                && isset($_POST['first_name'])
                && isset($_POST['last_name'])
                && isset($_POST['birth_date'])
                && isset($_POST['gender'])
                ) 
            {
                if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK)
                {
                    $fileTmpPath = $_FILES['profile_image']['tmp_name'];
                    $imageData = file_get_contents($fileTmpPath);
                }
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $userId = (int)$_SESSION['user'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $birth_date = $_POST['birth_date'];
                $gender = (int)$_POST['gender'];
                $visibility = isset($_POST['visibility']);
                $profile_image = isset($imageData) ? $imageData : null;
                // La URL de la API local (ajusta la URL de acuerdo a tu configuración)
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=update";

                // Inicializa una sesión cURL
                $ch = curl_init();

                // Configura la solicitud cURL
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que se devuelva la respuesta en vez de imprimirla
                curl_setopt($ch, CURLOPT_POST, true); // Hacemos una solicitud POST

                // Los datos a enviar a la API
                $data = [
                    'user_id' => $userId,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'birth_date' => $birth_date,
                    'gender' => $gender,
                    'visibility' => $visibility,
                    'profile_image' => $profile_image
                ];
                // Añade los datos a la solicitud POST
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                // Ejecuta la solicitud y guarda la respuesta
                $response = curl_exec($ch);

                // Verifica si ocurrió algún error
                if ($response === false) {
                    echo "cURL Error: " . curl_error($ch);
                }

                // Cierra la sesión cURL
                curl_close($ch);

                // Procesa la respuesta, si la API devuelve JSON, por ejemplo:
                $data = json_decode($response, true);
                // Muestra la respuesta (esto depende de lo que haga tu API)
                if (isset($data['success'])) {
                    echo json_encode(['success' => (bool)$data['success']]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error en el registro']);
                }
                exit;
            }
            else
            {
                echo json_encode(['success' => false, 'message' => 'No se recibieron los parámetros necesarios']);
                exit;
            }
        }

        public function SearchUsers($search)
        {
            $userModel = new User();
            $users = $userModel->searchUsers($search);
            return $users;
        }
    }
?>