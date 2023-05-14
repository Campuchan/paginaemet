<?php 
      include("funciones/basededatos.php"); ?>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
  </head>
  <body>
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
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<main style="padding-top: 56px;" class="container">

  <h1 class="text-center">Crear cuenta</h1>
  <p class="text-center">¿Ya tienes una cuenta? <a href="/iniciosesion.php">Inicia sesión</a> </p>
    <div id="errores"></div>
    <div id="registro">
    <form action="funciones/registroengine.php" class="border col-lg-8 mx-auto p-4 py-md-3 w-25" id="formularioregistro" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input id="usuario" type="text" class="form-control" placeholder="">
                <div id="usuariomal" class="text-danger"></div>
                <div id="ayudacontrasena" class="form-text">
                  El nombre de usuario debe de tener entre 4 y 21 carácteres, solo letras y números. No puede contener espacios, carácteres especiales o emojis.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com">
                <div id="emailmal" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <i class="bi bi-eye-slash-fill" id="ojocontra" role="button"></i>
                <label for="contrasena" class="form-label user-select-none">Contraseña</label>
                  <input type="password" class="form-control" id="contrasena">
                <i class="bi bi-eye-slash-fill" id="ojoconfcontra" role="button"></i>
                <label for="conf-contrasena" class="form-label user-select-none">Confimar contraseña</label>
                  <input type="password" class="form-control" id="conf-contrasena">
                <div id="contramal" class="text-danger"></div>
                <div id="nocoincide" class="text-danger"></div>
                <div id="ayudacontrasena" class="form-text">
                  La contraseña de usuario debe de tener entre 8 y 21 carácteres, solo letras y números. No puede contener espacios, carácteres especiales o emojis.
                </div>
            </div>
            <input class="w-100 btn btn-lg btn-primary" id="enviarregistro" type="submit" value="Enviar">    
    </form>
    </div>
</body>


<script src="funciones/registrousuario.js"></script>
</html>
