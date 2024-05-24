<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'update_vuelo') {
    $id = $_POST['id'];
    $avion_id = $_POST['avion_id'];
    $fecha = $_POST['fecha'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $precio = $_POST['precio'];
    $hora = $_POST['hora'];

    $sql = "UPDATE Vuelo SET Avion_ID='$avion_id', Fecha='$fecha', Origen='$origen', Destino='$destino', Precio='$precio', Hora='$hora' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Vuelo actualizado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}