<?php
session_start();
?>
<?php
if(isset($_GET['id_alumno'])) {
    $id_alumno = $_GET['id_alumno'];
} else {
    echo "Error: No se proporcionó el ID del alumno.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos Alumno</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/mostrar_datos_alumnos.css">
</head>
<body class="fondo d-flex flex-column">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid p-2">
            <div class="d-flex align-items-center ms-2 me-4">
                <img src="../assets/imgs/logo.png" class="img-fluid me-2" style="max-width:50px" alt="logo">
                <a class="navbar-brand" href="dashboard.php">GestDiningRoom</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Gestión de Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="pasar_lista.php">Pasar Lista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro_comedor.php">Registro Comedor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="dashboard.php">volver</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menú
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="menu_escolar.php">Menú escolar</a></li>
                            <li><a class="dropdown-item" href="#">Sobre Nosotros</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php if(isset($_SESSION['usuario'])) { ?>
                <div class="nav-item">
                    <div class="nav-item d-flex align-items-center me-3">
                        <a class="nav-link text-danger me-3" href="../controllers/cerrar_sesion.php">Cerra Sesión</a>
                        <span class="navbar-text bg-primary text-light rounded">
                            <?php echo $_SESSION['usuario']?>
                        </span>
                    </div>
                </div>
            <?php }else{ ?>  
                <div class="nav-item">
                    <a class="nav-link" href="/gestion_alumnos_comedor/views/login.php">Iniciar Sesión</a>
                </div>
            <?php } ?> 
        </div>
    </nav>
    <div class="container mt-5 content">
        <h2 class="text-center mb-4 text-light">Datos del Alumno</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <table class="table table-bordered table-dark table-striped-columns border-light mb-5 mt-4" style="min-height:350px">
                        <?php 
                            $id_alumno = $_GET['id_alumno'];
                            include "../controllers//AlumnoController.php";
                            $alumnoController = new AlumnoController();
                            $datosAlumno = $alumnoController->mostrarAlumnos($id_alumno);                  
                        ?>
                    <tbody>
                        <?php foreach ($datosAlumno as $alumno): ?>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Id Alumno: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['id_alumno'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Nombre: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['nombre'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Dni: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['dni'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Curso: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['curso'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Cuenta Bancaria: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['cuenta_bancaria'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-start font-weight-bold" style="font-size: 20px;" scope="row">Posición Comedor: </th>
                                <td class="fw-bold text-success" style="font-size: 20px;"><?php echo $alumno['posicion_comedor'] ?></td>
                            </tr>
                    <tbody>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-2 text-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="../assets/imgs/Logo_Comedor.png" class="img-fluid me-2" style="max-width:150px" alt="logo">
            <span class="text-muted">© 2024 GestDiningRoom. Todos los derechos reservados.</span>
        </div>
    </footer>
 
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>