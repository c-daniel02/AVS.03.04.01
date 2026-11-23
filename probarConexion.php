
<?php

require_once "config/conexion.php";

$conexion = new Conexion();
$pdo = $conexion->conectar();

echo "Conexion exitosa con la base de datos AVS_03_04_01";

?>
