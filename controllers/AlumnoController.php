
<?php
    
    include "../models/AlumnoModel.php"; 
    class AlumnoController {
     
        public function obtenerListaAlumnos() {
            $alumnoModel = new AlumnoModel();

            return $alumnoModel->obtenerListaAlumnos();
           
        }

        public function crearNuevoAlumno($nombre, $dni , $curso, $cuenta_bancaria, $posicion_comedor){
            $alumnoModel = new AlumnoModel();

            if($alumnoModel->crearNuevoAlumno($nombre, $dni , $curso, $cuenta_bancaria, $posicion_comedor)){
                header("Location: ../views/dashboard.php");
            }else{
                echo 'Error al crear el nuevo alumno';
            }
        }
        

        public function editar_alumno($id_alumno, $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor) {
            $alumnoModel = new AlumnoModel();

            if ($alumnoModel->editar_alumno($id_alumno, $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor)) {
                header("Location: ../views/dashboard.php");
            } else {
                echo "Error al actualizar el alumno.";
            }
        }

        public function eliminar_alumno($id_alumno){
            $alumnoModel = new AlumnoModel();
            $alumnoModel->eliminar_alumno($id_alumno);
        }
        
        public function mostrarAlumnos($id_alumno){
            $alumnoModel = new AlumnoModel();
            return $alumnoModel->mostrarAlumnos($id_alumno);      
        }

    }


?>
