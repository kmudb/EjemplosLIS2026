<?php
declare(strict_types=1);

use App\Core\Database;
use App\Models\Categoria;
use App\Repositories\CategoriaRepository;


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
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if ($nombre === '') {
        redirectErr('El nombre de la categoría es obligatorio');
    }

    $db = Database::getConnection();
    $repo = new CategoriaRepository($db);

    $categoria = new Categoria(null, $nombre, $descripcion !== '' ? $descripcion : null);
    $repo->create($categoria);

    redirectOk('Categoría creada correctamente');
} catch (Throwable $e) {
    redirectErr('Error al crear categoría: ' . $e->getMessage());
}