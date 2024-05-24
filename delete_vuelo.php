<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'delete_vuelo') {
    $id = $_POST['id'];

    $sql = "DELETE FROM Vuelo WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Vuelo eliminado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}