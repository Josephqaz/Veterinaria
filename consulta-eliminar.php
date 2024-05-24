<?php
include 'Backend/conexion.php';
session_start();
// Consulta para clientes
try {
    $queryClientes = "SELECT idCliente, nombre FROM Clientes";
    $stmtClientes = $pdo->query($queryClientes);
    $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $clientes = [];
    $_SESSION['error'] = "Error al cargar clientes: " . $e->getMessage();
}

// Consulta para mascotas
try {
    $queryMascotas = "SELECT idMascota, nombre FROM Mascotas";
    $stmtMascotas = $pdo->query($queryMascotas);
    $mascotas = $stmtMascotas->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mascotas = [];
    $_SESSION['error'] = "Error al cargar mascotas: " . $e->getMessage();
}
?>
<?php include("includes/header.php") ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h2>Clientes</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['idCliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td>
                                <!-- Editar cliente -->
                                <a href="/Backend/editar_cliente.php?id=<?= $cliente['idCliente'] ?>" class="btn btn-warning">Editar</a>
                                <!-- Eliminar cliente -->
                                <form action="/Backend/eliminar_cliente.php" method="post" id="formEliminarCliente-<?= $cliente['idCliente'] ?>">
                                    <input type="hidden" name="idCliente" value="<?= $cliente['idCliente'] ?>">
                                    <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?= $cliente['idCliente'] ?>)">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h2>Mascotas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mascotas as $mascota) : ?>
                        <tr>
                            <td><?= htmlspecialchars($mascota['idMascota']) ?></td>
                            <td><?= htmlspecialchars($mascota['nombre']) ?></td>
                            <td>
                                <!-- Editar mascota -->
                                <a href="/Backend/editar_mascota.php?id=<?= $mascota['idMascota'] ?>" class="btn btn-warning">Editar</a>
                                <!-- Eliminar mascota -->
                                <form action="/Backend/eliminar_mascota.php" method="post" id="formEliminarMascota-<?= $mascota['idMascota'] ?>">
                                    <input type="hidden" name="idMascota" value="<?= $mascota['idMascota'] ?>">
                                    <button type="button" class="btn btn-danger" onclick="confirmarEliminacionMascota(<?= $mascota['idMascota'] ?>)">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function confirmarEliminacion(idCliente) {
        Swal.fire({
            title: '¿Está seguro?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario de eliminación
                document.getElementById('formEliminarCliente-' + idCliente).submit();
            }
        })
    }
</script>
<script>
    function confirmarEliminacionMascota(idMascota) {
        Swal.fire({
            title: '¿Está seguro de eliminar esta mascota?',
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario de eliminación de la mascota
                document.getElementById('formEliminarMascota-' + idMascota).submit();
            }
        })
    }
</script>
</body>
<?php include("includes/footer.php") ?>