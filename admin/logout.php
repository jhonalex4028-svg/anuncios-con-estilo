<?php
require_once __DIR__ . '/../config/auth.php';
iniciar_sesion_segura();
$_SESSION = [];
session_destroy();
header('Location: login.php');
