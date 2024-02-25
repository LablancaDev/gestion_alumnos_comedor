<?php

function filtrosAlumnos($inicio, $fin, $curso = null, $posicion_comedor = null, $mes = null) {

    $query = "SELECT alumnos.nombre, 
                     SUM(CASE WHEN asistencias.estado = 'presente' THEN 1 ELSE 0 END) AS presence_count,
                     SUM(CASE WHEN asistencias.estado = 'ausente' THEN 1 ELSE 0 END) AS absence_count 
              FROM asistencias
              INNER JOIN alumnos ON alumnos.id_alumno = asistencias.id_alumno
              WHERE asistencias.fecha >= ? AND asistencias.fecha <= ?" . 
              ($curso ? " AND alumnos.curso = ?" : "") . 
              ($posicion_comedor ? " AND alumnos.posicion_comedor = ?" : "") .
              ($mes ? " AND MONTH(asistencias.fecha) = ?" : "") . "
              GROUP BY alumnos.id_alumno, alumnos.nombre;";

    $db = getDatabase();
    $params = [$inicio, $fin];
    if ($curso) {
        $params[] = $curso;
    }
    if ($posicion_comedor) {
        $params[] = $posicion_comedor;
    }
    if ($mes) {
        $params[] = $mes;
    }

    $statement = $db->prepare($query);
    $statement->execute($params);
    return $statement->fetchAll();
}


function guardarDatosAsistencias($date, $alumnos)
{
    $db = getDatabase();
    $db->beginTransaction();
    $dateFormatted = date("Y-m-d", strtotime($date));

    $statement = $db->prepare("INSERT INTO asistencias (id_alumno, fecha, estado) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE estado = VALUES(estado)");
    foreach ($alumnos as $alumno) {
        $statement->execute([$alumno->id_alumno, $dateFormatted, $alumno->estado]);
    }

    $db->commit();
    return true;
}

function eliminarDatosAsistenciaPorFecha($date)
{
    $db = getDatabase();
    $dateFormatted = date("Y-m-d", strtotime($date));
    $statement = $db->prepare("DELETE FROM asistencias WHERE date = ?");
    return $statement->execute([$dateFormatted]);
}

function recuperarDatosAsistenciaPorFecha($date)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT id_alumno, estado FROM asistencias WHERE fecha = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}


function actualizarAlumnos($name, $id)
{
    $db = getDatabase();
    $statement = $db->prepare("UPDATE alumnos SET nombre = ? WHERE id_alumno = ?");
    return $statement->execute([$name, $id]);
}

function recuperarAlumnosPorId($id)
{
    $db = getDatabase();
    $statement = $db->prepare("SELECT id_alumno, nombre FROM alumnos WHERE id_alumno = ?");
    $statement->execute([$id]);
    return $statement->fetchObject();
}


function recuperarAlumnosPorCurso($curso)
{
    $db = getDatabase();
    $query = "SELECT id_alumno, nombre FROM alumnos";
    if ($curso && $curso !== 'Todos los cursos') {
        $query .= " WHERE curso = :curso";
    }
    $statement = $db->prepare($query);
    if ($curso && $curso !== 'Todos los cursos') {
        $statement->bindParam(':curso', $curso);
    }
    $statement->execute();
    return $statement->fetchAll();
}


function getDatabase(){

    $host = getenv("MYSQL_HOST") ?: "localhost";
    $dbName = getenv("MYSQL_DATABASE_NAME") ?: "gestion_comedor";
    $user = getenv("MYSQL_USER") ?: "root";
    $password = getenv("MYSQL_PASSWORD") ?: "";

    try {
        $database = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $database;
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}


