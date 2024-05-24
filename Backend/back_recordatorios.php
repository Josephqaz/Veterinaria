<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMascota = $_POST['idMascota'];
    $fecha = $_POST['fecha'];
    $tipoServicio = $_POST['tipoServicio'];

    try {
        $query = "INSERT INTO recordatorios (idMascota, fecha, idservicio) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$idMascota, $fecha, $tipoServicio])) {
            $_SESSION['message'] = "¡Éxito! Recordatorio programado con éxito.";
        } else {
            $_SESSION['message'] = "¡Error! No se pudo programar el recordatorio.";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "¡Error! Error de base de datos: " . $e->getMessage();
    }
    header("Location: ../recordatorios.php");
    exit;
}
?>
