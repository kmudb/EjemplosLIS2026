<?php
$isEdit = isset($book);
$actionUrl = $isEdit ? "?controller=books&action=edit&id={$book['id']}" : "?controller=books&action=create";
?>
<h1><?= $isEdit ? 'Editar libro' : 'Nuevo libro' ?></h1>

<form method="post" action="<?= $actionUrl ?>">
  <label>Autor*:
    <select name="author_id" required>
      <option value="">-- Selecciona --</option>
      <?php foreach ($authors as $a): ?>
        <option value="<?= $a['id'] ?>"
          <?= $isEdit && $a['id'] == $book['author_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($a['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </label>
  <br>
  <label>Título*:
    <input type="text" name="title" required value="<?= $isEdit ? htmlspecialchars($book['title']) : '' ?>">
  </label>
  <br>
  <label>Año:
    <input type="number" name="year" value="<?= $isEdit ? htmlspecialchars($book['year']) : '' ?>">
  </label>
  <br>
  <button type="submit"><?= $isEdit ? 'Guardar' : 'Crear' ?></button>
  <a href="?controller=books&action=index">Volver</a>
</form>