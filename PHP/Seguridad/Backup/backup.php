<?php
include './Connet.php';
include '../../../Recursos/SweetAlerts.php';
session_start();

$day = date("d");
$mont = date("m");
$year = date("Y");
$hora = date("H-i-s");
$fecha = $day.'_'.$mont.'_'.$year;
$DataBASE = $fecha."_(".$hora."_hrs).sql";
$tables = array();
$error = 0;

// Obtener tablas
$result = SGBD::sql('SHOW TABLES');
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        $tables[] = $row[0];
    }

    // Inicializar el contenido del archivo SQL
    $sql = 'SET FOREIGN_KEY_CHECKS=0;' . "\n\n";
    $sql .= 'CREATE DATABASE IF NOT EXISTS '.BD.";\n\n";
    $sql .= 'USE '.BD.";\n\n";

    // Respaldo de tablas
    foreach ($tables as $table) {
        $result = SGBD::sql('SELECT * FROM '.$table);
        if ($result) {
            $numFields = mysqli_num_fields($result);
            $sql .= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysqli_fetch_row(SGBD::sql('SHOW CREATE TABLE '.$table));
            $sql .= "\n\n" . $row2[1] . ";\n\n";
            while ($row = mysqli_fetch_row($result)) {
                $sql .= 'INSERT INTO '.$table.' VALUES(';
                for ($j = 0; $j < $numFields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    if (isset($row[$j])) {
                        $sql .= '"' . $row[$j] . '"';
                    } else {
                        $sql .= '""';
                    }
                    if ($j < ($numFields - 1)) {
                        $sql .= ',';
                    }
                }
                $sql .= ");\n";
            }
            $sql .= "\n\n\n";
        } else {
            $error = 1;
        }
    }

    // Respaldo de triggers
    $result = SGBD::sql('SHOW TRIGGERS');
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $triggerName = $row['Trigger'];
            $triggerSql = SGBD::sql('SHOW CREATE TRIGGER ' . $triggerName);
            $triggerRow = mysqli_fetch_row($triggerSql);
            // Agregar delimitador temporal
            $sql .= "\n\nDELIMITER $$\n";
            $sql .= $triggerRow[2] . "$$\n";
            $sql .= "DELIMITER ;\n";
        }
    } else {
        $error = 1;
    }

    // Finalizar el archivo SQL
    if ($error == 1) {
        echo 'Ocurrió un error inesperado al crear la copia de seguridad';
    } else {
        chmod(BACKUP_PATH, 0777);
        $sql .= 'SET FOREIGN_KEY_CHECKS=1;';
        $handle = fopen(BACKUP_PATH . $DataBASE, 'w+');
        if (fwrite($handle, $sql)) {
            fclose($handle);
            echo '
            <script>
                MostrarAlerta("success", "Éxito", "El respaldo fue creado exitosamente.", "../Backup/respaldo/respaldo.php");
            </script>';
        } else {
            echo 'Ocurrió un error inesperado al crear la copia de seguridad';
        }
    }
} else {
    echo 'Ocurrió un error inesperado';
}
mysqli_free_result($result);
?>
