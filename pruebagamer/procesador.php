<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
// process the form data and generate a response
$response = "Hola, $nombre! Tu email es $email.";
echo $response;
?>