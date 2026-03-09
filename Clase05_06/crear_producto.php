<?php
require __DIR__ . '/db.php';

$nombre = trim($_POST['nombre']);
$precio = $_ $mysqli->prepare(
   "INSERT INTO productos (nombre, precio, categoria_id, stock)
    VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("sdii", $nombre, $precio, $categoria_id, $stock);
$stmt->execute();

header("Location: index.php");