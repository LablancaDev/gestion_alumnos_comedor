<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Lista</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/pasar_lista.css">
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
    <div class="container mt-3 content">
        <div class="row">
            <h2 class="text-light">Pasar Lista asistencia Comedor</h2>
            <div class="col-12">
           
                <form id="cursoForm" method="get" class="row align-items-end"> 
                    <div class="col-md-2 mb-2">  
                       
                        <input type="hidden" name="curso" id="cursoHidden" value="<?php echo isset($_GET['curso']) ? $_GET['curso'] : ''; ?>">
                        <label for="curso" class="form-label">Seleccionar el curso:</label> 
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="curso" id="curso" class="form-control">
                            
                            <option value="Todos los cursos">Todos los cursos</option>
                            <option value="3inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '3inf') echo 'selected'; ?>>3INF</option>
                            <option value="4inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '4inf') echo 'selected'; ?>>4INF</option>
                            <option value="5inf" <?php if(isset($_GET['curso']) && $_GET['curso'] === '5inf') echo 'selected'; ?>>5INF</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input class="btn btn-warning mt-2" type="submit" name="submitCurso" value="Enviar">
                    </div>
                </form>
            </div> 
        </div>    
        <div class="row mt-3 mb-3">
            <div class="col-md-2 d-flex align-items-center">
                <label for="date" style="min-width: 150px" class="form-label">Seleccionar la Fecha: &nbsp;</label>
            </div>       
            <div class="col-md-2 d-flex align-items-center">   
               
                <input onchange="actualizarListaAlumnos()" id="date" name="date" type="date" style="min-width: 150px" class="form-control " value="<?php echo date('Y-m-d'); ?>"><!--mostrar fecha actual-->
            </div>   
            <div class="col-md-2 d-flex align-items-center">      
                <button onclick="save()" class="btn btn-success mt-2 font-weight-bold">Guardar</button>
                <div id="mensajeGuardado" class="mensaje-guardado">Guardado con éxito</div> 
            </div>                
        </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAlumnos">
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>  
    <footer class="footer mt-auto py-2 text-center">
        <div class="d-flex justify-content-center align-items-center">
            <img src="../assets/imgs/Logo_Comedor.png" class="img-fluid me-2" style="max-width:150px" alt="logo">
            <span class="text-muted">© 2024 GestDiningRoom. Todos los derechos reservados.</span>
        </div>
    </footer>  
        <script>
           
            const UNSET_STATUS = "unset";
           
            let alumnos = [];

            async function save() {
                const dateElement = document.getElementById("date");
                const selectedDate = dateElement.value;
                if (!selectedDate) {
                    alert("Selecciona una fecha válida");
                    return;
                }

                let mapeoUsuarios = alumnos.map(alumno => {
                    return {
                        id_alumno: alumno.id,
                        estado: alumno.status,
                    }
                });
     
                mapeoUsuarios = mapeoUsuarios.filter(alumno => alumno.estado !== UNSET_STATUS);

                const payload = {
                    date: selectedDate,
                    alumnos: mapeoUsuarios,
                };
      
                const response = await fetch("../controllers/mostrar_asistencias_Por_Fecha/guardar_datos_asistencias.php", {
                    method: "POST",
                    body: JSON.stringify(payload),
                });

                mostrarMensajeGuardado();
            }

            function mostrarMensajeGuardado() {
                const mensajeGuardado = document.getElementById('mensajeGuardado');

                mensajeGuardado.classList.add('mostrar');

                setTimeout(() => {
                    mensajeGuardado.classList.remove('mostrar');
                }, 2000); 
            }

            async function actualizarListaAlumnos() {
                
                const curso = document.getElementById("cursoHidden").value;

                const response = await fetch(`../controllers/mostrar_asistencias_Por_Fecha/recuperar_alumnos_ajax.php?curso=${curso}`);
            
                alumnos = await response.json();
              
                let diccionarioAlumnos = {};
              
                alumnos = alumnos.map((alumno, index) => {
                    diccionarioAlumnos[alumno.id_alumno] = index;
                    return {
                        id: alumno.id_alumno,
                        name: alumno.nombre,
                        status: UNSET_STATUS,
                    }
                });
            
                const date = document.getElementById("date").value;
      
                const respuestaDatosAsistencia = await fetch(`../controllers/mostrar_asistencias_Por_Fecha/recuperar_datos_asistencias_ajax.php?date=${date}`);
  
                const datosAsistencia = await respuestaDatosAsistencia.json();

                datosAsistencia.forEach(detalleAsistencia => {
                    const alumnoId = detalleAsistencia.id_alumno;
                    if (alumnoId in diccionarioAlumnos) {
                        const index = diccionarioAlumnos[alumnoId];
                        alumnos[index].status = detalleAsistencia.estado;
                    }
                });
           
                mostrarDatosAlumnos(alumnos);
            }


        function mostrarDatosAlumnos(alumnos) {
           
            const tableBody = document.getElementById("tablaAlumnos");
       
            tableBody.innerHTML = "";

            if (!alumnos) {
                console.error("Error: Datos de alumnos no disponibles.");
                return;
            }
            
            if (Array.isArray(alumnos) && alumnos.length > 0) {
           
                alumnos.forEach(function (alumno) { 
                    const row = document.createElement("tr");
               
                    const celdaNombreUsuario = document.createElement("td");
                    celdaNombreUsuario.textContent = alumno.name;
             
                    const celdaEstado = document.createElement("td");
                    const selectEstado = document.createElement("select");
                    selectEstado.classList.add("form-control");
          
                    const options = ["--Select--", "Presente", "Ausente"];
     
                    options.forEach(function (option) {
                        const optionElement = document.createElement("option");
                        optionElement.value = option.toLowerCase();
                        optionElement.textContent = option;
                        selectEstado.appendChild(optionElement);
                    });
                
                    selectEstado.value = alumno.status ? alumno.status.toLowerCase() : "";
                 
                    selectEstado.addEventListener("change", function () {
                        alumno.status = selectEstado.value;
                    });
                
                    celdaEstado.appendChild(selectEstado);
                    row.appendChild(celdaNombreUsuario);
                    row.appendChild(celdaEstado);
                    tableBody.appendChild(row);
                });
            } else {
                console.error("Error: La variable alumnos no es un arreglo válido.");
            }
        }

            document.addEventListener("DOMContentLoaded", function () {
                actualizarListaAlumnos();
            });
        </script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
