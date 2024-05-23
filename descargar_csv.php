<?php
require_once 'conexion.php';

if (!isset($_GET['vuelo_id'])) {
    echo "ID de vuelo no especificado.";
    exit();
}

$vuelo_id = $_GET['vuelo_id'];

$sqlVuelo = "SELECT Fecha, Hora, Origen, Destino, Precio FROM Vuelo WHERE ID = ?";
$stmtVuelo = $conexion->prepare($sqlVuelo);
$stmtVuelo->bind_param("i", $vuelo_id);
$stmtVuelo->execute();
$resultVuelo = $stmtVuelo->get_result();

if ($resultVuelo->num_rows === 0) {
    echo "Vuelo no encontrado.";
    exit();
}

$vuelo = $resultVuelo->fetch_assoc();

$sqlPasajeros = "
    SELECT p.Nombre, p.Apellidos, p.Fecha_Nac, p.Sexo, pev.Billete, pev.Asiento
    FROM PasajeroEnVuelo pev
    JOIN Pasajero p ON pev.Pasajero_ID = p.ID
    WHERE pev.Vuelo_ID = ?";
$stmtPasajeros = $conexion->prepare($sqlPasajeros);
$stmtPasajeros->bind_param("i", $vuelo_id);
$stmtPasajeros->execute();
$resultPasajeros = $stmtPasajeros->get_result();

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="informacion_vuelo_' . $vuelo_id . '.csv"');

$output = fopen('php://output', 'w');
fwrite($output, "\xEF\xBB\xBF");
fputcsv($output, ['Fecha', 'Hora', 'Origen', 'Destino', 'Precio']);
fputcsv($output, [$vuelo['Fecha'], $vuelo['Hora'], $vuelo['Origen'], $vuelo['Destino'], $vuelo['Precio']]);

fputcsv($output, []);
fputcsv($output, ['Nombre', 'Apellidos', 'Fecha de Nacimiento', 'Sexo', 'Billete', 'Asiento']);

while ($row = $resultPasajeros->fetch_assoc()) {
    fputcsv($output, [
        $row['Nombre'],
        $row['Apellidos'],
        $row['Fecha_Nac'],
        $row['Sexo'],
        $row['Billete'],
        $row['Asiento']
    ]);
}

fclose($output);

$stmtVuelo->close();
$stmtPasajeros->close();
$conexion->close();