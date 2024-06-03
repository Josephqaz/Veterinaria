<?php
session_start();
require_once 'conexion.php';
require_once '../Clases/Mascota.php';

$mascota = new Mascota($pdo);

// Comprobar si se recibió el ID de la mascota vía GET y cargar sus datos
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $mascota->id = $_GET['id'];
    $datosMascota = $mascota->obtenerPorId();

    if (!$datosMascota) {
        $_SESSION['message'] = "Mascota no encontrada.";
        header("Location: ../Home.php");
        exit;
    } else {
        // Asignar los datos de la mascota a variables locales para usar en el formulario
        $nombre = $datosMascota['nombre'];
        $especie = $datosMascota['especie'];
        $raza = $datosMascota['raza'];
        $color = $datosMascota['color'];
        $tamano = $datosMascota['tamano'];
        $anoNacimiento = $datosMascota['anoNacimiento'];
        $idCliente = $datosMascota['idCliente'];
    }
} else {
    $_SESSION['message'] = "No se proporcionó un ID de Mascota válido.";
    header("Location: ../Home.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mascota->nombre = $_POST['nombre'];
    $mascota->especie = $_POST['especie'];
    $mascota->raza = $_POST['raza'];
    $mascota->color = $_POST['color'];
    $mascota->tamano = $_POST['tamano'];
    $mascota->anoNacimiento = $_POST['anoNacimiento'];
    $mascota->idCliente = $idCliente;

    // Asignar un idCliente estático (asegúrate de que este ID existe en tu tabla de clientes)

    if ($mascota->editar()) {
        $_SESSION['message'] = "Mascota actualizada con éxito.";
        header("Location: ../consulta-eliminar.php");
        exit;
    } else {
        $_SESSION['message'] = "Error al actualizar la mascota.";
        header("Location: ../Home.php");
        exit;
    }
}
?>

<?php include("../includes/header.php") ?>

<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Mascota</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $mascota->id; ?>" method="POST">
        <input type="hidden" name="idMascota" value="<?php echo $mascota->id; ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($nombre); ?>">
        </div>
        <div class="mb-3">
            <label for="especie" class="form-label">Especie</label>
            <input type="text" class="form-control" id="especie" name="especie" required value="<?php echo htmlspecialchars($especie); ?>">
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" required value="<?php echo htmlspecialchars($raza); ?>">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?php echo htmlspecialchars($color); ?>">
        </div>
        <div class="mb-3">
            <label for="tamano" class="form-label">Tamaño</label>
            <input type="text" class="form-control" id="tamano" name="tamano" value="<?php echo htmlspecialchars($tamano); ?>">
        </div>
        <div class="mb-3">
            <label for="anoNacimiento" class="form-label">Año de Nacimiento</label>
            <input type="number" class="form-control" id="anoNacimiento" name="anoNacimiento" value="<?php echo htmlspecialchars($anoNacimiento); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<?php include("../includes/footer.php") ?>