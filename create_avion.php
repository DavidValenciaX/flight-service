<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'create_avion') {
    $modelo = $_POST['modelo'];
    $capacidad = $_POST['capacidad'];
    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    $sql = "INSERT INTO Avion (Modelo, Capacidad, Filas, Columnas) VALUES ('$modelo', '$capacidad', '$filas', '$columnas')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo avión creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}