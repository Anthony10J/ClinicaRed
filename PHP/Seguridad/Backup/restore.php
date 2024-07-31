<?php
include './Connet.php';
include '../../../Recursos/SweetAlerts.php';
$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
set_time_limit (60);
$con=mysqli_connect(SERVER, USER, PASS, BD);
$con->query("SET FOREIGN_KEY_CHECKS=0");
for($i = 0; $i < (count($sql)-1); $i++){
    if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
}
$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();
// Destruir todas las sesiones activas
session_regenerate_id(true);
session_unset();
session_destroy();

// Opcional: Limpiar el almacenamiento de sesiones en el servidor
if (ini_get("session.save_path")) {
    $sessionFiles = glob(session_save_path() . '/*');
    foreach ($sessionFiles as $sessionFile) {
        if (is_file($sessionFile)) {
            unlink($sessionFile);
        }
    }
}
if($totalErrors<=0){
	// echo "Restauración completada con éxito";
    echo '
    <script>
  MostrarAlerta("success", "Éxito", "La restauración fue exitosa.", "./V_restore.php");
</script>
';
}else{
	echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
}