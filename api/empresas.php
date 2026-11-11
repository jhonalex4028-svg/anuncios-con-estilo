<?php
/* Lista PUBLICA de empresas (datos basicos para tarjetas y mapa).
   Se carga como script: <script src="api/empresas.php"></script>
   Los datos de contacto, redes y todas las fotos NO van aqui:
   solo los entrega api/empresa.php a usuarios registrados. */
require_once __DIR__ . '/../config/usuario_publico.php';
header('Content-Type: application/javascript; charset=utf-8');
header('Cache-Control: no-store');

const CENTRO_LAT = 6.4635, CENTRO_LNG = -71.7330;   // Tame, por si falta la ubicacion
$lista = []; $usuario = null;
$pdo = db(false);
if ($pdo) {
  $rows = $pdo->query('SELECT id,nombre,categoria,descripcion_breve,direccion,latitud,longitud,foto_icono,foto1 FROM empresas ORDER BY nombre')->fetchAll();
  foreach ($rows as $r) {
    $lista[] = [
      'id' => (string)$r['id'],
      'nombre' => $r['nombre'],
      'categoria' => $r['categoria'],
      'descripcion' => $r['descripcion_breve'],
      'direccion' => $r['direccion'],
      'lat' => $r['latitud'] !== null ? (float)$r['latitud'] : CENTRO_LAT,
      'lng' => $r['longitud'] !== null ? (float)$r['longitud'] : CENTRO_LNG,
      'logo' => $r['foto_icono'] ?: 'imagenes/logo.png',
      'imagenes' => [$r['foto1'] ?: ($r['foto_icono'] ?: 'imagenes/logo.png')],
      'servicios' => [], 'calificacion' => 0, 'resenas' => 0,
    ];
  }
  $u = usuario_publico();
  if ($u) $usuario = ['nombres' => $u['nombres']];
}
$f = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
echo 'window.MODO_PHP=true;', "\n";
echo 'window.USUARIO_ACTUAL=', json_encode($usuario, $f), ";\n";
echo 'window.EMPRESAS_DB=', json_encode($lista, $f), ";\n";
