<?php
    include "../includes/config.php";

    class AlumnoModel {
   
        public function crearNuevoAlumno($nombre, $dni , $curso, $cuenta_bancaria, $posicion_comedor){
            global $conexion;

            $consulta = "INSERT INTO alumnos (nombre, dni, curso, cuenta_bancaria, posicion_comedor) VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conexion, $consulta);

            if ($stmt) {
     
                mysqli_stmt_bind_param($stmt, "sssss", $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor);

                $resultado = mysqli_stmt_execute($stmt);

                if ($resultado) {
                    header("Location: ../views/dashboard.php");
                } else {
                    echo "Error al crear el nuevo alumno: " . mysqli_error($conexion);
                }

                mysqli_stmt_close($stmt);
            } else {
         
                echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
            }
        }



        public function editar_alumno($id_alumno, $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor) {
            global $conexion;
            
    
            $consulta = "UPDATE alumnos SET nombre=?, dni=?, curso=?, cuenta_bancaria=?, posicion_comedor=? WHERE id_alumno=?";
        
            $stmt = mysqli_prepare($conexion, $consulta);
        
       
            if ($stmt) {
     
                mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $dni, $curso, $cuenta_bancaria, $posicion_comedor, $id_alumno);
        
    
                $resultado = mysqli_stmt_execute($stmt);
        
                if ($resultado) {
                    header("Location: ../views/dashboard.php");
                } else {
             
                    echo "Error al actualizar el alumno: " . mysqli_error($conexion);
                }
        
                mysqli_stmt_close($stmt);
            } else {

                echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
            }
        }

        public function obtenerListaAlumnos() {
            global $conexion;

            $listaAlumnos = []; 
   
            $consulta = "SELECT id_alumno, nombre FROM alumnos";
            $stmt = mysqli_prepare($conexion, $consulta);

            if ($stmt) {
                mysqli_stmt_execute($stmt);

                $resultado = mysqli_stmt_get_result($stmt);

                if ($resultado) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      
                        $listaAlumnos[] = $fila;
                   
                    }
                }

                mysqli_stmt_close($stmt);
            }
            return $listaAlumnos; 
        }

        public function eliminar_alumno($id_alumno){
            global $conexion;

            $consulta = "DELETE FROM alumnos WHERE id_alumno = ?";
        
            $stmt = mysqli_prepare($conexion, $consulta);
    
            if ($stmt) {
             
                mysqli_stmt_bind_param($stmt, "i", $id_alumno);
    
                $resultado = mysqli_stmt_execute($stmt);
    
                if (!$resultado) {
                 
                    echo "Error al eliminar el alumno: " . mysqli_error($conexion);
                }
                header("Location: ../views/dashboard.php");
    
                mysqli_stmt_close($stmt);
            } else {
               
                echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
            }
        }

        public function mostrarAlumnos($id_alumno) {
            global $conexion;

            $listaAlumno = [];

            $consulta = "SELECT * FROM alumnos WHERE id_alumno = ?";

            $stmt = mysqli_prepare($conexion, $consulta);

            mysqli_stmt_bind_param($stmt, "i", $id_alumno);

            if ($stmt) {
                
                mysqli_stmt_execute($stmt);

                $resultado = mysqli_stmt_get_result($stmt);

                if ($resultado) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      
                        $listaAlumnos[] = $fila;
                    
                    }
                }

                mysqli_stmt_close($stmt);
            }
            return $listaAlumnos;
        }
        
    }



?>