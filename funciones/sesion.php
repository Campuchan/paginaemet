<?php 
    require'basededatos.php';
    session_start();

    if(isset($_SESSION["id_usuario"])){
        $id_usuario = $_SESSION["id_usuario"];
        $getusuarioquery = "SELECT nombre from usuarios where id_usuario = '$id_usuario'";
        $getusuario = $mysqli->query($getusuarioquery);
        $getusuarioassoc = $getusuario->fetch_assoc();
        $nombreusuario = $getusuarioassoc['nombre'];
    } else {
        $id_usuario = "nosesion";
    }
    


?>