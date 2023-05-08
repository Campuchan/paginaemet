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
  <p class="text-center">¿Ya tienes una cuenta?<a href="/login.php"> Inicia sesión</a> </p>

    <form action="funciones/registroengine.php" class="border col-lg-8 mx-auto p-4 py-md-3 w-25" id="formularioregistro" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input id="usuario" type="user" class="form-control" placeholder="">
                <div id="usuariomal" class="text-danger"></div>
                <div id="ayudacontrasena" class="form-text">
                  El nombre de usuario debe de tener entre 4 y 21 carácteres, solo letras y números. No puede contener espacios, carácteres especiales o emojis.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com">
                <div id="email" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <i class="bi bi-eye-slash-fill" id="ojocontra" role="button""></i>
                <label for="contrasena" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="contrasena">
                <i class="bi bi-eye-fill" id="ojoconfcontra" role="button"></i>
                <label for="conf-contrasena" class="form-label">Confimar contraseña</label>
                  <input type="password" class="form-control" id="conf-contrasena">
                <div id="contramal" class="text-danger"></div>
                <div id="nocoincide" class="text-danger"></div>
                <div id="ayudacontrasena" class="form-text">
                  La contraseña de usuario debe de tener entre 8 y 21 carácteres, solo letras y números. No puede contener espacios, carácteres especiales o emojis.
                </div>
            </div>
            <input class="w-100 btn btn-lg btn-primary" id="enviarformulario" type="submit" value="Enviar">    
    </form>
</body>


<script>


$(document).ready(function(){
  const regexcontra = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,21}$/g;
  const regexemail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
  const regexusuario = /^[a-zA-Z0-9]{4,21}$/g;
  var usuariobien = 0, correobien = 0, contrabien = 0;
  $('#enviarformulario').attr('disabled', 'true');
  $("#formularioregistro").submit(function(event) {
    var contrasena = $("#contrasena").val();
    var confcontrasena = $("#conf-contrasena").val();
      if (contrasena != confcontrasena){
        contrabien = 0;
        checkregistro();
        event.preventDefault();
      }
    var usuario = $("#usuario").val();
      if (!regexusuario.test(usuario)){
        event.preventDefault();
        $("#usuariomal").text("El usuario es incorrecto");
      }
    var email = $("#email").val();
      if (!regexemail.test()){
        event.preventDefault();
        $("#emailmal").text("El email es incorrecto");
      }
  });

  $("#email").on({
    focusout: function() {
    var email = $("#email").val();

    if (regexemail.test(email)) {
      correobien = 1;
      $("#emailmal").text("");
      checkregistro()
    } else {
      console.log(email)
      console.log("penemail");
      correobien = 0;
      $("#emailmal").text("El email es incorrecto");
      checkregistro()
    }},
    input: function() {
      var email = $("#email").val();
      console.log("AAAAAAAAA")
      if (regexemail.test(email)) {
        correobien = 1;
        $("#emailmal").text("");
        checkregistro()
      }
    }});

  $("#usuario").on({
    focusout: function() {
    var usuario = $("#usuario").val();
    if (regexusuario.test(usuario)) {
      usuariobien = 1;
      $("#usuariomal").text("");
      checkregistro()
    } else {
      usuariobien = 0;
      $("#usuariomal").text("El usuario es incorrecto");
      checkregistro()
    }},
    input: function () {
    var usuario = $("#usuario").val();
    if (regexusuario.test(usuario)) {
      console.log("PENE")
      usuariobien = 1;
      $("#usuariomal").text("");
    }
    }});

  $("#contrasena").on("input", function() {
    checkregistro();
  });

  $("#contrasena").on("input", function() {
    console.log(contrasena);
    var contrasena = $("#contrasena").val();
        console.log(contrasena)
    if (regexcontra.test(contrasena)) {
      console.log("contraseña bien")
      contrabien = 1;
      $("#contramal").text("");
      checkregistro()
    } else {
      checkregistro()
    }
  });
  

  function checkregistro() {
    var contrasena = $("#contrasena").val();
    var confcontrasena = $("#conf-contrasena").val();
      if (contrasena != confcontrasena){
        contrabien = 0;
        event.preventDefault();
      }
      console.log("aaaaasdasdda");
    /*var usuario = $("#usuario").val();
      if (!regexusuario.test(usuario)){
        event.preventDefault();
        $("#usuariomal").text("El usuario es incorrecto");
      } else {
        usuariobien = 1;
      }
    var email = $("#email").val();
      if (!regexemail.test()){
        event.preventDefault();
        $("#emailmal").text("El email es incorrecto");
        correobien = 1;
      }
    */
    if (contrabien == 1 && correobien == 1 && usuariobien == 1) {
      $('#enviarformulario').removeAttr('disabled');
      console.log(contrabien);
      console.log(correobien);
      console.log(usuariobien);

      
    } else {
      $('#enviarformulario').attr('disabled', 'true');
      console.log(contrabien);
      console.log(correobien);
      console.log(usuariobien);
    }
  }


  //botones de mostrar contraseña

});


</script>
</html>
