<?php
class Factura {
    private $pdo;

    public $idCliente;
    public $idMascota;
    public $idServicio;
    public $fecha;
    public $costo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear() {
        try {
            $this->pdo->beginTransaction();
            $query = "INSERT INTO facturacion (idCliente, idMascota, idServicio, fecha, total) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$this->idCliente, $this->idMascota, $this->idServicio, $this->fecha, $this->costo]);
            
            if ($stmt->rowCount()) {
                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    // Agregar otros métodos útiles aquí, como uno para la validación de datos
}