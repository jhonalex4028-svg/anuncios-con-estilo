<?php
require_once __DIR__ . '/db.php';

function iniciar_sesion_segura(): void {
  if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
      'lifetime' => 0, 'path' => '/',
      'secure'   => !empty($_SERVER['HTTPS']),
      'httponly' => true, 'samesite' => 'Lax',
    ]);
    session_name('aces_admin');
    session_start();
  }
}

function admin_actual(): ?array {
  iniciar_sesion_segura();
  return isset($_SESSION['admin_id'])
    ? ['id' => $_SESSION['admin_id'], 'usuario' => $_SESSION['admin_usuario']]
    : null;
}

/* Poner al inicio de cada pagina del panel */
function exigir_admin(): void {
  if (!admin_actual()) { header('Location: login.php'); exit; }
}

function csrf_token(): string {
  iniciar_sesion_segura();
  if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
  return $_SESSION['csrf'];
}
function csrf_campo(): string {
  return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}
function csrf_validar(): void {
  iniciar_sesion_segura();
  if (empty($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) {
    http_response_code(403); exit('Solicitud no valida. Recarga la pagina e intenta de nuevo.');
  }
}
