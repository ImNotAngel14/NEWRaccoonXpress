<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/controllers/UserController.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/controllers/ProductController.php";
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
            $username = $user["username"];
            if(isset($user["profile_image"]))
            {
                $profileImage = "data:image/png;base64," . $user["profile_image"];
            }
            else
            {
                $profileImage = "/NewRaccoonXpress/src/views/assets/no-profile-user.png";
            }
            $productController = new ProductController();
            $products = $productController->GetAllProducts();
            require "src/views/home.php";
        }

        public function test()
        {
            $productModel = new Product();
            $products = $productModel->getAllProducts();
            foreach($products as $product)
            {
                echo json_encode(["product" => $product['product_name']]);
            }
            exit;
        }
    }
?>