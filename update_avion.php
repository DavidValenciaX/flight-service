<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'update_avion') {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $capacidad = $_POST['capacidad'];
    $filas = $_POST['filas'];
    $columnas = $_POST['columnas'];

    $sql = "UPDATE Avion SET Modelo='$modelo', Capacidad='$capacidad', Filas='$filas', Columnas='$columnas' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Avión actualizado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}