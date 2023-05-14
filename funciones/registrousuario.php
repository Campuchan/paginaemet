<?php 
require "basededatos.php";


    $email = $_POST["email"];
    $usuario = htmlentities($_POST["usuario"]);
    $contrasena = $_POST["contrasena"];
    
    //check registro

    $checkemailquery = "SELECT * FROM usuarios WHERE email = '$email'";
    $checkemail = $mysqli->query($checkemailquery);
    if($checkemail->num_rows > 0) {
        echo "correoenuso";
    }   else{
        $checkusuarioquery = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
        $checkusuario = $mysqli->query($checkusuarioquery);
        if($checkusuario->num_rows > 0) {
            echo "usuarioenuso";
        } else{

            $registro = "INSERT INTO usuarios(email, nombre, contrasena) VALUES ('$email', '$usuario', '$contrasena')";
            $resultado = $mysqli->query($registro);
            $id_usuario = $mysqli->insert_id;
            if(mysqli_affected_rows($mysqli) > 0) {//si ha funcionado
                $foto_perfil = file_get_contents("https://cataas.com/cat?type=sq");
                $ruta_foto_perfil = "../fotoperfil/".$id_usuario.".jpeg";
                file_put_contents($ruta_foto_perfil,$foto_perfil);
        
                echo "exito";
        
            } else {
                echo "error";
            }
        }
    }


    


    

?>