<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2>Lista de Usuarios</h2>

    <a href="index.php?action=crear" class="btn btn-primary mb-3">Nuevo</a>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>

        <?php while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['correo'] ?></td>
            <td>
                <a href="index.php?action=editar&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="index.php?action=eliminar&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar este registro?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>