<?php
declare(strict_types=1);

use App\Core\Database;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProductoRepository;

$APP = dirname(__DIR__); // C:\...\Clase05_06\app

require_once $APP . '/config.php';
require_once $APP . '/core/Database.php';
require_once $APP . '/models/Categoria.php';
require_once $APP . '/models/Producto.php';
require_once $APP . '/repositories/CategoriaRepository.php';
require_once $APP . '/repositories/ProductoRepository.php';


$db = Database::getConnection();
$catRepo = new CategoriaRepository($db);
$prodRepo = new ProductoRepository($db);

$categorias = $catRepo->all();
$productos  = $prodRepo->allWithCategoria();

$ok  = isset($_GET['ok'])  ? htmlspecialchars($_GET['ok'])  : null;
$err = isset($_GET['err']) ? htmlspecialchars($_GET['err']) : null;
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Tienda PHP 8 – MySQLi (POO)</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Icons opcional -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><i class="bi bi-bag"></i> Tienda PHP 8 (MySQLi + POO)</a>
  </div>
</nav>

<main class="container py-4">

  <?php if ($ok): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $ok ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php elseif ($err): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $err ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="row g-4">

    <!-- Crear Categoría -->
    <div class="col-12 col-lg-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-tags"></i> Nueva Categoría</h5>
          <form action="actions/crear_categoria.php" method="post" class="mt-3">
            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" required maxlength="100">
            </div>
            <div class="mb-3">
              <label class="form-label">Descripción</label>
              <input type="text" name="descripcion" class="form-control" maxlength="255" placeholder="Opcional">
            </div>
            <button class="btn btn-primary w-100" type="submit"><i class="bi bi-plus-circle"></i> Crear</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Crear Producto -->
    <div class="col-12 col-lg-8">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-box-seam"></i> Nuevo Producto</h5>
          <form action="actions/crear_producto.php" method="post" class="row g-3 mt-1">
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" required maxlength="150">
            </div>
            <div class="col-md-3">
              <label class="form-label">Precio</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" min="0" name="precio" class="form-control" required>
              </div>
            </div>
            <div class="col-md-3">
              <label class="form-label">Stock</label>
              <input type="number" min="0" name="stock" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <select name="categoria_id" class="form-select" required>
                <option value="" hidden>Selecciona...</option>
                <?php foreach ($categorias as $c): ?>
                  <option value="<?= (int)$c->id ?>"><?= htmlspecialchars($c->nombre) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-12">
              <button class="btn btn-success" type="submit"><i class="bi bi-check2-circle"></i> Guardar Producto</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Tabla de Productos -->
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-table"></i> Productos</h5>
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Producto</th>
                  <th>Categoría</th>
                  <th class="text-end">Precio</th>
                  <th class="text-end">Stock</th>
                  <th>Creado</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($productos) === 0): ?>
                  <tr><td colspan="6" class="text-center text-muted">Sin productos todavía.</td></tr>
                <?php else: ?>
                  <?php foreach ($productos as $p): ?>
                    <tr>
                      <td><?= (int)$p['id'] ?></td>
                      <td><?= htmlspecialchars($p['nombre']) ?></td>
                      <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><?= htmlspecialchars($p['categoria']) ?></span></td>
                      <td class="text-end">$<?= number_format((float)$p['precio'], 2) ?></td>
                      <td class="text-end"><?= (int)$p['stock'] ?></td>
                      <td><small class="text-muted"><?= htmlspecialchars((string)$p['creado_en']) ?></small></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
</main>

<footer class="text-center py-4 text-muted">
  <small>Ejemplo PHP 8 + MySQLi + POO · © <?= date('Y') ?></small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>