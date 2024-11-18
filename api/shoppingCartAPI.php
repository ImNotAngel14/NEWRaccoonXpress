<?php
require_once '../src/models/ShoppingCartModel.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        switch($_GET['action'])
        {
            case 'addItem':
                $success = false;
                if(isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity']))
                {
                    $userId = $_POST['user_id'];
                    $productId = $_POST['product_id'];
                    $quantity = $_POST['quantity'];
                    $shoppingCartModel = new ShoppingCartModel();
                    $success = $shoppingCartModel->addShoppingCartItem($userId, $productId);
                }
                echo json_encode(['success' => $success]);
                break;
            case 'itemQuantityUp':
                $success = false;
                if(isset($_POST['user_id']) && isset($_POST['product_id']))
                {
                    $userId = $_POST['user_id'];
                    $productId = $_POST['product_id'];
                    $shoppingCartModel = new ShoppingCartModel();
                    $success = $shoppingCartModel->addShoppingCartItem($userId, $productId);
                }
                echo json_encode(['success' => $success]);
                break;
            case 'itemQuantityDown':
                $success = false;
                if(isset($_POST['user_id']) && isset($_POST['product_id']))
                {
                    $userId = $_POST['user_id'];
                    $productId = $_POST['product_id'];
                    $shoppingCartModel = new ShoppingCartModel();
                    $success = $shoppingCartModel->DecreaseProductQuantity($userId, $productId);
                }
                echo json_encode(['success' => $success]);
                break;
            case 'handleItemQuantity':
                $success = false;
                if (session_status() === PHP_SESSION_NONE) 
                {
                    session_start();
                }
                if(isset($_SESSION['user']) && isset($_POST['product_id']) && isset($_POST['operation']))
                {
                    $userId = $_SESSION['user'];
                    $productId = $_POST['product_id'];
                    $operation = (bool)$_POST['operation'];
                    $shoppingCartModel = new ShoppingCartModel();
                    $success = ($operation) ? 
                        $shoppingCartModel->addShoppingCartItem($userId, $productId)
                        : $shoppingCartModel->DecreaseProductQuantity($userId, $productId);
                }
                echo json_encode(['success' => $success]);
                break;
            case 'updateItem':
                break;
            case 'deleteItem':
                break;
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
exit;
?>