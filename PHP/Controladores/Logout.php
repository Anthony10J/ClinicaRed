<?php 
include('../Controladores/Conexion/Conexion_be.php');
include('../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php');
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include('./bitacora.php');
$u=$_SESSION['usuario'];
$n= $_SESSION['id_D'];
$a='CIERRE DE SESIÓN';
$d= $_SESSION['usuario'].' FINALIZÓ SESIÓN.';
$o= 5;
session_destroy();
header("location: /index.php");
bitacora($n,$a,$d, $o); 
?>