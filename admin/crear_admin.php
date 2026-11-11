<?php
/* =========================================================
   CREAR ADMINISTRADORES (solo los creadores).
   Requiere la CLAVE_INSTALACION de config/config.php.
   IMPORTANTE: cuando hayas creado a todos los administradores,
   BORRA este archivo del hosting.
========================================================= */
require_once __DIR__ . '/../config/auth.php';
iniciar_sesion_segura();
$msg = ''; $ok = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validar();
  $usuario = trim($_POST['usuario'] ?? '');
  $clave   = $_POST['contrasena'] ?? '';
  if (!hash_equals(CLAVE_INSTALACION, $_POST['clave_instalacion'] ?? '')) {
    $msg = 'Clave de instalación incorrecta.';
  } elseif (!preg_match('/^[A-Za-z0-9_.-]{3,50}$/', $usuario)) {
    $msg = 'Usuario: 3 a 50 caracteres (letras, números, _ . -).';
  } elseif (strlen($clave) < 10) {
    $msg = 'La contraseña debe tener mínimo 10 caracteres.';
  } else {
    try {
      db()->prepare('INSERT INTO administradores (usuario, contrasena) VALUES (?, ?)')
          ->execute([$usuario, password_hash($clave, PASSWORD_DEFAULT)]);
      $ok = true; $msg = "Administrador «" . e($usuario) . "» creado. Ya puedes ingresar.";
    } catch (PDOException $ex) {
      $msg = ($ex->getCode() == 23000) ? 'Ese usuario ya existe.' : 'Error al guardar.';
    }
  }
}
$titulo = 'Crear administrador';
require __DIR__ . '/_head.php';
?>
<div class="container" style="max-width:460px;margin-top:6vh">
  <div class="bg-white p-4 rounded-16 shadow-soft">
    <h4 class="mb-1">Crear administrador</h4>
    <p class="text-muted small">Borra este archivo del hosting al terminar.</p>
    <?php if ($msg): ?><div class="alert alert-<?= $ok ? 'success' : 'danger' ?> py-2"><?= $ok ? $msg : e($msg) ?></div><?php endif; ?>
    <form method="post" autocomplete="off">
      <?= csrf_campo() ?>
      <label class="form-label small mb-1">Usuario</label>
      <input class="form-control mb-3" name="usuario" required>
      <label class="form-label small mb-1">Contraseña (mín. 10 caracteres)</label>
      <input class="form-control mb-3" type="password" name="contrasena" required minlength="10">
      <label class="form-label small mb-1">Clave de instalación</label>
      <input class="form-control mb-3" type="password" name="clave_instalacion" required>
      <button class="btn btn-hero w-100">Crear administrador</button>
    </form>
    <a href="login.php" class="d-block text-center mt-3 small">Ir al login</a>
  </div>
</div>
</body></html>
