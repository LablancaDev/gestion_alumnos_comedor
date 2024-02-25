<?php
include_once "../../models/functions.php";
$payload = json_decode(file_get_contents("php://input"));
if (!$payload) exit("No data present");
$respuesta = guardarDatosAsistencias($payload->date, $payload->alumnos);
echo json_encode($respuesta);
?>
