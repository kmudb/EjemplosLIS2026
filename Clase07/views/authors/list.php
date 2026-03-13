<h1>Autores</h1>
<p><a href="?controller=authors&action=create">+ Nuevo autor</a></p>

<table border="1" cellspacing="0" cellpadding="6">
  <thead>
    <tr>
      <th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($authors as $a): ?>
      <tr>
        <td><?= $a->id ?></td>
        <td><?= htmlspecialchars($a->name) ?></td>
        <td><?= htmlspecialchars($a->email ?? '') ?></td>
        <td>
          <a href="?controller=authors&action=edit&id=<?= $a->id ?>">Editar</a> |
          <a href="?controller=authors&action=delete&id=<?= $a->id ?>" onclick="return confirm('¿Eliminar autor?')">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>