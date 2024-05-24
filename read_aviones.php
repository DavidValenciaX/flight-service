<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'read_aviones') {
    $sql = "SELECT * FROM Avion";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $aviones = array();
        while($row = $result->fetch_assoc()) {
            $aviones[] = $row;
        }
        echo json_encode($aviones);
    } else {
        echo "0 resultados";
    }
}