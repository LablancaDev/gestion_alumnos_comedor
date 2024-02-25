<?php
include '../includes/config.php';

class AuthModel{
    public function verificaUsuario($usuario, $contrasena){
            
        global $conexion;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $consulta = "SELECT * FROM alumnos WHERE nombre = ? AND dni = ?";
        $stmt = mysqli_prepare($conexion, $consulta);
        mysqli_stmt_bind_param($stmt, "ss", $usuario, $contrasena);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        if ($resultado) {
        
            if (mysqli_num_rows($resultado) == 1) {
                
                $_SESSION['usuario'] = $usuario;
    
                header("Location: ../views/dashboard.php");
                exit();
            } else {
        
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
                header("Location: ../views/login.php");
              
            }
    
            mysqli_free_result($resultado);
        } else {

            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    
        mysqli_close($conexion);

    }
}


?>