<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
  <title>Blog PHP 8</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Clinica Veterinaria</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="../registro-cliente.php">Registro Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../registro-mascota.php">Registro Mascota</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="../historia.php">Historia Clínica</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../facturacion.php">Facturación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../recordatorios.php">Recordatorios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../servicios.php">Gestión de Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../consulta-eliminar.php">Modificar y eliminar</a>
          </li> 
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://source.unsplash.com/1600x900/?puppy" class="d-block w-100" alt="Imagen de un cachorro">
        <div class="carousel-caption d-none d-md-block">
          <h5>Cachorros felices</h5>
          <p>Descubre cómo cuidar mejor a tus cachorros.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1600x900/?Kitty" class="d-block w-100" alt="Imagen de un gato">
        <div class="carousel-caption d-none d-md-block">
          <h5>Gatos saludables</h5>
          <p>Conoce los mejores cuidados para gatos.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1600x900/?hamster" class="d-block w-100" alt="Imagen de un hámster">
        <div class="carousel-caption d-none d-md-block">
          <h5>Diferentes y adorables</h5>
          <p>Aprende más sobre estas interesantes mascotas.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container mt-5">