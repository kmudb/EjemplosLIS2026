<?php
require_once __DIR__ . "/../config/config.php";
http_response_code(403);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 403 - Acceso denegado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-box {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            max-width: 400px;
        }

        h1 {
            color: #e74c3c;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <div class="error-box">
        <h1>🚫 Acceso denegado</h1>
        <p>No tienes permisos para acceder a esta sección.</p>
        <a href="<?= BASE_URL ?>/views/login.php">Volver al inicio</a>
    </div>

</body>
</html>