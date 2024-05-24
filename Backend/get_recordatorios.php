<?php
include 'conexion.php';

if (isset($_GET['idMascota'])) {
    $idMascota = $_GET['idMascota'];

    try {
        $query = "
            SELECT r.idRecordatorio, r.fecha, s.nombre AS descripcion
            FROM recordatorios r
            JOIN servicios s ON r.idServicio = s.idServicio
            WHERE r.idMascota = ?
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$idMascota]);
        $recordatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($recordatorios);
    } catch (PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No idMascota provided']);
}
?>
