$(document).ready(function(){
    const regexcontra = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,21}$/;
    const regexemail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    const regexusuario = /^[a-zA-Z0-9]{4,21}$/;
    var usuariobien = 0, correobien = 0, contrabien = 0;
    $('#enviarformulario').attr('disabled', 'true');
    $("#enviarregistro").submit(function(event) {
        event.preventDefault();
      var contrasena = $("#contrasena").val();
      var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          contrabien = 0;
          checkregistro();
        }
      var usuario = $("#usuario").val();
        if (!regexusuario.test(usuario)){
          event.preventDefault();
          $("#usuariomal").text("El usuario es incorrecto");
        }
      var email = $("#email").val();
        if (!regexemail.test(email)){
          event.preventDefault();
          $("#emailmal").text("El email es incorrecto");
        }
  
      })
  
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
        usuariobien = 1;
        $("#usuariomal").text("");
      }
      }});
  
    $("#contrasena").on("input", function() {
      console.log(contrasena);
      var contrasena = $("#contrasena").val();
          console.log(contrasena)
      if (regexcontra.test(contrasena)) {
        contrabien = 1;
        $("#contramal").text("");
        var contrasena = $("#contrasena").val();
        var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          contrabien = 0;
        } else {
          console.log("equisde")
        }
      }
        else {
          contrabien = 0;
          $("#contramal").text("La contraseña es incorrecta")
        }
      checkregistro()
        }
    );

    $("#conf-contrasena").on("input", function() {
        console.log(contrasena);
        var confcontrasena = $("#conf-contrasena").val();
            console.log(confcontrasena)
        if (regexcontra.test(confcontrasena)) {
          contrabien = 1;
          $("#contramal").text("");
          var contrasena = $("#contrasena").val();
          var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          contrabien = 0;
        }
        }
        checkregistro()
      });
    
    $("#ojocontra").on("click", function() {
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
      var usuario = $("#usuario").val();
        if (!regexusuario.test(usuario)){
          $("#usuariomal").text("El usuario es incorrecto");
        } else {
          usuariobien = 1;
        }
      var email = $("#email").val();
        if (!regexemail.test(email)){
          $("#emailmal").text("El email es incorrecto");
          correobien = 1;
        }
      if (contrabien == 1 && correobien == 1 && usuariobien == 1) {
        $('#enviarregistro').removeAttr('disabled');
        console.log(contrabien);
        console.log(correobien);
        console.log(usuariobien);
        console.log("equisde")
  
        
      } else {
        $('#enviarformulario').attr('disabled', 'true');
        console.log(contrabien);
        console.log(correobien);
        console.log(usuariobien);
      }
    }

    $(document).on("click", '#enviarregistro' , function(event){
        event.preventDefault();

        var usuario = $("#usuario").val();
        var contrasena = $("#contrasena").val();
        var email = $("#email").val();
      var confcontrasena = $("#conf-contrasena").val();
        if (contrasena != confcontrasena){
          contrabien = 0;
          checkregistro();
        }
        if (!regexusuario.test(usuario)){
          $("#usuariomal").text("El usuario es incorrecto");
        }
        if (!regexemail.test(email)){
          $("#emailmal").text("El email es incorrecto");
        }


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
  
  
    //botones de mostrar contraseña
  
  });
});