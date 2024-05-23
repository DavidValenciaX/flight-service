<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['billete'])) {
    $billete = $_GET['billete'];

    $sql = "SELECT p.Nombre, p.Apellidos, v.Fecha, v.Hora, v.Origen, v.Destino, a.Modelo, pe.Asiento, pe.Billete 
            FROM PasajeroEnVuelo pe
            INNER JOIN Pasajero p ON pe.Pasajero_ID = p.ID
            INNER JOIN Vuelo v ON pe.Vuelo_ID = v.ID
            INNER JOIN Avion a ON v.Avion_ID = a.ID
            WHERE pe.Billete = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $billete);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = [];

    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }

    echo json_encode($response);

    $stmt->close();
    $conexion->close();
}