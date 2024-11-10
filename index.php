<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["AUTH"])) {
    // No hay sesion iniciada
    header("Location: src/views/landing_page.php");
    //
} else {
    header("Location: src/views/home.php");
}
?>