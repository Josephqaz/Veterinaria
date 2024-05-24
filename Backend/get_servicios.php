<?php
include 'conexion.php';

$query = "SELECT idServicio, nombre, costo FROM Servicios";
$stmt = $pdo->query($query);
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($servicios);
?>
