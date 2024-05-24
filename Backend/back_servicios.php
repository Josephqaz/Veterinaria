<?php
session_start();
include 'conexion.php';  // Asegúrate de que la ruta al archivo de conexión es correcta.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idServicio = $_POST['idServicio'] ?? null;
    $nombreServicio = $_POST['nombreServicio'] ?? null;
    $costo = $_POST['costo'] ?? null;
    $operacion = $_POST['operacion'] ?? null;

    if (!$operacion) {
        $_SESSION['message'] = "swal('¡Error!', 'No se especificó la operación a realizar.', 'error');";
        header("Location: ../gestion_servicios.php"); // Ajusta esta ruta según sea necesario
        exit;
    }

    try {
        switch ($operacion) {
            case 'agregar':
                if ($nombreServicio && isset($costo)) { // Verificar que los campos necesarios están presentes
                    $query = "INSERT INTO servicios (nombre, costo) VALUES (?, ?)";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$nombreServicio, $costo]);
                }
                break;
            case 'editar':
                if ($idServicio && $nombreServicio && isset($costo)) { // Verificar que los campos necesarios están presentes
                    $query = "UPDATE servicios SET nombre = ?, costo = ? WHERE idServicio = ?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$nombreServicio, $costo, $idServicio]);
                }
                break;
            case 'eliminar':
                if ($idServicio) { // Solo necesitamos el ID para eliminar
                    $query = "DELETE FROM servicios WHERE idServicio = ?";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$idServicio]);
                }
                break;
        }

        if ($stmt && $stmt->rowCount()) {
            $_SESSION['message'] = "swal('¡Éxito!', 'Operación sobre el servicio realizada con éxito.', 'success');";
        } else {
            $_SESSION['message'] = "swal('¡Error!', 'No se pudo completar la operación sobre el servicio.', 'error');";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "swal('¡Error!', 'Error de base de datos: " . $e->getMessage() . "', 'error');";
    }
    header("Location: ../servicios.php"); // Asegúrate de que esta ruta sea la correcta
    exit;
}
?>
