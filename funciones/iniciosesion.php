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
            $getidusuarioquery = "SELECT id_usuario FROM usuarios WHERE nombre = '$usuario'";
            $getidusuario = $mysqli->query($getidusuarioquery);
            $getidusuarioassoc = $getidusuario->fetch_assoc();
            session_start();

            $_SESSION['id_usuario'] = $getidusuarioassoc["id_usuario"];

            echo "exito";

        } else{
            
            echo "contraerror";
        }
    }   else{
        echo "usernoexiste";
    }


    


    

?>