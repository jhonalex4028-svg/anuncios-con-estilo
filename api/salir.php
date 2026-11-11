<?php
require_once __DIR__ . '/../config/usuario_publico.php';
borrar_cookie_usuario();
header('Location: ../index.html');
