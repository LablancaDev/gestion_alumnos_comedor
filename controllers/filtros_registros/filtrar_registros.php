<?php
try {

    include_once("../../models/functions.php");

    $inicio = $_POST["inicio"];
    $fin = $_POST["fin"];
    $curso = isset($_POST["curso"]) ? $_POST["curso"] : null;
    $posicion_comedor = isset($_POST["posicion_comedor"]) ? $_POST["posicion_comedor"] : null;
    $mes = isset($_POST["mes"]) ? $_POST["mes"] : null;


    $resultados = filtrosAlumnos($inicio, $fin, $curso, $posicion_comedor,$mes);

    header("Content-Type: application/json");
    echo json_encode($resultados);
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(["error" => $e->getMessage()]);
}