<?php
class HistorialClinico {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerHistorialPorMascota($idMascota) {
        $query = "SELECT h.idHistorial, h.fecha, h.descripcion, m.nombre AS nombreMascota
                  FROM HistorialesClinicos h
                  JOIN Mascotas m ON h.idMascota = m.idMascota
                  WHERE h.idMascota = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$idMascota]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function crearDesdeFactura($idMascota, $idServicio, $fecha, $total) {
        $queryServicio = "SELECT nombre FROM servicios WHERE idServicio = ?";
        $stmtServicio = $this->pdo->prepare($queryServicio);
        $stmtServicio->execute([$idServicio]);
        $servicio = $stmtServicio->fetch(PDO::FETCH_ASSOC);
        $nombreServicio = $servicio ? $servicio['nombre'] : 'Servicio desconocido';
        $descripcion = "Facturación del servicio '$nombreServicio' por un monto de $total.";

        $queryHistorial = "INSERT INTO HistorialesClinicos (idMascota, fecha, descripcion) VALUES (?, ?, ?)";
        $stmtHistorial = $this->pdo->prepare($queryHistorial);
        return $stmtHistorial->execute([$idMascota, $fecha, $descripcion]);
    }
}
