<?php 
    require'sesion.php';
    unset($_SESSION);
    unset($id_usuario);
    session_destroy();

    echo "exito";
?>