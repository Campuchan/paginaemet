<?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://opendata.aemet.es/opendata/api/incendios/mapasriesgo/estimado/area/p/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJwYmNhbXB1QGdtYWlsLmNvbSIsImp0aSI6ImI1YTZhZDRmLTIyMzUtNDk3Ny1iY2Y0LTk3M2Y0MGNiMzI3MSIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNjgwMTAzNzAwLCJ1c2VySWQiOiJiNWE2YWQ0Zi0yMjM1LTQ5NzctYmNmNC05NzNmNDBjYjMyNzEiLCJyb2xlIjoiIn0.TsRC2MYfEetcSRf8bPr49mIVomqQ1BUnPfLvUY-MxkM",
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
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $respuesta;
      $assocArray = json_decode($respuesta, true);
      echo "<div class='divfoto' <img class='fotoguay' src='".$assocArray['datos']."'></div>";
    }
    function sacar_texto_bien($urltextomalo) {
      $textomalo = file_get_contents($urltextomalo);
       return mb_convert_encoding($textomalo, 'UTF-8',
           mb_detect_encoding($textomalo, 'UTF-8, ISO-8859-1', true));
      }
    function extraerFenomenoPrediccion($textoprediccion) {
      $FenomenoPosicion = strpos($textoprediccion, "A.- FENÓMENOS SIGNIFICATIVOS") + strlen("A.- FENÓMENOS SIGNIFICATIVOS"); // Coge la posición de Fenomenos y de Prediccion
      $PrediccionPosicion = strpos($textoprediccion, "B.- PREDICCIÓN") + strlen("B.- PREDICCIÓN");                           // Le añadimos la longitud del titulo de tal por que cuando agarras un substring
      $FenomenoLongitud = $PrediccionPosicion - $FenomenoPosicion - strlen("B.- PREDICCIÓN");                                // te coge la posicion de donde empieza el string y no queremos el titulo en el resultado
                                                                                                                             // luego para calcular como de largo es el string de fenomeno hay que volver a sacar la posicion
      $TextoFenomeno = substr($textoprediccion, $FenomenoPosicion, $FenomenoLongitud);                                       // del comienzo del substring de prediccion por que si no nos pone "B.- PREDDICIÓN" al final
      $TextoPrediccion = substr($textoprediccion, $PrediccionPosicion);
      
      return [
        'textoFenomeno' => $TextoFenomeno,
        'textoPrediccion' => $TextoPrediccion,
      ];
    };