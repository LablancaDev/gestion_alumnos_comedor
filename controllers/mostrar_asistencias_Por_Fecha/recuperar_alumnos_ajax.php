<?php
include_once "../../models/functions.php";

$curso = isset($_GET['curso']) ? $_GET['curso'] : null;
$alumnos = recuperarAlumnosPorCurso($curso);
echo json_encode($alumnos);
?>
