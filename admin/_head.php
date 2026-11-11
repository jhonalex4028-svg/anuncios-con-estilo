<?php
/* Cabecera compartida del panel. Uso: $titulo = '...'; require '_head.php'; */
require_once __DIR__ . '/../config/auth.php';
header('X-Frame-Options: DENY');
header('X-Robots-Tag: noindex, nofollow');
$u = admin_actual();
?><!DOCTYPE html>
<html lang="es"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title><?= e($titulo ?? 'Panel') ?> | Admin - Anuncios con Estilos</title>
<link rel="icon" href="../imagenes/logo.png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<style>body{font-family:'Poppins',sans-serif;background:#f6f3fa}</style>
</head><body>
<?php if ($u): ?>
<nav class="navbar navbar-aces py-2 mb-4"><div class="container">
  <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
    <img src="../imagenes/logo.png" alt="Logo"><span class="brand-text"><strong>Panel</strong><span>administrativo</span></span>
  </a>
  <div class="d-flex align-items-center gap-3">
    <a class="small text-decoration-none" href="../index.html" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Ver sitio</a>
    <span class="small text-muted"><i class="bi bi-person-circle me-1"></i><?= e($u['usuario']) ?></span>
    <a class="btn btn-sm btn-outline-secondary" href="logout.php">Salir</a>
  </div>
</div></nav>
<?php endif; ?>
