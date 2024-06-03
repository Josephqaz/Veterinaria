<?php
include 'Backend/conexion.php';
session_start();
// Consulta para clientes
try {
    $queryClientes = "SELECT idCliente, nombre, apellido FROM Clientes"; // Incluye 'apellido' en la consulta
    $stmtClientes = $pdo->query($queryClientes);
    $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $clientes = [];
    $_SESSION['error'] = "Error al cargar clientes: " . $e->getMessage();
}

// Consulta para mascotas
try {
    $queryMascotas = "SELECT idMascota, nombre, especie FROM Mascotas"; // Incluye 'especie' en la consulta
    $stmtMascotas = $pdo->query($queryMascotas);
    $mascotas = $stmtMascotas->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mascotas = [];
    $_SESSION['error'] = "Error al cargar mascotas: " . $e->getMessage();
}
?>
<?php include("includes/header.php") ?>

<style>
    .table td, .table th {
        vertical-align: middle;
    }
    .btn-group {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container mt-5">
    <!-- Lista de Clientes -->
    <div class="row">
        <div class="col-sm-6">
            <h3>Lista de Clientes</h3>
        </div>
        <div class="col-sm-4 offset-2">
            <a href="registro-cliente.php" class="btn btn-success w-100" title="Agregar nuevo cliente"><i class="bi bi-plus-circle-fill"></i> Nuevo Cliente</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <table id="tblClientes" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['idCliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/Backend/editar_cliente.php?id=<?= $cliente['idCliente'] ?>" class="btn btn-warning" title="Editar cliente"><i class="bi bi-pencil-fill"></i> Editar</a>
                                    <button type="button" class="btn btn-danger" title="Eliminar cliente" onclick="confirmarEliminacion('cliente', <?= $cliente['idCliente'] ?>)"><i class="bi bi-trash-fill"></i> Eliminar</button>
                                    <form action="/Backend/eliminar_cliente.php" method="post" id="formEliminarCliente-<?= $cliente['idCliente'] ?>" style="display: none;">
                                        <input type="hidden" name="idCliente" value="<?= $cliente['idCliente'] ?>">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Lista de Mascotas -->
    <div class="row mt-5">
        <div class="col-sm-6">
            <h3>Lista de Mascotas</h3>
        </div>
        <div class="col-sm-4 offset-2">
            <a href="registro-mascota.php" class="btn btn-success w-100" title="Agregar nueva mascota"><i class="bi bi-plus-circle-fill"></i> Nueva Mascota</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <table id="tblMascotas" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mascotas as $mascota) : ?>
                        <tr>
                            <td><?= htmlspecialchars($mascota['idMascota']) ?></td>
                            <td><?= htmlspecialchars($mascota['nombre']) ?></td>
                            <td><?= htmlspecialchars($mascota['especie']) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/Backend/editar_mascota.php?id=<?= $mascota['idMascota'] ?>" class="btn btn-warning" title="Editar mascota"><i class="bi bi-pencil-fill"></i> Editar</a>
                                    <button type="button" class="btn btn-danger" title="Eliminar mascota" onclick="confirmarEliminacion('mascota', <?= $mascota['idMascota'] ?>)"><i class="bi bi-trash-fill"></i> Eliminar</button>
                                    <form action="/Backend/eliminar_mascota.php" method="post" id="formEliminarMascota-<?= $mascota['idMascota'] ?>" style="display: none;">
                                        <input type="hidden" name="idMascota" value="<?= $mascota['idMascota'] ?>">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminacion(tipo, id) {
        let entidad = tipo === 'cliente' ? 'cliente' : 'mascota';
        Swal.fire({
            title: `¿Está seguro de eliminar este ${entidad}?`,
            text: "Esta acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(`Enviando formulario para eliminar ${entidad} con ID: ${id}`);
                document.getElementById(`formEliminar${tipo.charAt(0).toUpperCase() + tipo.slice(1)}-` + id).submit();
            }
        })
    }
</script>
<?php include("includes/footer.php") ?>
