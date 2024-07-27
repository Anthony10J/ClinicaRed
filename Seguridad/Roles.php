<?php

session_start();

$roles_permitidos = ['SUPERADMINISTRADOR', 'DEFECTO', 'USUARIO', 'ADMINISTRADOR', 'SECRETARIA', 'FISIATRA', 'TERAPEUTA'];

if(!array_key_exists('rol', $_SESSION) || !in_array($_SESSION['rol'], $roles_permitidos))
    header("Location: /index.php")
?>