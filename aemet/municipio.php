<?php 
    include("../funciones/librerias.php");

    $CODPROV = $_POST["provincia"];
    $CODMUN = $_POST["municipio"];
    $CODPROVBIEN = str_pad($CODPROV, 2, '0', STR_PAD_LEFT);
    $CODMUNBIEN = str_pad($CODMUN, 3, '0', STR_PAD_LEFT); // siempre son 2 numeros de prov y 3 de municipio ej. prov 2, mun 3 -> 02003
    $CODIGO = $CODPROVBIEN . $CODMUNBIEN;

    $aemet = curl_aemet("/prediccion/especifica/municipio/horaria/". $CODIGO);
    $respuesta = json_decode($aemet);
    $jsondatos = file_get_contents($respuesta->datos);
    $jsondatosutf = sacar_texto_bien($jsondatos);
    $datos = json_decode($jsondatosutf, true);

    $localidad = $datos[0]['provincia']. ", ". $datos[0]['nombre'];

    $elaboradotexto = $datos[0]['elaborado'];
    $elaborado = new DateTime($elaboradotexto);

    $horaactual = date('H');
    $minutoactual = date('i');
    $primerahora = $datos[0]['prediccion']['dia'][0]['temperatura'][0]['periodo'];
    $horaactualrelativa = $horaactual - $primerahora + 1;


    echo '<div>Elaborado en: '. $elaborado->format('H:i:s d/m/Y').'</div>
          <div>Localidad: ' . $localidad.
         '<h3>Tiempo actual '.$horaactualrelativa. '</h3>
          <h4>'.$horaactual.':'.$minutoactual.'</h4>
          <div>Temperatura: '.$datos[0]['prediccion']['dia'][0]['temperatura'][$horaactualrelativa]['value'].' Cº </div>
          <div>Estado del cielo: '.$datos[0]['prediccion']['dia'][0]['estadoCielo'][$horaactualrelativa]['descripcion'].'</div>
          <div>Prob. Precipitacion: '.$datos[0]['prediccion']['dia'][0]['precipitacion'][$horaactualrelativa]['value'].' %</div>';;
        
    

    $diaactual = 0;
    foreach ($datos[0]['prediccion']['dia'] as $predicciondia) {
      if($diaactual == 0){$nombredia = "Hoy";}elseif($diaactual == 1){$nombredia = "Mañana";}elseif($diaactual == 2){$nombredia = "Pasado mañana";}; // hay mejores formas de hacer esto
          echo '<h3> '. $nombredia .'</h3>';
          echo '<div class="dia">';
      if($diaactual == 0){
        echo '<div id="amanochecer">Amanecer: '.$predicciondia['orto'].' // Anochecer: '.$predicciondia["ocaso"].' <button type="button" id="escondernodisponible" class="btn btn-secondary ms-3">Esconder horas no disponibles</button>';
      } else {
        echo '<div id="amanochecer">Amanecer: '.$predicciondia['orto'].' // Anochecer: '.$predicciondia["ocaso"].'</div>';
      }

      echo '<h4> Temperatura </h4>
            <div class="table-responsive">
              <table class="table">
              <tr>
              <th scope="col">Hora</th>
              <th scope="col">Prediccion</th>
              <th scope="col">Estado nubes</th>
              </tr>';
              $primerahora = $predicciondia['temperatura'][0]['periodo'];
              for ($hora = 0; $hora < $primerahora; $hora++){
                    $horatabla = $hora ."h - ". $hora+1 . "h";
                echo '
                <tr class="noexiste">
                <td> '.$horatabla.'
                <td> N/E
                <td> N/E
                ';
              }
            /*  for ($hora = 0; $hora < $primerahora; $hora++){
                    $horatabla = $hora ." - ". $hora+1;
                echo '
                <td> '.$horatabla.'
                <td> N/E
                </tr>';
          }*/
              for($hora = 0; $hora < count($predicciondia['temperatura']); $hora++){
                if($diaactual == 0){
                  $horatabla = $hora+$primerahora ."h - ". $hora+1+$primerahora . "h";
                }else{
                  $horatabla = $hora ."h - ". $hora+1 . "h";
                }
                echo '
                <tr>  
                <td> '.$horatabla.'
                <td> '.$predicciondia['temperatura'][$hora]['value'].' Cº
                <td> '.$predicciondia['estadoCielo'][$hora]['descripcion'].' 
                </tr>';
              }

              /*foreach($preddicciondia['temperatura'] as $temperatura){
                    $hora = $temperatura['periodo'];
                    $horatabla = $hora ." - ". $hora+1;
                    $temperaturavalor = $temperatura['value'];
                echo '
                <tr>  
                <td> '.$horatabla.'
                <td> '.$temperaturavalor.' Cº
                </tr>';
              }*/
              echo "</table>"; //table-responsive
              echo "</div>"; //table-responsive
            echo "</div>"; //dia
            echo '<button class="esconderdia btn btn-info">Mostrar/Esconder</button>';
      $diaactual++;
    }
    

?>