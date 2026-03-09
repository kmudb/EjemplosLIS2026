<?php require __DIR__ . '/db.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Tienda PHP 8 – MySQLi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Tienda PHP 8 (MySQLi)</a>
  </div>
</nav>

<div class="container py-4">

  <div class="row g-4">

    <!-- Crear categoría -->
    <div class="col-lg-4">
      <div class="card shadow">
        <div class="card-body">
          <h5>Nueva Categoría</h5>
          <form method="POST" action="crear_categoria.php">
            <label class="form-label">Nombre</label>
            <input name="nombre" class="form-control" required>

            <label class="form-label mt-2">Descripción</label>
            <input name="descripcion" class="form-control">

            <button class="btn btn-primary mt-3 w-100">Guardar</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Crear producto -->
    <div class="col-lg-8">
      <div class="card shadow">
        <div class="card-body">
          <h5>Nuevo Producto</h5>

          <?php
            $categorias = $mysqli->query("SELECT id, nombre FROM categorias ORDER BY nombre");
          ?>

          <form method="POST" action="crear_producto.php" class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input name="nombre" class="form-control" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Precio</label>
              <input type="number" step="0.01" min="0" name="precio" class="form-control" required>
            </div>

            <div class="col-md-3">
              <label class="form-label">Stock</label>
              <input type="number" min="0" name="stock" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <select name="categoria_id" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php while($c = $categorias->fetch_assoc()): ?>
                  <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="col-12">
              <button class="btn btn-success">Guardar Producto</button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <!-- Tabla productos -->
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body">
          <h5>Productos</h5>

          <?php
            $sql = "
              SELECT p.id, p.nombre, p.precio, p.stock, p.creado_en, c.nombre AS categoria
              FROM productos p
              INNER JOIN categorias c ON c.id = p.categoria_id
              ORDER BY p.creado_en DESC
            ";
            $productos = $mysqli->query($sql);
          ?>

          <table class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($productos->num_rows == 0): ?>
                <tr><td colspan="6" class="text-center">Sin productos</td></tr>
              <?php else: ?>
                <?php while($p = $productos->fetch_assoc()): ?>
                  <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['nombre'] ?></td>
                    <td><?= $p['categoria'] ?></td>
                    <td>$<?= $p['precio'] ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td><?= $p['creado_en'] ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php endif; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>