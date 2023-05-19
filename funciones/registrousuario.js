$(document).ready(function(){
    const regexcontra = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,21}$/;
    const regexemail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    const regexusuario = /^[a-zA-Z0-9]{4,21}$/;
    var usuariobien = 0, correobien = 0, contrabien = 0;
    $('#enviarregistro').attr('disabled', 'true');
    $("#enviarregistro").submit(function(event) {
        event.preventDefault()
      })
    $("#email").on({
      focusout: function() {
      var email = $("#email").val();
      if (regexemail.test(email)){
        correobien = 1;
        $("#emailmal").text("");
        checkregistro()
      } else {
        correobien = 0;
        $("#emailmal").text("El email es incorrecto");
        checkregistro()
      }},
      input: function() {
        var email = $("#email").val();
          if (regexemail.test(email)){
          correobien = 1;
          $("#emailmal").text("");
          checkregistro()
        }
      }});

    $("#usuario").on({
      focusout: function() {
      var usuario = $("#usuario").val();
      if (regexusuario.test(usuario)){
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
      if (regexusuario.test(usuario)){
        usuariobien = 1;
        $("#usuariomal").text("");
      } else {
        usuariobien = 0;
        $("#usuariomal").text("El usuario es incorrecto");
        checkregistro()
      }},
    });
  
    $("#contrasena").on("input focusout", function(){
      console.log(contrasena);
      var contrasena = $("#contrasena").val();
      if (regexcontra.test(contrasena)){
        contrabien = 1;
        $("#contramal").text("");
        var contrasena = $("#contrasena").val();
        var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          contrabien = 0;
          $("#contramal").text("Las contraseñas no coinciden");
        } else {
        }
      }
      else {
          contrabien = 0;
          $("#contramal").text("La contraseña es incorrecta")
        }
      checkregistro()
        }
    );

    $("#conf-contrasena").on("input focusout", function() {
        var confcontrasena = $("#conf-contrasena").val();
        if (regexcontra.test(confcontrasena)){
          contrabien = 1;
          $("#contramal").text("");
          var contrasena = $("#contrasena").val(); 
          var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          $("#contramal").text("Las contraseñas no coinciden");
          contrabien = 0;
        }
        }
        checkregistro()
      });
    
    $("#ojocontra").on("click", function(){
      if($(this).hasClass("bi-eye-fill")){ //SI se ve -> NO se ve
        $(this).addClass("bi-eye-slash-fill");
        $(this).removeClass("bi-eye-fill");
        $("#contrasena").attr("type", "password")
      } else 
      if ($(this).hasClass("bi-eye-slash-fill")){ //NO se ve -> SI se ve
        $(this).addClass("bi-eye-fill");
        $(this).removeClass("bi-eye-slash-fill");
        $("#contrasena").attr("type", "text")
      }
    })
  
    $("#ojoconfcontra").on("click", function() {
      if($(this).hasClass("bi-eye-fill")){ //SI se ve -> NO se ve
        $(this).addClass("bi-eye-slash-fill");
        $(this).removeClass("bi-eye-fill");
        $("#conf-contrasena").attr("type", "password")
      } else 
      if ($(this).hasClass("bi-eye-slash-fill")){ //NO se ve -> SI se ve
        $(this).addClass("bi-eye-fill");
        $(this).removeClass("bi-eye-slash-fill");
        $("#conf-contrasena").attr("type", "text")
      }
    })
  
    function checkregistro() {
      if (contrabien == 1 && correobien == 1 && usuariobien == 1) {
        $('#enviarregistro').removeAttr('disabled');
        return "correcto";
      } else {
        $('#enviarregistro').attr('disabled', 'true');
        return "incorrecto";
      }
    }

    $(document).on("submit", '#formularioregistro' , function(event){
        event.preventDefault();

        var usuario = $("#usuario").val();
        var contrasena = $("#contrasena").val();
        
        var email = $("#email").val();
        var confcontrasena = $("#conf-contrasena").val();
        
        if (contrasena != confcontrasena){
          contrabien = 0;
          checkregistro();
        }
      var usuario = $("#usuario").val();
        if (!regexusuario.test(usuario)){
           userbien = 0;
          $("#usuariomal").text("El usuario es incorrecto");
        }
      var email = $("#email").val();
        if (!regexemail.test(email)){
            correobien = 0;
          $("#emailmal").text("El email es incorrecto");
        }
        var check = checkregistro();
        if (check == "correcto"){
          $.ajax({
            type: "POST",
            url: "/funciones/registrousuario.php",
            data: {email: email, contrasena: contrasena, usuario: usuario},
            }).done(function(respuesta){
              console.log(respuesta);
              if(respuesta == "exito"){
                let htmlexito = "<h3>¡Exito!</h3>" +
                                "<p> Ahora ve a <a href='iniciosesion.php'>iniciar sesión</a></p>";
                $("#registro").html(htmlexito);
              }
              else if(respuesta == "correoenuso"){
                const errorcorreo = document.createElement('div')
                errorcorreo.innerHTML = [
                  '<div class="alert alert-danger alert-dismissible w-25 mx-auto" role="alert">' +
                  '   <div>Este correo está en uso</div>' +
                  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                  '</div>'
                ]
                $("#errores").append(errorcorreo);
              }
              else if(respuesta == "usuarioenuso"){
                const errorusuario = document.createElement('div')
                errorusuario.innerHTML = [
                  '<div class="alert alert-danger alert-dismissible w-25 mx-auto" role="alert">' +
                  '   <div>Este usuario está en uso</div>' +
                  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                  '</div>'
                ]
                $("#errores").append(errorusuario);
              }
            })
        } else {
          const errorgeneral = document.createElement('div')
                  errorgeneral.innerHTML = [
                  '<div class="alert alert-danger alert-dismissible w-25 mx-auto" role="alert">' +
                  '   <div>Algo ha salido mal</div>' +
                  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                  '</div>'
                ]
                $("#errores").append(errorgeneral);
        }
    //botones de mostrar contraseña
  });
});
