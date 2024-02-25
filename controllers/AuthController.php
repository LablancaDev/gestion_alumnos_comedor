<?php

    include '../includes/config.php';

    class AuthController{

        public function mostrarFormularioLogin(){
           
            header("Location: ../views/login.php");
            exit();
        }

        /* public function verificaUsuario($usuario, $contrasena){

            La función para verificar el usuario en el login está incluida en el modelo ya que incluye consulta a la BD

        }*/

        public function cerrarSesion(){
            session_start();
            session_destroy();
           
            header('location: ../views/login.php');
        }
    }
?>