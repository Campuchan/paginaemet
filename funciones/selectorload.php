<?php 
    require 'basededatos.php';

    $comunidades = $mysqli->query("SELECT * FROM nombrecomunidades");
    echo '<div id="selectorcomunidad" class="col-sm-3 mb-3 my-1">
        <label for="ccaa"> Comunidad autonoma</label>
        <select class="form-select" data-live-search="true" name="ccaa" id="ccaa">
        <option disabled selected value></option>';
    while($comunassoc = $comunidades->fetch_assoc()){
        echo '<option value="'.$comunassoc["CODAUTO"].'">'.$comunassoc["NOMBRE"].'</option>';
    }
    echo '</select>
          </div>'


/*<div id="selectorcomunidad">
            <label for="ccaa"> Comunidad autonoma</label>
            <select class="form-select mb-3" data-live-search="true" name="ccaa" id="ccaa">
              <option disabled selected value></option>
                <?php
                  $comunidades = $mysqli->query("SELECT * FROM nombrecomunidades");
                  while($comunassoc = $comunidades->fetch_assoc()){
                    echo '<option value="'.$comunassoc["CODAUTO"].'">'.$comunassoc["NOMBRE"].'</option>';
                  }
                ?>
            </select>
          </div>*/
?>

