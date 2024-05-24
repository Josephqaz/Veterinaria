<?php include("includes/header.php") ?>

<div class="container mt-5">
    <h2>Historia Clínica de Mascotas</h2>
    <form>
        <div class="mb-3">
            <label for="idCliente" class="form-label">Cliente:</label>
            <select class="form-control" id="idCliente" name="idCliente" required onchange="cargarMascotas()">
                <option value="">Seleccione un cliente</option>
                <!-- Las opciones de clientes se cargan aquí -->
            </select>
        </div>
        <div class="mb-3">
            <label for="idMascota" class="form-label">Mascota:</label>
            <select class="form-control" id="idMascota" name="idMascota" required onchange="cargarHistorialClinico()">
                <option value="">Seleccione una mascota</option>
                <!-- Las opciones de mascotas se cargarán dinámicamente con JavaScript/AJAX -->
            </select>
        </div>
    </form>
    <div class="mt-5">
        <h3>Historial Clínico</h3>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID Historial</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody id="historialClinicoTableBody">
                <!-- Datos del historial clínico se cargarán aquí dinámicamente -->
            </tbody>
        </table>
    </div>
</div>

<!-- Incluir el archivo de scripts -->
<script src="js/scripts.js"></script>
<script>
<?php
session_start();
if (!empty($_SESSION['message'])) {
    echo "Swal.fire({text: '" . $_SESSION['message'] . "', icon: 'info'});";
    unset($_SESSION['message']);
}
?>
</script>
<?php include("includes/footer.php") ?>
