<?php
    require_once "UserController.php";
    class HomeController
    {
        public function Landing_page()
        {
            require "src/views/landing_page.php";
        }

        public function Home()
        {
            // Llamar al usuario para obtener su foto de perfil
            // Imprimir su foto de perfil en el view
            $userController = new UserController();
            $user = $userController->GetUser();
            if(isset($user["user_info"]))
            {
                echo json_encode(["message" => $user["message"]]);    
            }
            else{
                echo json_encode(["username" => $user["user_info"]["username"]]);
            }
            exit;
            $username = $user["user_info"]["username"];
            $profileImage = isset($user["user_info"]["profile_image"]) ? $user["user_info"]["profile_image"] : "/NewRaccoonXpress/src/views/assets/no-profile-user.png";
            require "src/views/home.php";
        }
    }
?>