<?php

function sacar_texto_bien($textomalo) {
       return mb_convert_encoding($textomalo, 'UTF-8',
           mb_detect_encoding($textomalo, 'UTF-8, ISO-8859-1', true));
}



/**
 * Pide información a la api de aemet
 * @parametrosapi debe empezar por / y acabar sin /
 */
function curl_aemet($parametrosapi) {
  $curl = curl_init();
  $api_key = file_get_contents("../apikey");
  $parametrosapi="/ccaa/hoy/rio";
  $envio = "https://opendata.aemet.es/opendata/api/prediccion".$parametrosapi."/?api_key=".$api_key;
  curl_setopt_array($curl, array(
    CURLOPT_URL => $envio,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
    ),
  ));

  $respuesta = curl_exec($curl);
  curl_close($curl);

  return($respuesta);
}

/**
 * DEVUELVE UN ARRAY
 * textoFenomeno
 * textoPrediccion
 */
function extraerPrediccion($textoprediccion) {
  $FenomenoPosicion = mb_strpos($textoprediccion, "A.- FENÓMENOS SIGNIFICATIVOS") + mb_strlen("A.- FENÓMENOS SIGNIFICATIVOS"); // Coge la posición de Fenomenos y de Prediccion
  $PrediccionPosicion = mb_strpos($textoprediccion, "B.- PREDICCIÓN") + mb_strlen("B.- PREDICCIÓN");                           // Le añadimos la longitud del titulo de tal por que cuando agarras un substring
  $FenomenoLongitud = $PrediccionPosicion - $FenomenoPosicion - mb_strlen("B.- PREDICCIÓN");                                   // te coge la posicion de donde empieza el string y no queremos el titulo en el resultado
                                                                                                                               // luego para calcular como de largo es el string de fenomeno hay que volver a sacar la posicion
  $TextoFenomeno = mb_substr($textoprediccion, $FenomenoPosicion, $FenomenoLongitud);                                          // del comienzo del substring de prediccion por que si no nos pone "B.- PREDDICIÓN" al final
  $TextoPrediccion = mb_substr($textoprediccion, $PrediccionPosicion);
  
  $arrayprediccion = array();
    $arrayprediccion['textoFenomeno'] = $TextoFenomeno;
    $arrayprediccion['textoPrediccion'] = $TextoPrediccion;

  return $arrayprediccion;
};



?>