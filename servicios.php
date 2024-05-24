<?php include("includes/header.php") ?>

<div class="container mt-5">
    <h2>Gestión de Servicios Veterinarios</h2>
    <form action="Backend/back_servicios.php" method="POST">
        <div class="mb-3">
            <label for="idServicio" class="form-label">ID del Servicio (requerido para editar/eliminar):</label>
            <input type="number" class="form-control" id="idServicio" name="idServicio" placeholder="Ingrese el ID del servicio si edita o elimina">
        </div>
        <div class="mb-3">
            <label for="nombreServicio" class="form-label">Nombre del Servicio:</label>
            <input type="text" class="form-control" id="nombreServicio" name="nombreServicio" placeholder="Nombre del servicio" required>
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo del Servicio ($):</label>
            <input type="number" class="form-control" id="costo" name="costo" placeholder="Costo del servicio" required>
        </div>
        <div class="mb-3">
            <label for="operacion" class="form-label">Operación:</label>
            <select class="form-control" id="operacion" name="operacion">
                <option value="agregar">Agregar Nuevo Servicio</option>
                <option value="editar">Editar Servicio Existente</option>
                <option value="eliminar">Eliminar Servicio</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Tabla para mostrar servicios existentes -->
    <div class="mt-5">
        <h3>Servicios Existentes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'Backend/conexion.php';
                $query = "SELECT * FROM servicios";
                $stmt = $pdo->query($query);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>{$row['idServicio']}</td>";
                    echo "<td>{$row['nombre']}</td>";
                    echo "<td>\${$row['costo']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("includes/footer.php") ?>
