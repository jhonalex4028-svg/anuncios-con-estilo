<?php
require_once __DIR__ . '/../config/auth.php';
exigir_admin();
$titulo = 'Panel';
$total_emp = (int)db()->query('SELECT COUNT(*) FROM empresas')->fetchColumn();
$total_usr = (int)db()->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
require __DIR__ . '/_head.php';
?>
<div class="container">
  <div class="row g-3 mb-4">
    <div class="col-md-6"><div class="bg-white p-4 rounded-16 shadow-soft">
      <div class="text-muted small">Empresas registradas</div><div class="fs-2 fw-bold"><?= $total_emp ?></div>
      <a href="empresas.php" class="btn btn-sm btn-hero mt-2">Administrar empresas</a>
    </div></div>
    <div class="col-md-6"><div class="bg-white p-4 rounded-16 shadow-soft">
      <div class="text-muted small">Usuarios registrados</div><div class="fs-2 fw-bold"><?= $total_usr ?></div>
      <a href="usuarios.php" class="btn btn-sm btn-outline-secondary mt-2">Ver usuarios</a>
    </div></div>
  </div>
</div>
</body></html>
