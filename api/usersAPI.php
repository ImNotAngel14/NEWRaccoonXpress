<?php
require_once '../src/controllers/UserController.php';

$method = $_SERVER['REQUEST_METHOD'];
$controller = new UserController();

switch ($method) {
    case 'POST':
        if ($_GET['action'] === 'login') {
            $controller->login();
        } elseif ($_GET['action'] === 'register') {
            $controller->register();
        }
        break;

    case 'GET':
        if ($_GET['action'] === 'profile') {
            $controller->getProfile();
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
