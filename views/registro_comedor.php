<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Comedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/registro_comedor.css">
</head>

<body class="d-flex flex-column fondo">
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
                    <a class="nav-link text-danger" href="/gestion_alumnos_comedor/views/login.php">Iniciar Sesión</a>
                </div>
            <?php } ?> 
        </div>
    </nav>
    <div class="container mt-3 content mb-3 text-light">
        <h2>Registro de Asistencias y Ausencias al Comedor</h2>
        <form action="#" id="filtroForm">
            <div class="row mt-5 p-2 align-items-end">
                <div class="col-md-2  p-2">
                    <label for="incio" class="form-label">Inicio</label>
                    <input type="date" name="inicio" id="inicio" class="form-control">
                </div>
                <div class="col-md-2  p-2">
                    <label for="fin" class="form-label">Fin</label>
                    <input type="date" name="fin" id="fin" class="form-control">
                </div>
                <div class="col-md-2  p-2">
                    <button type="button" class="btn btn-warning" onclick="filtrarRegistros()">Filtrar</button>
                </div>
            </div>
            <div class="row mt-3 p-2">
                <div class="col-md-3  p-2">
                    <label for="posicion_comedor" class="form-label">Filtrar por Mesa</label>
                    <select name="posicion_comedor" id="posicion_comedor" class="form-control">
                        <option value="" <?php if(empty($_GET['posicion_comedor'])) echo 'selected'; ?>>Todos</option>
                        <option value="mesa1" <?php if(isset($_GET['posicion_comedor']) && $_GET['posicion_comedor'] === 'mesa1') echo 'selected'; ?>>Mesa 1</option>
                        <option value="mesa2" <?php if(isset($_GET['posicion_comedor']) && $_GET['posicion_comedor'] === 'mesa2') echo 'selected'; ?>>Mesa 2</option>
                        <option value="mesa3" <?php if(isset($_GET['posicion_comedor']) && $_GET['posicion_comedor'] === 'mesa3') echo 'selected'; ?>>Mesa 3</option>
                        <option value="mesa4" <?php if(isset($_GET['posicion_comedor']) && $_GET['posicion_comedor'] === 'mesa4') echo 'selected'; ?>>Mesa 4</option>
                        <option value="mesa5" <?php if(isset($_GET['posicion_comedor']) && $_GET['posicion_comedor'] === 'mesa5') echo 'selected'; ?>>Mesa 5</option>
                    </select>
                </div>
                <div class="col-md-3  p-2">
                    <label for="curso" class="form-label">Filtrar por Curso</label>
                    <select name="curso" id="curso" class="form-control">
                        <option value="" <?php if(empty($_GET['curso'])) echo 'selected'; ?>>Todos</option>
                        <option value="3inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '3inf') echo 'selected'; ?>>3INF</option>
                        <option value="4inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '4inf') echo 'selected'; ?>>4INF</option>
                        <option value="5inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '5inf') echo 'selected'; ?>>5INF</option>
                    </select>
                </div>
                <div class="col-md-3  p-2">
                    <label for="mes" class="form-label">Filtrar por Mes</label>
                    <select name="mes" id="mes" class="form-control">
                        <option value="">Todos</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="mb-4">
            <table class="table table-striped table-hover" id="resultadosTabla">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Total de Asistencias</th>
                        <th scope="col">Total de Ausencias</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
        </div>
    </div>
    <script>
      async function filtrarRegistros() {
        const inicio = document.getElementById("inicio").value;
        const fin = document.getElementById("fin").value;
        const curso = document.getElementById("curso").value;
        const posicion_comedor = document.getElementById("posicion_comedor").value;
        const mes = document.getElementById("mes").value;

       
        try {
            const response = await fetch("../controllers/filtros_registros/filtrar_registros.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `inicio=${inicio}&fin=${fin}&curso=${curso}&posicion_comedor=${posicion_comedor}&mes=${mes}`
            });

            if (!response.ok) {
                throw new Error("Error en la solicitud AJAX: " + response.status);
            }

            const resultados = await response.json();
            console.log(resultados);
            actualizarTabla(resultados);
        } catch (error) {
            console.error(error);
        }
    }


       function actualizarTabla(resultados) {
    const tablaBody = document.getElementById("resultadosTabla").getElementsByTagName('tbody')[0];
   
    tablaBody.innerHTML = '';

   
    resultados.forEach(function (resultado, index) {
        const fila = tablaBody.insertRow(index);
        const numero = fila.insertCell(0);
        const nombre = fila.insertCell(1);
        const asistencias = fila.insertCell(2);
        const ausencias = fila.insertCell(3);

        numero.textContent = index + 1;
        nombre.textContent = resultado.nombre;
        asistencias.textContent = resultado.presence_count;
        ausencias.textContent = resultado.absence_count;

      
        console.log(resultado);
    });
}

    </script>
    <footer class="footer mt-auto py-2 text-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="../assets/imgs/Logo_Comedor.png" class="img-fluid me-2" style="max-width:150px" alt="logo">
            <span class="text-muted">© 2024 GestDiningRoom. Todos los derechos reservados.</span>
        </div>
    </footer>
   
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
