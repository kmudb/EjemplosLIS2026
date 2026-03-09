<?php
declare(strict_types=1);

use App\Core\Database;
use App\Models\Producto;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProductoRepository;



$APP = dirname(__DIR__, 2);

require_once $APP . '/config.php';
require_once $APP . '/core/Database.php';
require_once $APP . '/models/Categoria.php';
require_once $APP . '/repositories/CategoriaRepository.php';
// y para producto:
require_once $APP . '/models/Producto.php';
require_once $APP . '/repositories/ProductoRepository.php';


function redirectOk(string $msg): void {
    header('Location: ../index.php?ok=' . rawurlencode($msg));
    exit;
}
function redirectErr(string $msg): void {
    header('Location: ../index.php?err=' . rawurlencode($msg));
    exit;
}

try {
    $nombre       = trim($_POST['nombre'] ?? '');
    $precioStr    = trim($_POST['precio'] ?? '');
    $stockStr     = trim($_POST['stock'] ?? '');
    $categoriaStr = trim($_POST['categoria_id'] ?? '');

    // Validaciones básicas
    if ($nombre === '' || $precioStr === '' || $stockStr === '' || $categoriaStr === '') {
        redirectErr('Todos los campos del producto son obligatorios');
    }

    if (!is_numeric($precioStr) || (float)$precioStr < 0) {
        redirectErr('Precio inválido');
    }
    if (!ctype_digit($stockStr) || (int)$stockStr < 0) {
        redirectErr('Stock inválido');
    }
    if (!ctype_digit($categoriaStr)) {
        redirectErr('Categoría inválida');
    }

    $precio = round((float)$precioStr, 2);
    $stock = (int)$stockStr;
    $categoriaId = (int)$categoriaStr;

    $db = Database::getConnection();
    $catRepo = new CategoriaRepository($db);

    // Verificar existencia de la categoría
    if (!$catRepo->existsById($categoriaId)) {
        redirectErr('La categoría seleccionada no existe');
    }

    $prodRepo = new ProductoRepository($db);
    $producto = new Producto(null, $nombre, $precio, $categoriaId, $stock);

    $prodRepo->create($producto);

    redirectOk('Producto creado correctamente');
} catch (Throwable $e) {
    redirectErr('Error al crear producto: ' . $e->getMessage());
}