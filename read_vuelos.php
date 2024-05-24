<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'read_vuelos') {
    $sql = "SELECT * FROM Vuelo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $vuelos = array();
        while($row = $result->fetch_assoc()) {
            $vuelos[] = $row;
        }
        echo json_encode($vuelos);
    } else {
        echo "0 resultados";
    }
}