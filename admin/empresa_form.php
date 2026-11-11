<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/categorias.php';
require_once __DIR__ . '/../config/subidas.php';
exigir_admin();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$campos_foto = ['foto1','foto2','foto3','foto4','foto5','foto_icono'];
$emp = array_fill_keys(['nombre','descripcion_breve','fecha_creacion','servicios','instagram','facebook','tiktok','whatsapp','correo','pagina_web','direccion','latitud','longitud','categoria'], '');
foreach ($campos_foto as $c) $emp[$c] = null;

if ($id) {
  $st = db()->prepare('SELECT * FROM empresas WHERE id=?'); $st->execute([$id]);
  $fila = $st->fetch();
  if (!$fila) { http_response_code(404); exit('Empresa no encontrada.'); }
  $emp = $fila;
}

$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validar();
  $nuevo = [];
  foreach (['nombre','descripcion_breve','fecha_creacion','servicios','instagram','facebook','tiktok','whatsapp','correo','pagina_web','direccion','latitud','longitud','categoria'] as $c)
    $nuevo[$c] = trim($_POST[$c] ?? '');

  if ($nuevo['nombre'] === '' || mb_strlen($nuevo['nombre']) > 150) $errores[] = 'El nombre es obligatorio (máx. 150 caracteres).';
  if ($nuevo['descripcion_breve'] === '' || mb_strlen($nuevo['descripcion_breve']) > 500) $errores[] = 'La descripción breve es obligatoria (máx. 500 caracteres).';
  if ($nuevo['direccion'] === '') $errores[] = 'La dirección es obligatoria.';
  if (!isset(CATEGORIAS_PHP[$nuevo['categoria']])) $errores[] = 'Elige una categoría.';
  if ($nuevo['fecha_creacion'] !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $nuevo['fecha_creacion'])) $errores[] = 'Fecha inválida.';
  if ($nuevo['correo'] !== '' && !filter_var($nuevo['correo'], FILTER_VALIDATE_EMAIL)) $errores[] = 'Correo inválido.';
  foreach (['instagram','facebook','tiktok','pagina_web'] as $c)
    if ($nuevo[$c] !== '' && !preg_match('#^https?://#i', $nuevo[$c])) $errores[] = ucfirst(str_replace('_',' ',$c)) . ': escribe el enlace completo (https://...).';
  $nuevo['whatsapp'] = preg_replace('/\D/', '', $nuevo['whatsapp']);
  foreach (['latitud','longitud'] as $c) {
    if ($nuevo[$c] !== '' && !is_numeric($nuevo[$c])) $errores[] = ucfirst($c) . ' debe ser un número (ej: 6.4635).';
  }

  // Imagenes
  $rutas = []; $subidas_nuevas = [];
  if (!$errores) {
    try {
      foreach ($campos_foto as $c) {
        $r = guardar_imagen($_FILES[$c] ?? ['error' => UPLOAD_ERR_NO_FILE]);
        if ($r) { $subidas_nuevas[] = $r; $rutas[$c] = $r; }
        else $rutas[$c] = $emp[$c] ?? null;
      }
    } catch (Exception $ex) {
      foreach ($subidas_nuevas as $r) borrar_imagen($r);
      $errores[] = $ex->getMessage();
    }
  }

  if (!$errores) {
    $vacio = fn($v) => $v === '' ? null : $v;
    $datos = [
      $nuevo['nombre'], $nuevo['descripcion_breve'], $vacio($nuevo['fecha_creacion']), $vacio($nuevo['servicios']),
      $vacio($nuevo['instagram']), $vacio($nuevo['facebook']), $vacio($nuevo['tiktok']), $vacio($nuevo['whatsapp']),
      $vacio($nuevo['correo']), $vacio($nuevo['pagina_web']),
      $rutas['foto1'], $rutas['foto2'], $rutas['foto3'], $rutas['foto4'], $rutas['foto5'], $rutas['foto_icono'],
      $nuevo['direccion'], $vacio($nuevo['latitud']), $vacio($nuevo['longitud']), $nuevo['categoria'],
    ];
    if ($id) {
      $sql = 'UPDATE empresas SET nombre=?,descripcion_breve=?,fecha_creacion=?,servicios=?,instagram=?,facebook=?,tiktok=?,whatsapp=?,correo=?,pagina_web=?,foto1=?,foto2=?,foto3=?,foto4=?,foto5=?,foto_icono=?,direccion=?,latitud=?,longitud=?,categoria=? WHERE id=?';
      $datos[] = $id;
      db()->prepare($sql)->execute($datos);
      foreach ($campos_foto as $c)   // borrar fotos antiguas reemplazadas
        if (!empty($emp[$c]) && $rutas[$c] !== $emp[$c]) borrar_imagen($emp[$c]);
    } else {
      $sql = 'INSERT INTO empresas (nombre,descripcion_breve,fecha_creacion,servicios,instagram,facebook,tiktok,whatsapp,correo,pagina_web,foto1,foto2,foto3,foto4,foto5,foto_icono,direccion,latitud,longitud,categoria) VALUES (' . rtrim(str_repeat('?,', 20), ',') . ')';
      db()->prepare($sql)->execute($datos);
    }
    header('Location: empresas.php?ok=1'); exit;
  }
  $emp = array_merge($emp, $nuevo);   // conservar lo escrito
}

