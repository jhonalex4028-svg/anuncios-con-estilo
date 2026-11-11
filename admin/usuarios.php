<?php
require_once __DIR__ . '/../config/auth.php';
exigir_admin();
$usuarios = db()->query('SELECT id,nombres,apellidos,correo,telefono,creado_en FROM usuarios ORDER BY id DESC')->fetchAll();
$titulo = 'Usuarios';
require __DIR__ . '/_head.php';
?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Usuarios registrados (<?= count($usuarios) ?>)</h4>
    <a href="index.php" class="btn btn-sm btn-outline-secondary">← Panel</a>
  </div>
  <div class="bg-white rounded-16 shadow-soft p-3 table-responsive">
    <table class="table align-middle mb-0">
      <thead><tr><th>Nombres</th><th>Apellidos</th><th>Correo</th><th>Teléfono</th><th>Registro</th></tr></thead>
      <tbody>
      <?php foreach ($usuarios as $u): ?>
        <tr><td><?= e($u['nombres']) ?></td><td><?= e($u['apellidos']) ?></td><td><?= e($u['correo']) ?></td><td><?= e($u['telefono']) ?></td><td class="small text-muted"><?= e($u['creado_en']) ?></td></tr>
      <?php endforeach; if (!$usuarios): ?>
        <tr><td colspan="5" class="text-center text-muted py-4">Aún no hay usuarios registrados.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body></html>
