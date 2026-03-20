<?php
require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/controllers/UsuarioController.php";

$db = (new Database())->conectar();
$controller = new UsuarioController($db);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case "crear":
        $controller->crear();
        break;
    case "editar":
        $controller->editar();
        break;
    case "eliminar":
        $controller->eliminar();
        break;
    default:
        $controller->index();
        break;
}