<?php
class Mascota {

    private $pdo;
    public $id;
    public $nombre;
    public $especie;
    public $raza;
    public $color;
    public $tamano;
    public $anoNacimiento;
    public $idCliente;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrar() {
        $query = "INSERT INTO Mascotas (nombre, especie, raza, color, tamano, anoNacimiento, idCliente) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $this->pdo->prepare($query);
            if ($stmt->execute([$this->nombre, $this->especie, $this->raza, $this->color, $this->tamano, $this->anoNacimiento, $this->idCliente])) {
                $this->id = $this->pdo->lastInsertId();
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al registrar mascota: " . $e->getMessage());
            throw $e;
        }
    }

    public function obtenerPorId() {
        $query = "SELECT * FROM Mascotas WHERE idMascota = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearHistorialClinico() {
        $descripcion = "CREACIÓN DE HISTORIAL";
        $query = "INSERT INTO HistorialesClinicos (idMascota, fecha, descripcion) VALUES (?, CURDATE(), ?)";
        try {
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([$this->id, $descripcion]);
        } catch (PDOException $e) {
            error_log("Error al crear historial clínico: " . $e->getMessage());
            throw $e;
        }
    }

    public function editar() {
        $query = "UPDATE Mascotas SET nombre = ?, especie = ?, raza = ?, color = ?, tamano = ?, anoNacimiento = ?, idCliente = ? WHERE idMascota = ?";
        try {
            $stmt = $this->pdo->prepare($query);
            error_log("Actualizando mascota ID: {$this->id} con idCliente: {$this->idCliente}");
            return $stmt->execute([
                $this->nombre,
                $this->especie,
                $this->raza,
                $this->color,
                $this->tamano,
                $this->anoNacimiento,
                $this->idCliente,
                $this->id
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar mascota: " . $e->getMessage());
            throw $e;
        }
    }

    public function eliminarConDependencias() {
        try {
            // Inicia la transacción
            $this->pdo->beginTransaction();

            // Elimina las dependencias (por ejemplo, registros en otras tablas que dependan de la mascota)
            $stmt = $this->pdo->prepare("DELETE FROM recordatorios WHERE idMascota = :idMascota");
            $stmt->bindParam(':idMascota', $this->id);
            $stmt->execute();

            // Elimina las dependencias (por ejemplo, registros en otras tablas que dependan de la mascota)
            $stmt = $this->pdo->prepare("DELETE FROM historialesclinicos WHERE idMascota = :idMascota");
            $stmt->bindParam(':idMascota', $this->id);
            $stmt->execute();

            // Elimina la mascota
            $stmt = $this->pdo->prepare("DELETE FROM Mascotas WHERE idMascota = :idMascota");
            $stmt->bindParam(':idMascota', $this->id);
            $stmt->execute();

            // Confirma la transacción
            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Si ocurre un error, revierte la transacción
            $this->pdo->rollBack();
            return false;
        }
    }

    public static function obtenerTodas($pdo) {
        $query = "SELECT idMascota, nombre, especie FROM Mascotas";
        $stmt = $pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTodasJSON($pdo) {
        $mascotas = self::obtenerTodas($pdo);
        return json_encode($mascotas);
    }
}
?>
