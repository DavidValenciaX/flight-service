<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $modelo = $data["modelo"];
    $capacidad = $data["capacidad"];
    $filas = $data["filas"];
    $columnas = $data["columnas"];

    $sql = "INSERT INTO Avion (Modelo, Capacidad, Filas, Columnas) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("siii", $modelo, $capacidad, $filas, $columnas);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Avión agregado exitosamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
}