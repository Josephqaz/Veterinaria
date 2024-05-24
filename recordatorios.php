<?php include("includes/header.php") ?>

<div class="container mt-5">
    <h2>Gestión de Servicios Veterinarios</h2>
    <form action="Backend/back_recordatorios.php" method="POST">
        <div class="mb-3">
            <label for="idMascota" class="form-label">ID de la Mascota:</label>
            <select class="form-control" id="idMascota" name="idMascota" required>
                <option value="">Seleccione una mascota</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha del Servicio:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="tipoServicio" class="form-label">Tipo de Servicio:</label>
            <select class="form-control" id="tipoServicio" name="tipoServicio" required>
                <option value="">Seleccione un servicio</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <div class="mt-5">
        <h3>Recordatorios de Mascota</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Recordatorio</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody id="recordatoriosTableBody">
                <!-- Datos de recordatorios se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Incluir el archivo de scripts -->
<script src="js/scripts.js"></script>
<?php include("includes/footer.php") ?>
