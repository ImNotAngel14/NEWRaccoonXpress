<?php
require 'api/middleware.php';
class Router
{
    public static function route($controller, $action)
    {
        $publicRoutes = [
            'user' => ['showLogin', 'showRegister', 'login', 'register', 'getUser', 'showProfile'],
            'home' => ['landing_page']
        ];

        if (!(isset($publicRoutes[$controller]) && in_array($action, $publicRoutes[$controller]))) {
            AuthMiddleware::handle();
        }

        $controllerClass = ucfirst($controller) . 'Controller';
        $controllerFile = "src/controllers/$controllerClass.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerClass)) {
                $controllerObject = new $controllerClass();
                
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                } else {
                    self::error404("Método $action no encontrado en el controlador $controllerClass.");
                }
            } else {
                self::error404("Clase $controllerClass no encontrada.");
            }
        } else {
            self::error404("Controlador $controllerClass no encontrado.");
        }
    }

    private static function error404($message = "Página no encontrada")
    {
        header("HTTP/1.0 404 Not Found");
        echo $message;
    }
}
?>
