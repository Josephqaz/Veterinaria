<?php include("includes/header.php") ?>
<div class="container mt-5">
    <h2>Registro de Mascotas</h2>
    <form action="Backend/back_mascota.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Mascota:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="especie" class="form-label">Especie:</label>
            <input type="text" class="form-control" id="especie" name="especie" required>
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza:</label>
            <input type="text" class="form-control" id="raza" name="raza" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color:</label>
            <input type="text" class="form-control" id="color" name="color" required>
        </div>
        <div class="mb-3">
            <label for="tamano" class="form-label">Tamaño:</label>
            <input type="text" class="form-control" id="tamano" name="tamano" required>
        </div>
        <div class="mb-3">
            <label for="anoNacimiento" class="form-label">Año de Nacimiento:</label>
            <input type="number" class="form-control" id="anoNacimiento" name="anoNacimiento" required>
        </div>
        <!-- Nuevo campo para seleccionar el dueño de la mascota -->
        <div class="mb-3">
            <label for="idCliente" class="form-label">Dueño de la Mascota:</label>
            <select class="form-control" id="idCliente" name="idCliente" required>
                <?php
                include 'Backend/conexion.php';  // Asegúrate de que la ruta al archivo de conexión es correcta.
                try {
                    $stmt = $pdo->query("SELECT idCliente, nombre FROM Clientes");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['idCliente']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                    }
                } catch (PDOException $e) {
                    echo "<option>Error al cargar clientes</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Mascota</button>
    </form>
</div>
</body>
<?php include("includes/footer.php") ?>
