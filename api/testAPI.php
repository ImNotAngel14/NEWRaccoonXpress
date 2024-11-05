<?php
require  '../src/controllers/UserController.php';
//$controller = new UserController();
$method = $_SERVER['REQUEST_METHOD'];
$controller = new UserController();
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    
    $controller->register();
    exit;
}
?>