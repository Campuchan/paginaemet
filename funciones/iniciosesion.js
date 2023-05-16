$(document).ready(function(){
    const regexcontra = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,21}$/;
    const regexusuario = /^[a-zA-Z0-9]{4,21}$/;
    var usuariobien = 0, correobien = 0, contrabien = 0;
    $('#enviarinicio').attr('disabled', 'true');
    
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
    
    $("#usuario").on({
      focusout: function() {
      var usuario = $("#usuario").val();
      if (regexusuario.test(usuario)){
        usuariobien = 1;
        checkregistro()
      } else {
        usuariobien = 0;
        checkregistro()
      }},
      input: function () {
        console.log("holaaaaaa")
      var usuario = $("#usuario").val();
        console.log(usuario)
      if (regexusuario.test(usuario)){
        usuariobien = 1;
        checkregistro();
      } else {
        usuariobien = 0;
        checkregistro()
      }},
    });
    
    $("#contrasena").on("input focusout", function(){
      console.log(contrasena);
      var contrasena = $("#contrasena").val();
      if (regexcontra.test(contrasena)){
        contrabien = 1;
      }
      else {
        contrabien = 0;
        }
      checkregistro()
        }
    );



    function checkregistro() {
      if (contrabien == 1 && usuariobien == 1) {
        $('#enviarinicio').removeAttr('disabled');
      } else {
        $('#enviarinicio').attr('disabled', 'true');
      }
    }

    $(document).on("click", '#enviarinicio' , function(event){
        event.preventDefault();

        var usuario = $("#usuario").val();
        var contrasena = $("#contrasena").val();
        if (!regexusuario.test(usuario)){
          $("#usuariomal").text("El usuario es incorrecto");
        }

        $.ajax({
          type: "POST",
          url: "/funciones/iniciosesion.php",
          data: {contrasena: contrasena, usuario: usuario},
          }).done(function(respuesta){
            console.log(respuesta)
            if(respuesta == "exito"){
              const divrespuesta = document.createElement('div')
              divrespuesta.innerHTML = [
                '<div>' +
                '   <div>Has iniciado sesión</div>' +
                '   <div id="links"> '+
                '   <a href="perfil.php">Ir a perfil</a>    ' +
                '   <a href="index.php">Ir a inicio</a></div>  '+
                '</div>'
              ]
              $("#iniciosesion").html(divrespuesta);
            } else if(respuesta == "contraerror"){
              var diverror = document.createElement('div')
                diverror.innerHTML = [
                  '<div class="alert alert-danger alert-dismissible w-25 mx-auto" role="alert">' +
                  '   <div>La contraseña es incorrecta</div>' +
                  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                  '</div>'
                ]
                $("#errores").append(diverror);
            } else if(respuesta == "usernoexiste"){
              var diverror = document.createElement('div')
                diverror.innerHTML = [
                  '<div class="alert alert-danger alert-dismissible w-25 mx-auto" role="alert">' +
                  '   <div>No se ha encontrado al usuario</div>' +
                  '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                  '</div>'
                ]
                $("#errores").append(diverror);
            }
          })
  
  
    //botones de mostrar contraseña
  
  });
});