$(document).ready(function(){
    const regexcontra = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,21}$/;
    const regexemail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    const regexusuario = /^[a-zA-Z0-9]{4,21}$/;
    var usuariobien = 0, correobien = 0, contrabien = 0;
    $('#enviarformulario').attr('disabled', 'true');
    $("#enviarregistro").submit(function(event) {
        event.preventDefault();
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
          url: "/funciones/iniciosesion.php",
          data: {contrasena: contrasena, usuario: usuario},
          }).done(function(respuesta){
            if(respuesta == "exito"){
              
            }
          }).error(
            console.log("error registro")
          )
  
  
    //botones de mostrar contraseña
  
  });
});