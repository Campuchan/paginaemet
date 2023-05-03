<?php 
    include("../funciones/librerias.php");
    $ccaa = $_POST["ccaa"];
    
    $aemet = curl_aemet("ccaa/hoy/". $ccaa);
    $respuesta = json_decode($aemet);
        
    $datos = file_get_contents($respuesta->datos);
    $datosbien = sacar_texto_bien($datos);
    $prediccion = extraerPrediccion($datosbien);
    echo "Prediccion: ". $prediccion["textoPrediccion"]. "<br>";
    echo "Fenomenos significativos: ". $prediccion["textoFenomeno"];

?>