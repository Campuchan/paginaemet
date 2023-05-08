<?php
require 'basededatos.php';



    $comunidades = $mysqli->query("SELECT * FROM nombrecomunidades");
    while($comunassoc = $comunidades->fetch_assoc()){
        echo '<option value="'.$comunassoc["CODAUTO"].'">'.$comunassoc["NOMBRE"].'</option>';
    }

    if(isset($_POST["ccaa"])){
        $ccaa = $_POST["ccaa"];

        $provincias = $mysqli->query("SELECT * FROM nombreprovincias WHERE CODAUTO = ". $ccaa);
        echo '<div id="selectorprovincia">
            <label for="provincia">Provincia</label>
            <select class="form-select" name="provincia" id="provincia">
        <option disabled selected value>Provincia</option>';
                while($provinassoc = $provincias->fetch_assoc()){
                  echo '<option value="'.$provinassoc["CODPRO"].'">'.$provinassoc["NOMBRE"].'</option>';
        }
        echo "</select>";
    } elseif (isset($_POST["provincia"])) {
        $provincia = $_POST["provincia"];
        $municipios = $mysqli->query("SELECT * FROM municipios WHERE CPRO = ". $provincia);
        echo '<div id="selectormunicipio">
        <label for="provincias">Municipio</label>
            <select class="form-select" name="ccaa" id="ccaa">
        <option disabled selected value>Municipio</option>';
                while($municipioassoc = $municipios->fetch_assoc()){
                  echo '<option value="'.$municipioassoc["CODAUTO"].'">'.$municipioassoc["NOMBRE"].'</option>';
        }
    }




?>