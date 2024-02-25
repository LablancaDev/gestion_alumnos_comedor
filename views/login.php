<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-sm-6 d-flex align-items-center mt-1">
            <h3 class="text-white mx-auto mx-sm-0">GestDiningRoom</h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end mt-1 d-none d-sm-flex">
            <img src="../assets/imgs/Logo_Comedor.png" style="max-width: 200px" alt="logoComedor">
        </div>
        <hr class="w-100 mx-auto mt-2 border border-white">
    </div>
    <div class="row justify-content-center ps-5 pe-5 align-items-center min-vh-100">
        <div class="col-12 col-md-8 col-lg-5 p-3 mb-5 login">
                <h2 class="text-center text-white mb-4">Iniciar Sesión</h2>
                    <div class="text-center mb-5">
                        <img src="../assets/imgs/user.png" class="img-fluid" style="max-width:100px" alt="img-login">
                    </div>
        
                <form action="/gestion_alumnos_comedor/controllers/procesar_login.php" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label text-white">Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label text-white">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <a href="#" class="text-white">¿Olvidaste tu contraseña?</a>
                    </div>

                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php } ?>

                    <button type="submit" class="btn btn-primary w-100 mt-4">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>