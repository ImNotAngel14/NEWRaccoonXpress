<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/NEWRaccoonXpress/config/Database.php";
    class ShoppingCartModel
    {
        private $conn = null;
        private $shoppingCartId;
        private $quantity;
        private $productId;
        private $userId;

        public function __construct
        (
            $shoppingCartId = null,
            $quantity = null,
            $productId = null,
            $userId = null
        )
        {
            $this->shoppingCartId = $shoppingCartId;
            $this->quantity = $quantity;
            $this->productId = $productId;
            $this->userId = $userId;
        }

        public function removeShoppingCartItem($userId, $productId)
        {
            $sql = "CALL `sp_shopping_cart_management`(?, ?, 0, 3);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param
            (
                "ii",
                $userId,
                $productId
            );
            $stmt->execute();
            if ($stmt->error) {
                return false;
            }
            return true;
        }

        public function updateShoppingCartItem($userId, $productId, $quantity)
        {
            $sql = "CALL `sp_shopping_cart_management`(?, ?, ?, 2);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param
            (
                "iii",
                $userId,
                $productId,
                $quantity
            );
            $stmt->execute();
            if ($stmt->error) {
                return false;
            }
            return true;
        }

        public function addShoppingCartItem($userId, $productId, $quantity = 1)
        {
            $sql = "CALL `sp_shopping_cart_management`(?, ?, ?, 1);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param
            (
                "iii",
                $userId,
                $productId,
                $quantity
            );
            $stmt->execute();
            if ($stmt->error) {
                return false;
            }
            return true;
        }

        public function decreaseProductQuantity($userId, $productId)
        {
            // Query 
            $sql = "CALL `sp_shopping_cart_management`(?, ?, 0, 0);";
            $database = new Database();
            $this->conn = $database->connect();
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param
            (
                "ii",
                $userId,
                $productId
            );
            $stmt->execute();
            if ($stmt->error) {
                return false;
            }
            return true;
        }

        public function getShoppingCartItems($userId)
        {
            // Query para obtener los datos
            $sql = "SELECT `cart_quantity`, `user_id`, `product_id`, `product_name`, `price`, `product_quantity`, `image_1` FROM `shopping_cart_view` WHERE `user_id` = ?;";
            // Conexion a la base de datos
            $database = new Database();
            $this->conn = $database->connect();
            // Preparacion del script
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            // Ejecucion del script y resultado
            $stmt->execute();
            if ($stmt->error) {
                return null;
            }
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $shoppingCartItems = [];

                // Itera sobre los resultados y guárdalos en un arreglo
                while ($row = $result->fetch_assoc()) 
                {
                    $shoppingCartItems[] = $row;
                }
                return $shoppingCartItems;
            }
        }

        // Getters
        public function getShoppingCartId()
        {
            return $this->shoppingCartId;
        }

        public function getQuantity()
        {
            return $this->quantity;
        }

        public function getProductId()
        {
            return $this->productId;
        }

        public function getUserId()
        {
            return $this->userId;
        }

        // Setters
        public function setShoppingCartId($shoppingCartId)
        {
            $this->shoppingCartId = $shoppingCartId;
        }

        public function setQuantity($quantity)
        {
            if($quantity > 0)
            {
                $this->quantity = $quantity;
            }
        }

        public function setProductId($productId)
        {
            $this->productId = $productId;
        }

        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
    }
?>