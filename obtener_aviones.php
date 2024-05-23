<?php
require_once 'conexion.php';

$sql = "SELECT ID, Modelo FROM Avion";
$result = $conexion->query($sql);

$aviones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $aviones[] = $row;
    }
}

echo json_encode($aviones);

$conexion->close();