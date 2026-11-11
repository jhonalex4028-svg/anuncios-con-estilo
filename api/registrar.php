<?php
/* Registro de usuarios del publico (desde el boton "Ver mas"). */
require_once __DIR__ . '/../config/usuario_publico.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function responder(int $c, array $d): void { http_response_code($c); echo json_encode($d, JSON_UNESCAPED_UNICODE); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') responder(405, ['error' => 'Metodo no permitido.']);

// Solo se acepta desde este mismo sitio
$origen = parse_url($_SERVER['HTTP_ORIGIN'] ?? ($_SERVER['HTTP_REFERER'] ?? ''), PHP_URL_HOST);
if ($origen && $origen !== ($_SERVER['HTTP_HOST'] ?? '') && explode(':', $_SERVER['HTTP_HOST'] ?? '')[0] !== $origen)
  responder(403, ['error' => 'Origen no permitido.']);

$d = json_decode(file_get_contents('php://input'), true) ?: [];
if (!empty($d['sitio_web_extra'])) responder(200, ['ok' => true]);   // trampa para bots

$nombres   = trim(preg_replace('/\s+/', ' ', $d['nombres'] ?? ''));
$apellidos = trim(preg_replace('/\s+/', ' ', $d['apellidos'] ?? ''));
$correo    = mb_strtolower(trim($d['correo'] ?? ''));
$telefono  = preg_replace('/[^\d+]/', '', $d['telefono'] ?? '');

$errores = [];
if (mb_strlen($nombres) < 2 || mb_strlen($nombres) > 100)     $errores[] = 'Escribe tus nombres.';
if (mb_strlen($apellidos) < 2 || mb_strlen($apellidos) > 100) $errores[] = 'Escribe tus apellidos.';
if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || mb_strlen($correo) > 150) $errores[] = 'Escribe un correo válido.';
if (!preg_match('/^\+?\d{7,15}$/', $telefono))                $errores[] = 'Escribe un teléfono válido (7 a 15 números).';
if ($errores) responder(422, ['error' => implode(' ', $errores)]);

$pdo = db();
$st = $pdo->prepare('SELECT id FROM usuarios WHERE correo = ?');
$st->execute([$correo]);
if ($ya = $st->fetch()) {            // ya estaba registrado: solo se le reabre el acceso
  fijar_cookie_usuario((int)$ya['id']);
  responder(200, ['ok' => true, 'ya_registrado' => true]);
}
$pdo->prepare('INSERT INTO usuarios (nombres, apellidos, correo, telefono) VALUES (?,?,?,?)')
    ->execute([$nombres, $apellidos, $correo, $telefono]);
fijar_cookie_usuario((int)$pdo->lastInsertId());
responder(200, ['ok' => true]);
