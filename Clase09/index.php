<?php
require_once __DIR__ . "../controllers/UsuarioController.php";


$controller = new UsuarioController();

if (isset($_POST["accion"])) {
    if ($_POST["accion"] == "login") $controller->login();
    if ($_POST["accion"] == "registrar") $controller->registrar();
} else {
    header("Location: views/login.php");
    exit();
}
?>