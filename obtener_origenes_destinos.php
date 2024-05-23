<?php
require_once 'conexion.php';

$origenes_sql = "SELECT DISTINCT Origen FROM Vuelo";
$destinos_sql = "SELECT DISTINCT Destino FROM Vuelo";

$origenes_result = $conexion->query($origenes_sql);
$destinos_result = $conexion->query($destinos_sql);

$origenes = [];
$destinos = [];

if ($origenes_result->num_rows > 0) {
    while ($row = $origenes_result->fetch_assoc()) {
        $origenes[] = $row["Origen"];
    }
}

if ($destinos_result->num_rows > 0) {
    while ($row = $destinos_result->fetch_assoc()) {
        $destinos[] = $row["Destino"];
    }
}

$response = ["origenes" => $origenes, "destinos" => $destinos];

echo json_encode($response);

$conexion->close();