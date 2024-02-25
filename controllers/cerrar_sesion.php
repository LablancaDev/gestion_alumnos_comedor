<?php
    session_start();

    include 'AuthController.php';

    $authcontroller = new AuthController();
    $authcontroller->cerrarSesion();
    
    

?>