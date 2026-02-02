<?php
require_once "Inventario.php"; //  ESTO ES CLAVE
session_start();
$inventario = $_SESSION['inventario'] ?? [];
$editar = isset($_GET['edit']);
$productoEdit = $editar ? $inventario[$_GET['edit']] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <?= $editar ? "Editar Producto" : "Nuevo Producto"; ?>
        </div>
        <div class="card-body">
            <form action="acciones.php" method="POST">
                <input type="hidden" name="accion" value="<?= $editar ? 'actualizar' : 'guardar'; ?>">
                <?php if ($editar): ?>
                    <input type="hidden" name="index" value="<?= $_GET['edit']; ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="codigo" class="form-control" placeholder="Código"
                               value="<?= $productoEdit?->getCodigo(); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre"
                               value="<?= $productoEdit?->getNombre(); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" step="0.01" min="0" placeholder="0.00" name="precio" class="form-control" placeholder="Precio"
                               value="<?= $productoEdit?->getPrecio(); ?>" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad"
                               value="<?= $productoEdit?->getCantidad(); ?>" required>
                    </div>
                </div>

                <button class="btn btn-success mt-3">
                    <?= $editar ? "Actualizar" : "Guardar"; ?>
                </button>
            </form>
        </div>
    </div>

    <!-- TABLA -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Inventario Registrado
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($inventario as $i => $p): ?>
                <tr>
                    <td><?= $i+1; ?></td>
                    <td><?= $p->getCodigo(); ?></td>
                    <td><?= $p->getNombre(); ?></td>
                    <td>$<?= $p->getPrecio(); ?></td>
                    <td><?= $p->getCantidad(); ?></td>
                    <td><strong>$<?= $p->getTotal(); ?></strong></td>
                    <td>
                        <a href="index.php?edit=<?= $i; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="acciones.php?accion=eliminar&index=<?= $i; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Eliminar producto?')">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

</div>
</body>
</html>
