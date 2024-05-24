<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'create_avion') {
    // Obtener el cuerpo de la solicitud y decodificarlo
    $data = json_decode(file_get_contents('php://input'), true);

    $modelo = $data['modelo'];
    $capacidad = $data['capacidad'];
    $filas = $data['filas'];
    $columnas = $data['columnas'];

    $sql = "INSERT INTO Avion (Modelo, Capacidad, Filas, Columnas) VALUES ('$modelo', '$capacidad', '$filas', '$columnas')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Nuevo avión creado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}