<?php
if (!isset($_GET["date"])) {
    exit("[]");
}
include_once "../../models/functions.php";
$date = $_GET["date"];
$data = recuperarDatosAsistenciaPorFecha($date);
echo json_encode($data);
?>
