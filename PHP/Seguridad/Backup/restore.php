<?php
include './Connet.php';
include '../../../Recursos/SweetAlerts.php';

$restorePoint = SGBD::limpiarCadena($_POST['restorePoint']);
$fileContent = file_get_contents($restorePoint);

$totalErrors = 0;
set_time_limit(60);
$con = mysqli_connect(SERVER, USER, PASS, BD);
$con->query("SET FOREIGN_KEY_CHECKS=0");

$delimiter = ';';  // Delimitador por defecto
$sql = '';
foreach (explode("\n", $fileContent) as $line) {
    $line = trim($line);

    if (strpos($line, 'DELIMITER') === 0) {
        $delimiter = str_replace('DELIMITER ', '', $line);
        continue;
    }

    $sql .= $line . "\n";
    if (substr(trim($line), -strlen($delimiter)) === $delimiter) {
        $sql = substr(trim($sql), 0, -strlen($delimiter));  // Remover el delimitador
        if ($con->query($sql)) {
            $sql = '';
        } else {
            $totalErrors++;
            $sql = '';
        }
    }
}

$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();

if ($totalErrors <= 0) {
    echo '
    <script>
      MostrarAlerta("success", "Éxito", "La restauración fue exitosa.", "./V_restore.php");
    </script>
    ';
} else {
    echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
}
?>
