<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/ShoppingCart.php";
    class ShoppingCartController
    {
        private $shoppingCartModel;
        public function ShowShoppingCart()
        {
            if(isset($_SESSION['user']))
            {
                $user_id = $_SESSION['user'];
                $shoppingCartModel = new ShoppingCart();
                $shoppingCartItems = $shoppingCartModel->getShoppingCartItems((int)$user_id);                
            }
            // Obtenemos una lista de los productos que estan en el carrito del usuario
            require "src/views/shoppingCart.php";   
        }

        public function AddProductToShoppingCart()
        {
            
        }

        public function QuitProductFromShoppingCart()
        {

        }
    }
?>