<?php 
require'funciones/sesion.php';

if($id_usuario == "nosesion"){
    echo '<script>window.location.replace("index.php");</script>';
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Pablo Campuzano">
    <title>Template</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  </head>
  <body>

<div class="col-lg-8 mx-auto p-4 py-md-5">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CampuTiempo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
      </ul>
      <ul>
        <li class="nav-item">
          <a class="nav-link" href="perfil.php">Perfil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <main style="padding-top: 56px;" class="container" id="perfil">
    <h2>Bienvenido <?php echo $nombreusuario?></h2>
    <button id="cerrarsesion" class="btn btn-danger">Cerrar sesión</button>
  </main>
</div>
  </body>
</html>
<script src="funciones/perfil.js"></script>
