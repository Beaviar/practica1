<?php

$server = "localhost";
$user = "root";
$pass = "";
$db = "inaem_practica1";

$conn = mysqli_connect($server, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Error en la conexión: " . mysqli_connect_error());
}

?>