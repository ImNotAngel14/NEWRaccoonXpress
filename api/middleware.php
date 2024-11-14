<?php
class AuthMiddleware {
    // Método para verificar si el usuario está autenticado
    public static function handle() {
        session_start();
        if (!isset($_SESSION['user'])) {
            // Redirigir al usuario a la página de login si no está autenticado
            unset($_SESSION["user"]);
            unset($_SESSION["role"]);
            header("Location: index.php?controller=home&action=landing_page");
            exit();
        }
    }
}
?>
