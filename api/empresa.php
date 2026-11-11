<?php
/* Detalle COMPLETO de una empresa. Solo para usuarios registrados. */
require_once __DIR__ . '/../config/usuario_publico.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (!usuario_publico()) { http_response_code(401); echo json_encode(['error' => 'registro']); exit; }

$st = db()->prepare('SELECT * FROM empresas WHERE id = ?');
$st->execute([(int)($_GET['id'] ?? 0)]);
$r = $st->fetch();
if (!$r) { http_response_code(404); echo json_encode(['error' => 'no_encontrada']); exit; }

$fotos = array_values(array_filter([$r['foto1'],$r['foto2'],$r['foto3'],$r['foto4'],$r['foto5']]));
$servicios = array_values(array_filter(array_map('trim', preg_split('/\R/', (string)$r['servicios']))));
$meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
$fundada = '';
if ($r['fecha_creacion']) {
  $t = strtotime($r['fecha_creacion']);
  $fundada = date('j', $t) . ' de ' . $meses[(int)date('n', $t) - 1] . ' de ' . date('Y', $t);
}
echo json_encode([
  'id' => (string)$r['id'], 'nombre' => $r['nombre'], 'categoria' => $r['categoria'],
  'descripcion' => $r['descripcion_breve'], 'fundada' => $fundada, 'servicios' => $servicios,
  'whatsapp' => $r['whatsapp'] ?: '', 'telefono' => '', 'correo' => $r['correo'] ?: '',
  'sitioWeb' => $r['pagina_web'] ?: '', 'direccion' => $r['direccion'],
  'lat' => $r['latitud'] !== null ? (float)$r['latitud'] : 6.4635,
  'lng' => $r['longitud'] !== null ? (float)$r['longitud'] : -71.7330,
  'redes' => [
    'facebook' => $r['facebook'] ?: '', 'instagram' => $r['instagram'] ?: '', 'tiktok' => $r['tiktok'] ?: '',
    'whatsapp' => $r['whatsapp'] ? 'https://wa.me/' . $r['whatsapp'] : '',
  ],
  'logo' => $r['foto_icono'] ?: 'imagenes/logo.png',
  'imagenes' => $fotos ?: [$r['foto_icono'] ?: 'imagenes/logo.png'],
  'calificacion' => 0, 'resenas' => 0,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
