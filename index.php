<?php
    header("Location: src/views/home.php");
?>
<?php
    require_once '../src/controllers/UserController.php';
    
    $method = $_SERVER['REQUEST_METHOD'];
    $controller = new UserController();
    
    switch ($method) {
        case 'POST':
            switch($_GET['action'])
            {
                case 'login':
                    $controller->login();
                    break;
                case 'register':
                    $controller->register();
                    break;
                case 'logout':
                    $controller->logout();
                    break;
                case 'deactivate':
                    $controller->deactivate();
                    break;
                case 'update':
                    $controller->update();
                    break;
            }
            break;
    
        case 'GET':
            switch($_GET['action'])
            {
                case 'user':
                    $userId = isset($_GET['id']) ? (int)$_GET['id'] : null;
                    $controller->getProfile($userId); 
                    break;
            }
            break;
    
        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>