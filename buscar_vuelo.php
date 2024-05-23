<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $fecha = $data["fecha"];
    $origen = $data["origen"];
    $destino = $data["destino"];

    $sql = "SELECT v.*, a.Modelo, a.Capacidad - COALESCE(p.pasajeros, 0) AS asientos_disponibles
            FROM Vuelo v
            JOIN Avion a ON v.Avion_ID = a.ID
            LEFT JOIN (
                SELECT Vuelo_ID, COUNT(*) AS pasajeros
                FROM PasajeroEnVuelo
                GROUP BY Vuelo_ID
            ) p ON v.ID = p.Vuelo_ID
            WHERE 1=1";

    if (!empty($fecha)) {
        $sql .= " AND v.Fecha = '$fecha'";
    }
    if (!empty($origen)) {
        $sql .= " AND v.Origen = '$origen'";
    }
    if (!empty($destino)) {
        $sql .= " AND v.Destino = '$destino'";
    }

    $result = $conexion->query($sql);

    $vuelos = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $vuelos[] = $row;
        }
    }

    echo json_encode($vuelos);

    $conexion->close();
}