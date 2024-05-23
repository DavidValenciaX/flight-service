<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $vuelo_id = $data["vuelo_id"];
    $asiento = $data["asiento"];
    $nombre = $data["nombre"];
    $apellidos = $data["apellidos"];
    $fecha_nac = $data["fecha_nac"];
    $sexo = $data["sexo"];

    $sql = "INSERT INTO Pasajero (Nombre, Apellidos, Fecha_Nac, Sexo) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellidos, $fecha_nac, $sexo);

    if ($stmt->execute()) {
        $pasajero_id = $stmt->insert_id;

        $iniciales = strtoupper(substr($nombre, 0, 1) . substr($apellidos, 0, 1));
        $timestamp = time();
        $billete = $vuelo_id . '-' . $pasajero_id . '-' . $iniciales . '-' . $asiento . '-' . $timestamp;

        $sql = "INSERT INTO PasajeroEnVuelo (Vuelo_ID, Pasajero_ID, Billete, Asiento) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iiss", $vuelo_id, $pasajero_id, $billete, $asiento);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "billete" => $billete]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
    $conexion->close();
}