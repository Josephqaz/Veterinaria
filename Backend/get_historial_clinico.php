<?php
include 'conexion.php';

if (isset($_GET['idMascota'])) {
    $idMascota = $_GET['idMascota'];

    $query = "
        SELECT h.idHistorial, h.fecha, h.descripcion
        FROM HistorialesClinicos h
        WHERE h.idMascota = ?
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$idMascota]);
    $historialClinico = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($historialClinico);
}
?>
