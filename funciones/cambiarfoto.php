<?php 
    $foto = $_FILES["foto"];

    if ($foto['error'] !== UPLOAD_ERR_OK) {
        echo 'errorgeneral';
    }
    
    $tipoimagen = $foto['type'];
    $tipoaceptado = ['image/jpeg', 'image/png'];

    if (in_array($fileType, $allowedTypes)) {

        if($foto['size'] < 8000000){ //max 8mb
            $localtemp = $file['tmp_name'];
            $ruta_foto_perfil = '../fotoperfil/'.$id_usuario.'.jpeg';
            move_uploaded_file($localtemp, $ruta_foto_perfil);
            echo "exito";
        } else{
            echo 'errortamaño';
        }
    } else {
        echo 'novalido';
    }

?>