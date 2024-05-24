<?php
include 'conexion.php';
include '../Clases/Mascota.php';

header('Content-Type: application/json');
echo Mascota::obtenerTodasJSON($pdo);
?>
