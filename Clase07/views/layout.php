<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>CRUD PHP PDO POO</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <nav>
    <a href="?controller=authors&action=index">Autores</a> |
    <a href="?controller=books&action=index">Libros</a>
  </nav>
  <main>
    <?php if (!empty($error)): ?>
      <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php include $viewFile; ?>
  </main>
</body>
</html>