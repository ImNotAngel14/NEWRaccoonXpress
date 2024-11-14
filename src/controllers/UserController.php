<?php
    class UserController
    {
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
                    session_start();
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
            if (isset($_POST['username']) && isset($_POST['password'])) 
            {
                
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $birth_date = $_POST['birth_date'];
                $gender = $_POST['gender'];
                $user_role = $_POST['user_role'];
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

        }

        public function Logout()
        {
            session_start();
            unset($_SESSION["user"]);
            unset($_SESSION["role"]);
            echo json_encode(['logout' => !isset($_SESSION["user"]) && !isset($_SESSION["role"])]);
        }

        public function ShowProfile()
        {
            echo json_encode(['xd' => "Hola"]);
            exit;
        }

        public function GetUser()
        {
            if (isset($_GET['userId']) && isset($_GET['isOwner']))
            {
                $url = "http://localhost/NEWRaccoonXpress/api/usersAPI.php?action=user&userId=".$_GET['userId']."&isOwner=".$_GET['isOwner'];

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
            else
            {
                return ['user_info' => null, 'message' => 'Error al obtener la información'];
            }
        }
    }
?>