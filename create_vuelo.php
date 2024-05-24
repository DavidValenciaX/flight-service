<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'create_vuelo') {
    $avion_id = $_POST['avion_id'];
    $fecha = $_POST['fecha'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $precio = $_POST['precio'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO Vuelo (Avion_ID, Fecha, Origen, Destino, Precio, Hora) VALUES ('$avion_id', '$fecha', '$origen', '$destino', '$precio', '$hora')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo vuelo creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}