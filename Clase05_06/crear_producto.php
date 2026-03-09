<?php
require __DIR__ . '/db.php';

$nombre       = trim($_POST['nombre'] ?? '');
$precio       = $_POST['precio'] ?? '';
$stock        = $_POST['stock'] ?? '';
$categoria_id = $_POST['categoria_id'] ?? '';

if ($nombre === '' || $precio === '' || $stock === '' || $categoria_id === '') {
    header('Location: index.php?err=Todos%20los%20campos%20del%20producto%20son%20obligatorios');
    exit;
}

if (!is_numeric($precio) || $precio < 0 || !ctype_digit((string)$stock) || (int)$stock < 0 || !ctype_digit((string)$categoria_id)) {
    header('Location: index.php?err=Datos%20inv%C3%A1lidos%20en%20producto');
    exit;
}

try {
    // Verificar que la categoría exista
    $chk = $pdo->prepare("SELECT id FROM categorias WHERE id = :id");
    $chk->execute([':id' => $categoria_id]);
    if (!$chk->fetch()) {
        header('Location: index.php?err=La%20categor%C3%ADa%20no%20existe');
        exit;
    }

    $sql = "INSERT INTO productos (nombre, precio, categoria_id, stock)
            VALUES (:nombre, :precio, :categoria_id, :stock)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre'       => $nombre,
        ':precio'       => number_format((float)$precio, 2, '.', ''),
        ':categoria_id' => (int)$categoria_id,
        ':stock'        => (int)$stock
    ]);
    header('Location: index.php?ok=Producto%20creado%20correctamente');
} catch (Throwable $e) {
    header('Location: index.php?err=' . rawurlencode('Error al crear producto: ' . $e->getMessage()));
}