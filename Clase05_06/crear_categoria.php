<?php
require __DIR__ . '/db.php';

$nombre = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if ($nombre === '') {
    header('Location: index.php?err=El%20nombre%20de%20la%20categor%C3%ADa%20es%20obligatorio');
    exit;
}

try {
    $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion ?: null
    ]);
    header('Location: index.php?ok=Categor%C3%ADa%20creada%20correctamente');
} catch (Throwable $e) {
    header('Location: index.php?err=' . rawurlencode('Error al crear categoría: ' . $e->getMessage()));
}