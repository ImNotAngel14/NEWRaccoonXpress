<?php
    require_once 'router.php';

    $controller = $_GET['controller'] ?? 'home'; 
    $action = $_GET['action'] ?? 'home';

    // Pasa el controlador y acción solicitados al enrutador
    Router::route($controller, $action);
?>
