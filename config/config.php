<?php
/* =========================================================
   CONFIGURACION - edita SOLO este archivo con los datos de
   Hostinger (hPanel > Bases de datos > Administracion).
========================================================= */
define('DB_HOST', 'localhost');
define('DB_NAME', 'u000000000_anuncios');   // nombre de la base de datos
define('DB_USER', 'u000000000_admin');      // usuario de la base de datos
define('DB_PASS', 'CAMBIAR_CLAVE');         // clave de la base de datos

// Clave secreta que SOLO conocen los creadores. Se pide una vez en
// admin/crear_admin.php para crear los administradores. Cambiala.
define('CLAVE_INSTALACION', 'CAMBIAR_ESTA_CLAVE_LARGA');

// Carpeta (dentro del sitio) donde se guardan las fotos subidas
define('RUTA_SUBIDAS', __DIR__ . '/../uploads/empresas/');
define('URL_SUBIDAS',  'uploads/empresas/');

// Clave para firmar la cookie de los usuarios registrados (texto largo y al azar)
define('CLAVE_COOKIES', 'CAMBIAR_ESTA_OTRA_CLAVE_LARGA_Y_ALEATORIA');
