<?php
require_once __DIR__ . '/../config/auth.php';
iniciar_sesion_segura();
if (admin_actual()) { header('Location: index.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validar();
  // Freno simple contra fuerza bruta: 5 intentos y espera de 5 minutos
  $_SESSION['intentos'] = $_SESSION['intentos'] ?? 0;
  if (($_SESSION['bloqueo'] ?? 0) > time()) {
    $error = 'Demasiados intentos. Espera unos minutos.';
  } else {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave   = $_POST['contrasena'] ?? '';
    $st = db()->prepare('SELECT id, usuario, contrasena FROM administradores WHERE usuario = ?');
    $st->execute([$usuario]);
    $a = $st->fetch();
    // password_verify tambien se ejecuta si no existe, para no revelar usuarios
    $hash = $a['contrasena'] ?? '$2y$10$usesomesillystringforsaltuOq1m9q7nO6bq3oJrQ1h8o8cF8t8K';
    if (password_verify($clave, $hash) && $a) {
      session_regenerate_id(true);
      $_SESSION['admin_id'] = $a['id'];
      $_SESSION['admin_usuario'] = $a['usuario'];
      $_SESSION['intentos'] = 0;
      header('Location: index.php'); exit;
    }
    $_SESSION['intentos']++;
    if ($_SESSION['intentos'] >= 5) { $_SESSION['bloqueo'] = time() + 300; $_SESSION['intentos'] = 0; }
    $error = 'Usuario o contraseña incorrectos.';
  }
}
$titulo = 'Ingresar';
require __DIR__ . '/_head.php';
?>
<div class="container" style="max-width:420px;margin-top:8vh">
  <div class="bg-white p-4 rounded-16 shadow-soft">
    <div class="text-center mb-3">
      <img src="../imagenes/logo.png" alt="Logo" style="height:64px">
      <h4 class="mt-2 mb-0">Acceso administrativo</h4>
      <p class="text-muted small">Solo para los creadores del proyecto</p>
    </div>
    <?php if ($error): ?><div class="alert alert-danger py-2"><?= e($error) ?></div><?php endif; ?>
    <form method="post" autocomplete="off">
      <?= csrf_campo() ?>
      <label class="form-label small mb-1">Usuario</label>
      <input class="form-control mb-3" type="text" name="usuario" required autofocus>
      <label class="form-label small mb-1">Contraseña</label>
      <input class="form-control mb-3" type="password" name="contrasena" required>
      <button class="btn btn-hero w-100" type="submit">Ingresar</button>
    </form>
  </div>
</div>
</body></html>
