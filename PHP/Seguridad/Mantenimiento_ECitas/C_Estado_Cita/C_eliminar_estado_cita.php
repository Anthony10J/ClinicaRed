<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Estado_Cita = $_POST['Estado_Cita'];

$sql = "DELETE FROM tbl_estado_cita WHERE Id_Estado_Cita = '$Estado_Cita'";

    echo $resultado = mysqli_query($conexion, $sql);
?>