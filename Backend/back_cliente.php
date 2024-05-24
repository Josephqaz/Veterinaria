<?php
session_start();
include 'conexion.php';
include '../Clases/Cliente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = new Cliente($pdo);

    $cliente->nombre = $_POST['nombre'];
    $cliente->apellido = $_POST['apellido'];
    $cliente->telefono = $_POST['telefono'] ?? '';  // Uso del operador null coalescente para manejar datos no proporcionados
    $cliente->email = $_POST['email'];

    try {
        if ($cliente->registrar()) {
            $_SESSION['message'] = "Éxito|Cliente registrado con éxito.|success";
        } else {
            $_SESSION['message'] = "Error|No se pudo registrar el cliente.|error";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error|Error de base de datos: " . addslashes($e->getMessage()) . "|error";
    }

    header("Location: ../registro-cliente.php");
    exit;
}
?>