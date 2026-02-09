<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Registro de Usuario</h4>
                </div>

                <div class="card-body">
                    <form method="POST" novalidate>

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Karens Medrano" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="8 dígitos" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                            <div class="form-text">
                                Mayúscula, número y símbolo.
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Registrar
                        </button>
                    </form>
                </div>
            </div>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                require_once "Validador.php";

                $validador = new Validador($_POST);
                $resultado = $validador->procesar();

                if (!empty($resultado['errores'])) {
                    echo "<div class='alert alert-danger mt-4'>";
                    echo "<h6>Errores encontrados:</h6><ul class='mb-0'>";
                    foreach ($resultado['errores'] as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul></div>";
                } else {
                    echo "<div class='alert alert-success mt-4'>";
                    echo "<h6>Registro exitoso</h6>";
                    echo "<pre class='mb-0'>";
                    print_r($resultado['datos']);
                    echo "</pre></div>";
                }
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>
