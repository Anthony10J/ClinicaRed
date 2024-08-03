<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Id_Estado_Cita = $_POST['Id_Estado_Cita'];
$descripcion = strtoupper($_POST['Estado_Cita_E']);

$sql = "UPDATE tbl_estado_cita SET Estado_Cita = '$descripcion' WHERE Id_Estado_Cita = '$Id_Estado_Cita'";

    echo $resultado = mysqli_query($conexion, $sql);
