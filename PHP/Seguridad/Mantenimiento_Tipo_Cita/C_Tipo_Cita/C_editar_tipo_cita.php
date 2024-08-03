<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Id_Tipo_Cita = $_POST['Id_Tipo_Cita'];
$descripcion = strtoupper($_POST['Tipo_Cita_E']);

$sql = "UPDATE tbl_tipo_cita SET Descripcion = '$descripcion' WHERE Id_Tipo_Cita = '$Id_Tipo_Cita'";

    echo $resultado = mysqli_query($conexion, $sql);
