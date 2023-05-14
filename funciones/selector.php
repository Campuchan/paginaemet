<?php
require 'basededatos.php';

    if(isset($_POST["ccaa"])){
        $ccaa = $_POST["ccaa"];

        $provincias = $mysqli->query("SELECT * FROM nombreprovincias WHERE CODAUTO = ". $ccaa);
        echo '<div class="col-sm-3 mb-3 mx-1" id="selectorprovincia">
            <label for="provincia">Provincia</label>
            <select class="form-select" name="provincia" id="provincia">
            <option disabled selected value></option>';
                while($provinassoc = $provincias->fetch_assoc()){
                  echo '<option value="'.$provinassoc["CODPRO"].'">'.$provinassoc["NOMBRE"].'</option>';
        }
        echo "</select>";
    } elseif (isset($_POST["provincia"])) {
        $provincia = $_POST["provincia"];
        $municipios = $mysqli->query("SELECT * FROM municipios WHERE CPRO = ". $provincia);
        echo '<div class="col-sm-3 mb-3 mx-1" id="selectormunicipio">
        <label for="municipio">Municipio</label>
            <select class="form-select" name="municipio" id="municipio">
        <option disabled selected value></option>';
                while($municipioassoc = $municipios->fetch_assoc()){
                  echo '<option value="'.$municipioassoc["CMUN"].'">'.$municipioassoc["NOMBRE"].'</option>';
        }
    } elseif (isset($_POST["municipio"])) {
        echo '<input type="submit" class="form-control mb-3 mx-1 mt-4"" id="preddiccionTiempo" value="Ver Tiempo">';
    }




?>