<?php
require_once 'conexion.php';

if (isset($_GET['vuelo_id'])) {
    $vuelo_id = $_GET['vuelo_id'];

    $sql = "SELECT v.*, a.Modelo, a.Filas, a.Columnas
            FROM Vuelo v
            JOIN Avion a ON v.Avion_ID = a.ID
            WHERE v.ID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $vuelo_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $vuelo = $result->fetch_assoc();

    $sql_asientos = "SELECT Asiento FROM PasajeroEnVuelo WHERE Vuelo_ID = ?";
    $stmt_asientos = $conexion->prepare($sql_asientos);
    $stmt_asientos->bind_param("i", $vuelo_id);
    $stmt_asientos->execute();
    $result_asientos = $stmt_asientos->get_result();
    
    $asientos_ocupados = [];
    while ($row = $result_asientos->fetch_assoc()) {
        $asientos_ocupados[] = $row['Asiento'];
    }

    $vuelo['asientos_ocupados'] = $asientos_ocupados;

    echo json_encode($vuelo);

    $stmt->close();
    $stmt_asientos->close();
    $conexion->close();
}