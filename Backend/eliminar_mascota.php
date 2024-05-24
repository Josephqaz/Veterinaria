<?php
session_start();
require_once 'conexion.php';
require_once '../Clases/Mascota.php';

// Verifica si el ID de la mascota se ha enviado a través de un método POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idMascota'])) {
    $idMascota = $_POST['idMascota'];  // Carga dinámica del ID de la mascota desde el formulario

    $mascota = new Mascota($pdo);
    $mascota->id = $idMascota;

    if ($mascota->eliminarConDependencias()) {
        $_SESSION['message'] = "Mascota y todas sus dependencias eliminadas con éxito.";
    } else {
        $_SESSION['message'] = "Error al eliminar la mascota y sus dependencias.";
    }
} else {
    $_SESSION['message'] = "No se proporcionó un ID de mascota válido.";
}

header("Location: ../consulta-eliminar.php");
exit;
?>
