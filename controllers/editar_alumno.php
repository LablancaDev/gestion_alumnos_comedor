<?php

    include "AlumnoController.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST["id_alumno"]) && isset($_POST["nombre"]) && isset($_POST["dni"]) && isset($_POST["curso"]) && isset($_POST["cuenta_bancaria"]) && isset($_POST["posicion_comedor"])){
            $id_alumno = $_POST["id_alumno"];
            $nombre = $_POST["nombre"];
            $dni = $_POST["dni"];
            $curso = $_POST["curso"];
            $cuenta_bancaria = $_POST["cuenta_bancaria"];
            $posicion_comedor = $_POST["posicion_comedor"];
            
        }
    }
    $alumnoController = new AlumnoController();
    $alumnoController->editar_alumno($id_alumno, $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor);

?>
