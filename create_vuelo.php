<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'create_vuelo') {
    // Obtener el cuerpo de la solicitud y decodificarlo
    $data = json_decode(file_get_contents('php://input'), true);

    $avion_id = $data['avion_id'];
    $fecha = $data['fecha'];
    $origen = $data['origen'];
    $destino = $data['destino'];
    $precio = $data['precio'];
    $hora = $data['hora'];

    $sql = "INSERT INTO Vuelo (Avion_ID, Fecha, Origen, Destino, Precio, Hora) VALUES ('$avion_id', '$fecha', '$origen', '$destino', '$precio', '$hora')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Nuevo vuelo creado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}