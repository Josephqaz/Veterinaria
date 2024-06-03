<?php
session_start();

require_once 'conexion.php';
require_once '../Clases/Cliente.php';

$cliente = new Cliente($pdo);

// Intentar cargar datos del cliente cuando se recibe ID por GET
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $cliente->id = $_GET['id'];
    $datosCliente = $cliente->obtenerPorId();

    if (!$datosCliente) {
        $_SESSION['message'] = "Cliente no encontrado.";
        header("Location: ../Home.php");
        exit;
    }
}

// Procesar actualización del cliente cuando se recibe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idCliente'])) {
    $cliente->id = $_POST['idCliente'];
    $cliente->nombre = $_POST['nombre'];
    $cliente->apellido = $_POST['apellido'];
    $cliente->telefono = $_POST['telefono'];
    $cliente->email = $_POST['email'];

    if ($cliente->editar()) {
        $_SESSION['message'] = "Cliente actualizado con éxito.";
        header("Location: ../consulta-eliminar.php");
        exit;
    } else {
        $_SESSION['message'] = "Error al actualizar el cliente.";
    }
}

if (isset($datosCliente)) :
?>
<?php include("../includes/header.php") ?>
<body>
    <div class="container mt-5">
        <h2>Editar Cliente</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $cliente->id; ?>" method="POST">
            <input type="hidden" name="idCliente" value="<?php echo $cliente->id; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($datosCliente['nombre']); ?>">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required value="<?php echo htmlspecialchars($datosCliente['apellido']); ?>">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required value="<?php echo htmlspecialchars($datosCliente['telefono']); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($datosCliente['email']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
<?php include("../includes/footer.php") ?>
<?php endif; ?>