<h1>Libros</h1>
<p><a href="?controller=books&action=create">+ Nuevo libro</a></p>

<table border="1" cellspacing="0" cellpadding="6">
  <thead>
    <tr>
      <th>ID</th><th>Título</th><th>Año</th><th>Autor</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($books as $b): ?>
      <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['title']) ?></td>
        <td><?= htmlspecialchars($b['year']) ?></td>
        <td><?= htmlspecialchars($b['author_name']) ?></td>
        <td>
          <a href="?controller=books&action=edit&id=<?= $b['id'] ?>">Editar</a> |
          <a href="?controller=books&action=delete&id=<?= $b['id'] ?>" onclick="return confirm('¿Eliminar libro?')">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>