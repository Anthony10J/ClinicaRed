<?php
include('../Controladores/Conexion/Conexion_be.php');
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('./bitacora.php');
echo "ID Objeto: " . $id_objeto;
$fecha = date("Y-m-d H:i:s");
$n = $fila['Id_Usuario'];
$a = 'INICIO DE SESIÓN';
$d = $_SESSION['usuario'] . ' INICIÓ SESIÓN';
$o= 5;

session_destroy();
header("location: /index.php");
bitacora($n, $a, $d, $o);

