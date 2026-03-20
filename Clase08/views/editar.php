<!DOCTYPE html>
<html>
<head>
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning">Editar Usuario</div>

        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" class="form-control mb-2" required>
                <input type="email" name="correo" value="<?= $usuario['correo'] ?>" class="form-control mb-2" required>

                <button class="btn btn-success">Actualizar</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>