<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/menu_escolar.css">
</head>
<body class="fondo">
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
    <div class="container">
        <h2 class= "text-center mt-3 text-light">Menú Escolar</h2>
        <div class="row">
            <div class="col-lg-12">
                <div id="carouselExampleCaptions" class="carousel slide mt-3">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active position-relative">
                            <img src="../assets/imgs/carousel2.jpg" class="d-block w-100 img-fluid rounded-3" alt="niños" style="height: 300px;">
                            
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>
                            
                            <div class="carousel-caption d-none d-md-block position-absolute top-50 start-50 translate-middle">
                                <h2>Menús Personalizados</h2>
                                <p class="fs-5">Elaboramos menús equilibrados de acuerdo con las necesidades nutricionales de nuestros estudiantes</p>
                            </div>
                        </div>
                        <div class="carousel-item active position-relative">
                            <img src="../assets/imgs/carousel.jpg" class="d-block w-100 img-fluid rounded-3" alt="fruta" style="height: 300px;">

                             <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

                            <div class="carousel-caption d-none d-md-block  position-absolute top-50 start-50 translate-middle">
                                <h2>Disponemos de comedor propio</h2>
                                <p class="fs-5">Menús confeccionados íntegramente en nuestras propias cocinas</p>
                            </div>
                        </div>
                        <div class="carousel-item position-relative">
                            <img src="../assets/imgs/carousel3.jpg" class="d-block w-100 img-fluid rounded-3" alt="servir" style="height: 300px; width: 100%;">

                            <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>

                            <div class="carousel-caption d-none d-md-block position-absolute top-50 start-50 translate-middle">
                                <h2>Diesta equilibrada</h2>
                                <p class="fs-5">Aportamos los nutrientes básicos para una alimentación sana y equilibrada</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
            <div class="row">
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/primer_ciclo.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #FFD700;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top img-fluid" style="width: 50px;" alt="Imágen 1º menú ciclo">
                            <p class="card-text">Menú 1º Ciclo</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/segundo_ciclo.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #00FF00;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top img-fluid" style="width: 50px;" alt="Imágen 2º menú ciclo">
                            <p class="card-text">Menú 2º Ciclo</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/menu_diabetes.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #87CEEB;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top img-fluid" style="width: 50px;" alt="Imágen menú diabetes">
                            <p class="card-text">Menú diabetes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4 mb-3">
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/menu_sin_gluten.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #FFA07A;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top img-fluid" style="width: 50px;" alt="Imágen menú sin gluten">
                            <p class="card-text">Menú sin gluten</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/menu_sin_lactosa.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #FF6347;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top  img-fluid" style="width: 50px;" alt="Imágen menú sin lactosa">
                            <p class="card-text">Menú sin lactosa</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 p-1">
                <a href="../assets/pdf/menu_sin_marisco.pdf" download class="text-decoration-none">
                    <div class="card h-100" style="background-color: #D8BFD8;">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <img src="../assets/imgs/plato.png" class="card-img-top img-fluid" style="width: 50px;" alt="Imágen menú sin marisco ">
                            <p class="card-text">Menú sin marisco</p>
                        </div>
                    </div>
                </a>
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