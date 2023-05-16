$(document).ready(function(){
    $.ajax({
      type: "POST",
        url: "funciones/selectorload.php",
        success: function (respuesta) { 
          console.log(respuesta)
          $("#ccaa").remove();
          $("#selector").append(respuesta);
         }
    }),

    
    $(document).on("change", '#ccaa' , function(){
      $.ajax({
        type: "POST",
        url: "funciones/selector.php",
        data: $(this).serialize(),
        success: function (respuesta) { 
          console.log(respuesta)
          $("#selectorprovincia").remove();
          $("#selectormunicipio").remove();
          $("#preddiccionTiempo").remove(); 
          $("#selector").append(respuesta);
         },
        error: function (error) { 
          alert("ha ocurrido un error: " + error);
         }
        
      })
    })

    $(document).on("change", '#provincia' , function(){
      $.ajax({
        type: "POST",
        url: "funciones/selector.php",
        data: $(this).serialize(),
        success: function (respuesta) { 
          console.log(respuesta)
          $("#preddiccionTiempo").remove(); 
          $("#selectormunicipio").remove();
          $("#selector").append(respuesta);
         },
        error: function (error) { 
          alert("ha ocurrido un error: " + error);
         }
        
      })
    })

    $(document).on("change", '#municipio' , function(){
      $.ajax({
        type: "POST",
        url: "funciones/selector.php",
        data: $(this).serialize(),
        success: function (respuesta) { 
          console.log(respuesta)
          $("#preddiccionTiempo").remove();
          $("#selector").append(respuesta);
         },
        error: function (error) { 
          alert("ha ocurrido un error: " + error);
         }
        
      })
    })

    $(document).on("click", '#preddiccionTiempo' , function(event){
      event.preventDefault();

      var municipio = $("#municipio").val();
      console.log(municipio)
      var provincia = $("#provincia").val();
      console.log(provincia)

      $.ajax({
        type: "POST",
        url: "aemet/municipio.php",
        data: {municipio: municipio, provincia: provincia},
      }).done(function(respuesta){
        $("#tiempo").html(respuesta);
      })

      $.ajax({
        type: "POST",
        url: "aemet/ccaa.php",
        data: {ccaa: ccaa},
      }).done(function(respuesta){
        $("#preddicion").html(respuesta)
      })
    })

    $(document).on("click", '#escondernodisponible', function(){
        $(".noexiste").hide();
    })

    //BOTON MOSTRAR DIAS

    $(document).on("click", '.esconderdia', function(){
      $(this).siblings('div').toggle();
    });

  });