<?php
session_start();
include 'conexion.php'; // Asegúrate de que la ruta al archivo de conexión es correcta
include '../Clases/HistorialClinico.php';
include '../Clases/Factura.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $factura = new Factura($pdo);
    $historialClinico = new HistorialClinico($pdo);

    $factura->idCliente = $_POST['idCliente'] ?? null;
    $factura->idMascota = $_POST['idMascota'] ?? null;
    $factura->idServicio = $_POST['servicio'] ?? null;
    $factura->fecha = $_POST['fecha'] ?? null;
    $factura->costo = $_POST['costo'] ?? null;

    try {
        if ($factura->crear()) {
            // Asigna los valores necesarios para el historial a partir de la factura
            $idMascota = $factura->idMascota;
            $idServicio = $factura->idServicio;
            $fecha = $factura->fecha;
            $total = $factura->costo;
    
            // Intenta agregar un registro al historial clínico
            if (!$historialClinico->crearDesdeFactura($idMascota, $idServicio, $fecha, $total)) {
                // Manejar si la creación del historial clínico falla.
                $_SESSION['message'] = "swal('¡Éxito!', 'Factura generada pero no se pudo registrar en el historial clínico.', 'warning');";
            } else {
                $_SESSION['message'] = "swal('¡Éxito!', 'Factura generada y registrada en el historial clínico con éxito.', 'success');";
            }
        } else {
            $_SESSION['message'] = "swal('¡Error!', 'No se pudo generar la factura.', 'error');";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "swal('¡Error!', 'Error de base de datos: " . $e->getMessage() . "', 'error');";
    }
    
    header("Location: ../facturacion.php");
    exit;
}