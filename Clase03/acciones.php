<?php
session_start();
require_once "Inventario.php";

if (!isset($_SESSION['inventario'])) {
    $_SESSION['inventario'] = [];
}

$accion = $_POST['accion'] ?? $_GET['accion'] ?? '';

/* CREATE */
if ($accion == 'guardar') {
    $producto = new Inventario(
        $_POST['codigo'],
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['cantidad']
    );

    $_SESSION['inventario'][] = $producto;
    header("Location: index.php");
}

/* DELETE */
if ($accion == 'eliminar') {
    $index = $_GET['index'];
    unset($_SESSION['inventario'][$index]);
    $_SESSION['inventario'] = array_values($_SESSION['inventario']);
    header("Location: index.php");
}

/* UPDATE */
if ($accion == 'actualizar') {
    $index = $_POST['index'];

    $_SESSION['inventario'][$index] = new Inventario(
        $_POST['codigo'],
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['cantidad']
    );

    header("Location: index.php");
}
