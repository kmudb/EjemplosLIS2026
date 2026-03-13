<?php
$isEdit = isset($author);
$actionUrl = $isEdit ? "?controller=authors&action=edit&id={$author->id}" : "?controller=authors&action=create";
?>
<h1><?= $isEdit ? 'Editar autor' : 'Nuevo autor' ?></h1>

<form method="post" action="<?= $actionUrl ?>">
  <label>Nombre*:
    <input type="text" name="name" required value="<?= $isEdit ? htmlspecialchars($author->name) : '' ?>">
  </label>
  <br>
  <label>Email:
    <input type="email" name="email" value="<?= $isEdit ? htmlspecialchars($author->email ?? '') : '' ?>">
  </label>
  <br>
  <button type="submit"><?= $isEdit ? 'Guardar' : 'Crear' ?></button>
  <a href="?controller=authors&action=index">Volver</a>
</form>