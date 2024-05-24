<?php
session_start();
require_once 'conexion.php';
require_once '../Clases/Cliente.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idCliente'])) {
    $idCliente = $_POST['idCliente'];

    $cliente = new Cliente($pdo);
    $cliente->id = $idCliente;

    try {
        $consultaMascotas = "SELECT COUNT(*) FROM mascotas WHERE idCliente = ?";
        $stmtMascotas = $pdo->prepare($consultaMascotas);
        $stmtMascotas->execute([$idCliente]);
        $numeroMascotas = $stmtMascotas->fetchColumn();

        if ($numeroMascotas > 0) {
            $_SESSION['message'] = "Error!|No se puede eliminar el cliente porque tiene mascotas asociadas.|error";
            header("Location: ../consulta-eliminar.php");
            exit;
        }

        $pdo->beginTransaction();
        if ($cliente->eliminar()) {
            $pdo->commit();
            $_SESSION['message'] = "Éxito|Cliente eliminado con éxito.|success";
        } else {
            $pdo->rollBack();
            $_SESSION['message'] = "Error!|Error al eliminar el cliente.|error";
        }
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['message'] = "Error!|Error al eliminar el cliente: " . $e->getMessage() . "|error";
    }

    header("Location: ../consulta-eliminar.php");
    exit;
}
?>
