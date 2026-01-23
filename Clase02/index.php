<?php
session_start();

// ================================
// 1. INICIALIZAR ARREGLO EN SESIÓN
// ================================
if (!isset($_SESSION["estudiantes"])) {
    $_SESSION["estudiantes"] = [];
}

$mensaje = "";
$mostrarTabla = false;

// ================================
// 2. FUNCIÓN
// ================================
function esMayorDeEdad($edad) {
    return ($edad >= 18) ? "Sí" : "No";
}

// ================================
// 3. REGISTRO DE ESTUDIANTE
// ================================
if (isset($_POST["guardar"])) {

    $nombre  = $_POST["nombre"];
    $edad    = (int) $_POST["edad"];
    $carrera = $_POST["carrera"];

    if ($nombre == "" || $edad <= 0 || $carrera == "") {
        $mensaje = "❌ Complete todos los campos";
    } else {
        $_SESSION["estudiantes"][] = [
            "nombre" => $nombre,
            "edad" => $edad,
            "carrera" => $carrera
        ];
        $mensaje = "✅ Estudiante registrado correctamente";
    }
}

// ================================
// 4. BOTÓN VER TODOS
// ================================
if (isset($_POST["ver"])) {
    $mostrarTabla = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">📚 Registro de Estudiantes</h2>

    <!-- MENSAJE -->
    <?php if ($mensaje != ""): ?>
        <div class="alert alert-info text-center">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="POST">

                <div class="mb-2">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Carrera</label>
                    <select name="carrera" class="form-select">
                        <option value="">Seleccione</option>
                        <option>Ingeniería</option>
                        <option>Licenciatura</option>
                        <option>Técnico</option>
                    </select>
                </div>

                <button name="guardar" class="btn btn-primary w-100 mb-2">
                    Guardar estudiante
                </button>

                <button name="ver" class="btn btn-success w-100">
                    Ver todos los registrados
                </button>

            </form>
        </div>
    </div>

    <!-- TABLA -->
    <?php if ($mostrarTabla && count($_SESSION["estudiantes"]) > 0): ?>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Mayor de Edad</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($_SESSION["estudiantes"] as $i => $est): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $est["nombre"] ?></td>
                    <td><?= $est["edad"] ?></td>
                    <td><?= esMayorDeEdad($est["edad"]) ?></td>
                    <td><?= $est["carrera"] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <p class="fw-bold">
            Total registrados: <?= count($_SESSION["estudiantes"]) ?>
        </p>

    <?php endif; ?>

</div>

</body>
</html>
