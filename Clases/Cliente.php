<?php
class Cliente {
    private $pdo;

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registrar() {
        $query = "INSERT INTO Clientes (nombre, apellido, telefono, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$this->nombre, $this->apellido, $this->telefono, $this->email]);
    }

    public function obtenerPorId() {
        $query = "SELECT * FROM Clientes WHERE idCliente = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna los datos del cliente o false si no encuentra nada
    }

    public function editar() {
        $query = "UPDATE Clientes SET nombre = ?, apellido = ?, telefono = ?, email = ? WHERE idCliente = ?";
        try {
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([
                $this->nombre, 
                $this->apellido, 
                $this->telefono, 
                $this->email,
                $this->id
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar cliente: " . $e->getMessage());
            throw $e;
        }
    }

    public function eliminar() {
        $query = "DELETE FROM Clientes WHERE idCliente = ?";
        try {
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([$this->id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar cliente: " . $e->getMessage());
            throw $e;
        }
    }
}
?>
