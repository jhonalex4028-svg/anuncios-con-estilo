<?php
/* Usuarios del publico: se identifican con una cookie firmada (30 dias). */
require_once __DIR__ . '/db.php';

const COOKIE_USUARIO = 'aces_u';

function fijar_cookie_usuario(int $id): void {
  $valor = $id . '.' . hash_hmac('sha256', (string)$id, CLAVE_COOKIES);
  setcookie(COOKIE_USUARIO, $valor, [
    'expires' => time() + 60 * 60 * 24 * 30, 'path' => '/',
    'secure' => !empty($_SERVER['HTTPS']), 'httponly' => true, 'samesite' => 'Lax',
  ]);
}

function borrar_cookie_usuario(): void {
  setcookie(COOKIE_USUARIO, '', ['expires' => time() - 3600, 'path' => '/']);
}

/* Devuelve ['id'=>..,'nombres'=>..] del usuario registrado o null */
function usuario_publico(): ?array {
  $c = $_COOKIE[COOKIE_USUARIO] ?? '';
  if (!preg_match('/^(\d+)\.([a-f0-9]{64})$/', $c, $m)) return null;
  if (!hash_equals(hash_hmac('sha256', $m[1], CLAVE_COOKIES), $m[2])) return null;
  $pdo = db(false);
  if (!$pdo) return null;
  $st = $pdo->prepare('SELECT id, nombres FROM usuarios WHERE id = ?');
  $st->execute([(int)$m[1]]);
  return $st->fetch() ?: null;
}
