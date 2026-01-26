<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Notas</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .resultado {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .aprobado {
            background-color: #d4edda;
            color: #155724;
        }

        .recuperacion {
            background-color: #fff3cd;
            color: #856404;
        }

        .reprobado {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Calculadora de Notas</h2>

    <form method="POST">
        <label>Nota 1</label>
        <input type="number" name="nota1" step="0.01" required>

        <label>Nota 2</label>
        <input type="number" name="nota2" step="0.01" required>

        <label>Nota 3</label>
        <input type="number" name="nota3" step="0.01" required>

        <input type="submit" value="Calcular Promedio">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];

        $promedio = ($nota1 + $nota2 + $nota3) / 3;

        if ($promedio >= 7) {
            $estado = "Aprobado";
            $clase = "aprobado";
        } elseif ($promedio >= 5) {
            $estado = "Recuperación";
            $clase = "recuperacion";
        } else {
            $estado = "Reprobado";
            $clase = "reprobado";
        }

        echo "<div class='resultado $clase'>";
        echo "Promedio: " . round($promedio, 2) . "<br>";
        echo "Estado: $estado";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
