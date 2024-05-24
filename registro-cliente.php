<?php include("includes/header.php") ?>
<div class="container mt-5">
    <h2>Registro de Cliente</h2>
    <form action="/Backend/back_cliente.php" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu email" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

</body>
<?php include("includes/footer.php") ?>
