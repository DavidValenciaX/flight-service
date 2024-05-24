<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'delete_avion') {
    $id = $_POST['id'];

    $sql = "DELETE FROM Avion WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Avión eliminado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}