<?php
require_once "../controllers/UsuarioController.php";
$controller = new UsuarioController();
$controller->verificarSesion("usuario");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow text-center">
        <div class="card-body">
            <h2>Bienvenido <?php echo $_SESSION["usuario"]; ?> 👋</h2>
            <a href="../logout.php" class="btn btn-primary mt-3">Cerrar sesión</a>
        </div>
    </div>
</div>
</body>
</html>