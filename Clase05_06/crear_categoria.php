<?php
require __DIR__ . '/db.php';

$nombre = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if ($nombre === '') {
    die("Nombre obligatorio");
}

$stmt = $mysqli->prepare("INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)");
$stmt->bind_param("ss", $nombre, $descripcion);
$stmt->execute();

header("Location: index.php");