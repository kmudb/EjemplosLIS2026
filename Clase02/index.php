<?php
// ================================
// 1. VARIABLES Y ARREGLOS
// ================================

$estudiantes = [];
$mensaje = "";
$total = 0;

// ================================
// 2. FUNCIÓN
// ================================
function esMayorDeEdad($edad) {
    if ($edad >= 18) {
        return "Sí";
    } else {
        return "No";
    }
}

// ================================
// 3. CONTROL DE FLUJO (IF / POST)
// ================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre  = $_POST["nombre"];
    $edad    = (int) $_POST["edad"];
    $carrera = $_POST["carrera"];

    // ================================
    // 4. CONDICIONALES
    // ================================
    if ($nombre == "" || $edad <= 0 || $carrera == "") {
        $mensaje = "❌ Todos los campos son obligatorios";
    } else {

        // ================================
        // 5. ARREGLO ASOCIATIVO
        // ================================
        $estudiantes[] = [
            "nombre" => $nombre,
            "edad" => $edad,
            "carrera" => $carrera
        ];

        $mensaje = "✅ Estudiante agregado correctamente";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo PHP + Bootstrap</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">📚 Registro de Estudiantes (PHP)</h2>

    <!-- MENSAJE -->
    <?php if ($mensaje != ""): ?>
        <div class="alert alert-info text-center">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <!-- FORMULARIO -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="number" name="edad" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Carrera</label>
                    <select name="carrera" class="form-select">
                        <option value="">Seleccione</option>
                        <option>Ingeniería</option>
                        <option>Licenciatura</option>
                        <option>Técnico</option>
                    </select>
                </div>

                <button class="btn btn-primary w-100">Guardar</button>
            </form>
        </div>
    </div>

    <!-- TABLA -->
    <?php if (count($estudiantes) > 0): ?>

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

            <?php
            // ================================
            // 6. CICLO FOREACH
            // ================================
            foreach ($estudiantes as $index => $est) {
                $total++;
            ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $est["nombre"] ?></td>
                    <td><?= $est["edad"] ?></td>
                    <td><?= esMayorDeEdad($est["edad"]) ?></td>
                    <td><?= $est["carrera"] ?></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <p class="fw-bold">Total de estudiantes registrados: <?= $total ?></p>

    <?php endif; ?>

</div>

</body>
</html>
