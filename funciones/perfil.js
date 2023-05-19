$(document).ready(function(){
    $("#cerrarsesion").on("click", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "funciones/cerrarsesion.php",
            success: function (respuesta) {
                if(respuesta == "exito"){
                    const sesioncerrada = document.createElement("div")
                    sesioncerrada.innerHTML = [
                        '<div class="h4" >Se ha cerrado la sesión</div>' +
                        '<a href="index.php">Volver a Inicio</a>'
                    ]
                    $("#perfil").html(sesioncerrada);
                }else {
                    alert("Ha habido un error")
                }
                
            }
        });
      })



    /*$("#cambiarfoto").on("click", function (event) {
        event.preventDefault();
        var datosfoto = new FormData();
        datosfoto.append("foto", $('#foto'))

        $.ajax({
            type: "POST",
            url: "funciones/cambiarfoto.php",
            data: datosfoto,
            processData: false,
            contentType: false,
            success: function (respuesta) {
                if(respuesta == "exito"){
                }else {
                    alert("Ha habido un error")
                }
                
            }
        });
      })*/
})