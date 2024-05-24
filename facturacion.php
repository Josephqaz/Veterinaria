<?php include("includes/header.php") ?>
<div class="container mt-5">
    <h2>Facturación de Servicios Veterinarios</h2>
    <form action="Backend/back_facturacion.php" method="POST">
        <div class="mb-3">
            <label for="idCliente" class="form-label">ID del Cliente:</label>
            <select class="form-control" id="idCliente" name="idCliente" required>
                <?php
                include 'Backend/conexion.php';  // Incluye la conexión a la base de datos
                $query = "SELECT idCliente, nombre FROM Clientes";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['idCliente'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="idMascota" class="form-label">Mascota:</label>
            <select class="form-control" id="idMascota" name="idMascota" required>
                <?php
                include 'Backend/conexion.php';  // Incluye la conexión a la base de datos
                $query = "SELECT idMascota, nombre FROM Mascotas";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['idMascota'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio Prestado:</label>
            <select class="form-control" id="servicio" name="servicio">
                <?php
                include 'Backend/conexion.php';  // Asegúrate de que la ruta al archivo de conexión es correcta.
                $query = "SELECT idServicio, nombre, costo FROM servicios";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['idServicio'] . "' data-costo='" . $row['costo'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del Servicio:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo del Servicio ($):</label>
            <input type="number" class="form-control" id="costo" name="costo" placeholder="Costo del servicio" required>
        </div>
        <button type="submit" class="btn btn-primary">Generar Factura</button>
    </form>
</div>
<script>
    // JavaScript para actualizar el costo basado en el servicio seleccionado
    document.getElementById('servicio').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var costo = selectedOption.getAttribute('data-costo');
        document.getElementById('costo').value = costo;
    });
</script>
<!-- Scripts de Bootstrap -->
<script>
    document.getElementById('idCliente').addEventListener('change', function() {
        var clienteId = this.value;
        fetch('Backend/cargar_mascota.php?idCliente=' + clienteId)
            .then(response => response.json())
            .then(data => {
                var select = document.getElementById('idMascota');
                select.innerHTML = ''; // Limpiar las opciones anteriores
                data.forEach(mascota => {
                    var option = new Option(mascota.nombre, mascota.idMascota);
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error al cargar las mascotas:', error));
    });
</script>
</body>
<?php include("includes/footer.php") ?>
