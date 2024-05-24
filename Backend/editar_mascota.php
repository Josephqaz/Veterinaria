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


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mascota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Mascota</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $mascota->id; ?>" method="POST">
        <input type="hidden" name="idMascota" value="<?php echo $mascota->id; ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($nombre); ?>">
        </div>
        <div class="form-group">
            <label for="especie">Especie</label>
            <input type="text" class="form-control" id="especie" name="especie" required value="<?php echo htmlspecialchars($especie); ?>">
        </div>
        <div class="form-group">
            <label for="raza">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" required value="<?php echo htmlspecialchars($raza); ?>">
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" value="<?php echo htmlspecialchars($color); ?>">
        </div>
        <div class="form-group">
            <label for="tamano">Tamaño</label>
            <input type="text" class="form-control" id="tamano" name="tamano" value="<?php echo htmlspecialchars($tamano); ?>">
        </div>
        <div class="form-group">
            <label for="anoNacimiento">Año de Nacimiento</label>
            <input type="number" class="form-control" id="anoNacimiento" name="anoNacimiento" value="<?php echo htmlspecialchars($anoNacimiento); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>