<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/src/models/ShoppingCartModel.php";
    class ShoppingCartController
    {
        private $shoppingCartModel;
        public function ShowShoppingCart()
        {
            if(isset($_SESSION['user']))
            {
                $user_id = $_SESSION['user'];
                $shoppingCartModel = new ShoppingCartModel();
                $shoppingCartItems = $shoppingCartModel->getShoppingCartItems((int)$user_id);                
            }
            // Obtenemos una lista de los productos que estan en el carrito del usuario
            require "src/views/shoppingCart.php";
        }

        public function CleanUserShoppingCart()
        {
            $userId = (int)$_SESSION['user'];
            $shoppingCartModel = new ShoppingCartModel();
            $shoppingCartModel->cleanShoppingCart($userId);
            header("Location: index.php?controller=shoppingCart&action=ShowShoppingCart");
        }

        public function addProduct()
        {
            $productId = (int)$_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            $userId = (int)$_SESSION['user'];
            $shoppingCartModel = new ShoppingCartModel();
            $shoppingCartModel->addShoppingCartItem($userId, $productId, $quantity);
            header("Location: index.php?controller=shoppingCart&action=ShowShoppingCart");
        }

        public function quantityDown()
        {
            $productId = (int)$_POST['product_id'];
            $userId = (int)$_SESSION['user'];
            $shoppingCartModel = new ShoppingCartModel();
            $shoppingCartModel->decreaseProductQuantity($userId, $productId);
        }

        public function UpdateShoppingCartItem()
        {
            $productId = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            $userId = (int)$_SESSION['user'];
            $shoppingCartModel = new ShoppingCartModel();
            $shoppingCartModel->updateShoppingCartItem($userId, $productId, $quantity);
        }

        public function RemoveShoppingCartItem()
        {
            $productId = (int)$_POST['product_id'];
            $userId = (int)$_SESSION['user'];
            $shoppingCartModel = new ShoppingCartModel();
            $shoppingCartModel->removeShoppingCartItem($userId, $productId);
        }
    }
?>