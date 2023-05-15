$(document).ready(function(){
    $("#cerrarsesion").on("click", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "funciones/cerrarsesion.php",
            success: function (respuesta) {
                if(respuesta == "exito"){
                    const sesioncerrada = document.createElement("<div>")
                    sesioncerrada.innerhtml = [
                        '<div>Se ha cerrado la sesión</div>' +
                        '<a href="index.php">Volver a Inicio</a>'
                    ]
                    $("#perfil").html(sesioncerrada);
                }else {
                    alert("Ha habido un error")
                }
                
            }
        });
      })
})