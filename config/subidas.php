<?php
require_once __DIR__ . '/config.php';

/* Guarda una imagen subida. Devuelve la ruta relativa o null si no hubo archivo.
   Lanza Exception con mensaje claro si el archivo no es valido. */
function guardar_imagen(array $f): ?string {
  if (($f['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
  if ($f['error'] !== UPLOAD_ERR_OK) throw new Exception('Error al subir una imagen.');
  if ($f['size'] > 3 * 1024 * 1024) throw new Exception('Cada imagen debe pesar máximo 3 MB.');
  $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
  $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? null;
  if (!$ext || !@getimagesize($f['tmp_name'])) throw new Exception('Solo se permiten imágenes JPG, PNG o WEBP.');
  if (!is_dir(RUTA_SUBIDAS)) mkdir(RUTA_SUBIDAS, 0755, true);
  $nombre = bin2hex(random_bytes(12)) . '.' . $ext;
  if (!move_uploaded_file($f['tmp_name'], RUTA_SUBIDAS . $nombre)) throw new Exception('No se pudo guardar la imagen.');
  return URL_SUBIDAS . $nombre;
}

function borrar_imagen(?string $ruta): void {
  if ($ruta && strpos($ruta, URL_SUBIDAS) === 0) {
    $p = RUTA_SUBIDAS . basename($ruta);
    if (is_file($p)) @unlink($p);
  }
}
