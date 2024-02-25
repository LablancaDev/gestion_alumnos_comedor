<?php

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];
        
        
         include '../models/AuthModel.php';
        $authModel = new AuthModel();
        $authModel->verificaUsuario($usuario, $contrasena);
    }

?>