$titulo = $id ? 'Editar empresa' : 'Nueva empresa';
require __DIR__ . '/_head.php';
function campo($n, $v, $label, $tipo = 'text', $extra = '') {
  echo '<div class="col-md-6"><label class="form-label small mb-1">' . e($label) . '</label><input class="form-control" type="' . $tipo . '" name="' . $n . '" value="' . e($v) . '" ' . $extra . '></div>';
}
?>
<div class="container pb-5" style="max-width:900px">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><?= e($titulo) ?></h4>
    <a href="empresas.php" class="btn btn-sm btn-outline-secondary">← Volver</a>
  </div>
  <?php if ($errores): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errores as $m): ?><li><?= e($m) ?></li><?php endforeach; ?></ul></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="bg-white rounded-16 shadow-soft p-4">
    <?= csrf_campo() ?><input type="hidden" name="id" value="<?= $id ?>">
    <h6 class="mb-3">Datos principales</h6>
    <div class="row g-3 mb-4">
      <?php campo('nombre', $emp['nombre'], 'Nombre de la empresa *', 'text', 'required maxlength="150"'); ?>
      <div class="col-md-6"><label class="form-label small mb-1">Categoría *</label>
        <select class="form-select" name="categoria" required>
          <option value="">Selecciona...</option>
          <?php foreach (CATEGORIAS_PHP as $slug => $nom): ?><option value="<?= e($slug) ?>" <?= $emp['categoria'] === $slug ? 'selected' : '' ?>><?= e($nom) ?></option><?php endforeach; ?>
        </select></div>
      <div class="col-12"><label class="form-label small mb-1">Descripción breve * (máx. 500)</label>
        <textarea class="form-control" name="descripcion_breve" rows="3" maxlength="500" required><?= e($emp['descripcion_breve']) ?></textarea></div>
      <?php campo('fecha_creacion', $emp['fecha_creacion'], 'Fecha de creación de la empresa', 'date'); ?>
      <?php campo('direccion', $emp['direccion'], 'Dirección *', 'text', 'required maxlength="255"'); ?>
      <div class="col-12"><label class="form-label small mb-1">Servicios (uno por línea)</label>
        <textarea class="form-control" name="servicios" rows="4"><?= e($emp['servicios']) ?></textarea></div>
    </div>

    <h6 class="mb-3">Contacto y redes <span class="text-muted fw-normal small">(solo si la empresa los tiene)</span></h6>
    <div class="row g-3 mb-4">
      <?php campo('whatsapp', $emp['whatsapp'], 'WhatsApp (con indicativo, ej: 573228728537)'); ?>
      <?php campo('correo', $emp['correo'], 'Correo', 'email'); ?>
      <?php campo('instagram', $emp['instagram'], 'Instagram (enlace)', 'url'); ?>
      <?php campo('facebook', $emp['facebook'], 'Facebook (enlace)', 'url'); ?>
      <?php campo('tiktok', $emp['tiktok'], 'TikTok (enlace)', 'url'); ?>
      <?php campo('pagina_web', $emp['pagina_web'], 'Página web (enlace)', 'url'); ?>
    </div>

    <h6 class="mb-3">Ubicación en el mapa <span class="text-muted fw-normal small">(opcional)</span></h6>
    <div class="row g-3 mb-4">
      <?php campo('latitud', $emp['latitud'], 'Latitud (ej: 6.4635)', 'text', 'inputmode="decimal"'); ?>
      <?php campo('longitud', $emp['longitud'], 'Longitud (ej: -71.7330)', 'text', 'inputmode="decimal"'); ?>
      <div class="col-12">
        <div class="small text-muted mb-2">Haz clic en el mapa para marcar dónde está la empresa (llena la latitud y la longitud solo). Si no la marcas, aparecerá en el centro de Tame.</div>
        <div id="mapaSel" style="height:300px;border-radius:14px;overflow:hidden"></div>
      </div>
    </div>

    <h6 class="mb-3">Imágenes <span class="text-muted fw-normal small">(JPG, PNG o WEBP, máx. 3 MB cada una)</span></h6>
    <div class="row g-3 mb-4">
      <?php foreach (['foto_icono' => 'Foto icono (logo)', 'foto1' => 'Foto 1', 'foto2' => 'Foto 2', 'foto3' => 'Foto 3', 'foto4' => 'Foto 4', 'foto5' => 'Foto 5'] as $c => $label): ?>
        <div class="col-md-4">
          <label class="form-label small mb-1"><?= e($label) ?></label>
          <?php if (!empty($emp[$c])): ?><img src="../<?= e($emp[$c]) ?>" alt="" class="d-block mb-2 rounded" style="height:80px;width:100%;object-fit:cover"><?php endif; ?>
          <input class="form-control form-control-sm" type="file" name="<?= $c ?>" accept="image/jpeg,image/png,image/webp">
          <?php if (!empty($emp[$c])): ?><div class="form-text">Sube otra solo si quieres reemplazarla.</div><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <button class="btn btn-hero px-4" type="submit"><i class="bi bi-check-lg me-1"></i>Guardar empresa</button>
  </form>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script src="../js/main.js"></script>
<script>
(function () {
  const la = document.querySelector('[name=latitud]'), lo = document.querySelector('[name=longitud]');
  const lat0 = parseFloat(la.value), lng0 = parseFloat(lo.value);
  const tiene = !isNaN(lat0) && !isNaN(lng0);
  const map = L.map('mapaSel').setView(tiene ? [lat0, lng0] : [6.4635, -71.7330], tiene ? 16 : 14);
  crearCapaMapa().addTo(map);
  let marca = tiene ? L.marker([lat0, lng0]).addTo(map) : null;
  function poner(lat, lng) {
    la.value = lat.toFixed(7); lo.value = lng.toFixed(7);
    if (marca) marca.setLatLng([lat, lng]); else marca = L.marker([lat, lng]).addTo(map);
  }
  map.on('click', e => poner(e.latlng.lat, e.latlng.lng));
  [la, lo].forEach(i => i.addEventListener('change', () => {
    const a = parseFloat(la.value), b = parseFloat(lo.value);
    if (!isNaN(a) && !isNaN(b)) { poner(a, b); map.setView([a, b], 16); }
  }));
})();
</script>
</body></html>
