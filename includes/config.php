<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $nameDB = "gestion_comedor";

    $conexion = mysqli_connect($host, $user, $pass, $nameDB);

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    };

    $conexion->set_charset("utf8");

?>

