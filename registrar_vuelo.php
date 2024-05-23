<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $avion_id = $data["avion_id"];
    $fecha = $data["fecha"];
    $origen = $data["origen"];
    $destino = $data["destino"];
    $precio = $data["precio"];
    $hora = $data["hora"];

    $sql = "INSERT INTO Vuelo (Avion_ID, Fecha, Origen, Destino, Precio, Hora) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isssds", $avion_id, $fecha, $origen, $destino, $precio, $hora);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Vuelo registrado exitosamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
}