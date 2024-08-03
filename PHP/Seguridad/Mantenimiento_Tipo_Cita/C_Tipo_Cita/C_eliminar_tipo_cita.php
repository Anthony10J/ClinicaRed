<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Tipo_Cita = $_POST['Tipo_Cita'];

$sql = "DELETE FROM tbl_tipo_cita WHERE Id_Tipo_Cita = '$Tipo_Cita'";

    echo $resultado = mysqli_query($conexion, $sql);
?>