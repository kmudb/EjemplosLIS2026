<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Nuevo Usuario
        </div>

        <div class="card-body">
            <form method="POST">
                
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>

                <button class="btn btn-success">Guardar</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>

            </form>
        </div>
    </div>
</div>

</body>
</html>