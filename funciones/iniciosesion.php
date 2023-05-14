<?php 
require "basededatos.php";

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
    //check registro

    $checkuserexistequery = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
    $checkuserexiste = $mysqli->query($checkuserexistequery);


    if($checkuserexiste->num_rows > 0) {
        
        $checkusuarioquery = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
        $checkusuario = $mysqli->query($checkusuarioquery);

        $checkusuarioassoc = $checkusuario->fetch_assoc();

        $contrasenabd = $checkusuarioassoc['contrasena'];

        if($contrasena == $contrasenabd) {

            echo "exito";

        } else{
            
            echo "contraerror";
        }
    }   else{
        echo "usernoexiste";
    }


    


    

?>