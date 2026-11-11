<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/categorias.php';
require_once __DIR__ . '/../config/subidas.php';
exigir_admin();

$flash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'borrar') {
  csrf_validar();
  $id = (int)($_POST['id'] ?? 0);
  $st = db()->prepare('SELECT foto1,foto2,foto3,foto4,foto5,foto_icono FROM empresas WHERE id=?');
  $st->execute([$id]);
  if ($fila = $st->fetch()) {
    foreach ($fila as $ruta) borrar_imagen($ruta);
    db()->prepare('DELETE FROM empresas WHERE id=?')->execute([$id]);
    $flash = 'Empresa eliminada.';
  }
}
if (isset($_GET['ok'])) $flash = 'Empresa guardada correctamente.';

$empresas = db()->query('SELECT id,nombre,categoria,direccion,foto_icono,creado_en FROM empresas ORDER BY id DESC')->fetchAll();
$titulo = 'Empresas';
require __DIR__ . '/_head.php';
?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Empresas</h4>
    <div class="d-flex gap-2">
      <a href="index.php" class="btn btn-sm btn-outline-secondary">← Panel</a>
      <a href="empresa_form.php" class="btn btn-sm btn-hero"><i class="bi bi-plus-lg me-1"></i>Nueva empresa</a>
    </div>
  </div>
  <?php if ($flash): ?><div class="alert alert-success py-2"><?= e($flash) ?></div><?php endif; ?>
  <div class="bg-white rounded-16 shadow-soft p-3 table-responsive">
    <table class="table align-middle mb-0">
      <thead><tr><th></th><th>Nombre</th><th>Categoría</th><th>Dirección</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($empresas as $x): ?>
        <tr>
          <td style="width:56px"><?php if ($x['foto_icono']): ?><img src="../<?= e($x['foto_icono']) ?>" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:10px"><?php endif; ?></td>
          <td class="fw-semibold"><?= e($x['nombre']) ?></td>
          <td><?= e(CATEGORIAS_PHP[$x['categoria']] ?? $x['categoria']) ?></td>
          <td class="small text-muted"><?= e($x['direccion']) ?></td>
          <td class="text-end text-nowrap">
            <a class="btn btn-sm btn-outline-primary" href="empresa_form.php?id=<?= (int)$x['id'] ?>">Editar</a>
            <form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar esta empresa y sus fotos?')">
              <?= csrf_campo() ?><input type="hidden" name="accion" value="borrar"><input type="hidden" name="id" value="<?= (int)$x['id'] ?>">
              <button class="btn btn-sm btn-outline-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; if (!$empresas): ?>
        <tr><td colspan="5" class="text-center text-muted py-4">Aún no hay empresas. Crea la primera.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body></html>
