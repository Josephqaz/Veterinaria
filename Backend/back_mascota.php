<?php
session_start();
include 'conexion.php';
include '../Clases/Mascota.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mascota = new Mascota($pdo);

    $mascota->nombre = $_POST['nombre'];
    $mascota->especie = $_POST['especie'];
    $mascota->raza = $_POST['raza'];
    $mascota->color = $_POST['color'];
    $mascota->tamano = $_POST['tamano'];
    $mascota->anoNacimiento = $_POST['anoNacimiento'];
    $mascota->idCliente = $_POST['idCliente'];  // Recoger el ID del cliente del formulario

    try {
        if ($mascota->registrar()) {
            if (!$mascota->crearHistorialClinico()) {
                $_SESSION['message'] = "La mascota fue registrada, pero hubo un error al crear el historial clínico.";
            } else {
                $_SESSION['message'] = "Mascota registrada y su historial clínico creado con éxito.";
            }
        } else {
            $_SESSION['message'] = "Hubo un error al registrar la mascota.";
        }
    } catch (PDOException $e) {
        // Aquí capturas cualquier excepción y despliegas el mensaje
        $_SESSION['message'] = "Error en la base de datos: " . $e->getMessage();
    }
    
    header("Location: ../registro-mascota.php");
    exit;
}