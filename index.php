<?php
include 'conexion.php'; // archivo con la configuración de la base de datos

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'create_avion':
        include 'create_avion.php';
        break;
    case 'read_aviones':
        include 'read_aviones.php';
        break;
    case 'read_avion':
        include 'read_avion.php';
        break;
    case 'update_avion':
        include 'update_avion.php';
        break;
    case 'delete_avion':
        include 'delete_avion.php';
        break;
    case 'create_vuelo':
        include 'create_vuelo.php';
        break;
    case 'read_vuelos':
        include 'read_vuelos.php';
        break;
    case 'read_vuelo':
        include 'read_vuelo.php';
        break;
    case 'update_vuelo':
        include 'update_vuelo.php';
        break;
    case 'delete_vuelo':
        include 'delete_vuelo.php';
        break;
    default:
        echo "Acción no válida";
        break;
}