<?php

    include "AlumnoController.php";
   
    if(isset($_GET['id_alumno'])){
        $id_alumno = $_GET['id_alumno'];

        $alumnoController = new AlumnoController();
        $alumnoController->eliminar_alumno($id_alumno);
    }else{
        echo "Error: No se proporcionó el ID del alumno.";
    }



?>