<?php
include 'conexion.php';

$query = "SELECT idCliente, nombre FROM Clientes";
$stmt = $pdo->query($query);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($clientes);
?>
