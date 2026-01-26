<?php
session_start();

// ================================
// INICIALIZAR ARREGLO
// ================================
if (!isset($_SESSION["estudiantes"])) {
    $_SESSION["estudiantes"] = [];
}

$mensaje = "";
$editarIndex = null;

// ================================
// FUNCIONES
// ================================
function esMayorDeEdad($edad) {
    return ($edad >= 18) ? "Sí" : "No";
}

function promedioEdades($estudiantes) {
    $suma = 0;
    foreach ($estudiantes as $e) {
        $suma += $e["edad"];
    }
    return count($estudiantes) > 0 ? $suma / count($estudiantes) : 0;
}

// ================================
// GUARDAR
// ================================
if (isset($_POST["guardar"])) {

    $nombre = $_POST["nombre"];
    $edad = (int) $_POST["edad"];
    $carrera = $_POST["carrera"];

    if ($nombre == "" || $edad <= 0 || $carrera == "") {
        $mensaje = "❌ Complete todos los campos";
    } else {
        $_SESSION["estudiantes"][] = compact("nombre", "edad", "carrera");
        $mensaje = "✅ Estudiante agregado";
    }
}

// ================================
// ELIMINAR
// ================================
if (isset($_GET["eliminar"])) {
    $i = $_GET["eliminar"];
    unset($_SESSION["estudiantes"][$i]);
    $_SESSION["estudiantes"] = array_values($_SESSION["estudiantes"]);
}

// ================================
// EDITAR
// ================================
if (isset($_GET["editar"])) {
    $editarIndex = $_GET["editar"];
}

if (isset($_POST["actualizar"])) {

    $_SESSION["estudiantes"][$_POST["index"]] = [
        "nombre" => $_POST["nombre"],
        "edad" => (int) $_POST["edad"],
        "carrera" => $_POST["carrera"]
    ];

    $mensaje = "🔄 Estudiante actualizado";

    // 🔥 LIMPIAR MODO EDICIÓN
    $editarIndex = null;

    // 🔥 EVITAR QUE EL GET SIGA ACTIVO
    header("Location: index.php");
    exit;
}

// ================================
// LIMPIAR
// ================================
if (isset($_POST["limpiar"])) {
    $_SESSION["estudiantes"] = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Estudiantes PHP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<h2 class="text-center mb-4">📚 Gestión de Estudiantes</h2>

<?php if ($mensaje): ?>
<div class="alert alert-info text-center"><?= $mensaje ?></div>
<?php endif; ?>

<!-- FORMULARIO -->
<div class="card mb-4">
<div class="card-body">

<form method="POST">

<input type="hidden" name="index" value="<?= $editarIndex ?? '' ?>">

<div class="mb-2">
<label>Nombre</label>
<input class="form-control" name="nombre"
value="<?= $editarIndex !== null ? $_SESSION["estudiantes"][$editarIndex]["nombre"] : '' ?>">
</div>

<div class="mb-2">
<label>Edad</label>
<input type="number" class="form-control" name="edad"
value="<?= $editarIndex !== null ? $_SESSION["estudiantes"][$editarIndex]["edad"] : '' ?>">
</div>

<div class="mb-3">
<label>Carrera</label>
<select name="carrera" class="form-select">
<option value="">Seleccione</option>
<?php
$carreras = ["Ingeniería", "Licenciatura", "Técnico"];
foreach ($carreras as $c) {
    $sel = ($editarIndex !== null && $_SESSION["estudiantes"][$editarIndex]["carrera"] == $c) ? "selected" : "";
    echo "<option $sel>$c</option>";
}
?>
</select>
</div>

<?php if ($editarIndex !== null): ?>
<button name="actualizar" class="btn btn-warning w-100">Actualizar</button>
<?php else: ?>
<button name="guardar" class="btn btn-primary w-100">Guardar</button>
<?php endif; ?>

</form>
</div>
</div>

<!-- BOTONES -->
<form method="POST" class="mb-3">
<button name="limpiar" class="btn btn-danger w-100">🧹 Limpiar registros</button>
</form>

<!-- TABLA -->
<?php if (count($_SESSION["estudiantes"]) > 0): ?>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
<th>#</th>
<th>Nombre</th>
<th>Edad</th>
<th>Mayor</th>
<th>Carrera</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php foreach ($_SESSION["estudiantes"] as $i => $e): ?>
<tr>
<td><?= $i + 1 ?></td>
<td><?= $e["nombre"] ?></td>
<td><?= $e["edad"] ?></td>
<td><?= esMayorDeEdad($e["edad"]) ?></td>
<td><?= $e["carrera"] ?></td>
<td>
<a href="?editar=<?= $i ?>" class="btn btn-sm btn-warning">✏️</a>
<a href="?eliminar=<?= $i ?>" class="btn btn-sm btn-danger">🗑️</a>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

<p class="fw-bold">
📊 Promedio de edades: <?= number_format(promedioEdades($_SESSION["estudiantes"]), 2) ?>
</p>

<?php endif; ?>

</div>
</body>
</html>
