<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include 'bd_conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["statusCode" => 405, "error" => "Método no permitido"]);
    exit;
}   
    $accion = $_POST['accion'] ?? '';
    
        switch ($accion) {
            case "crear":
                include 'bd_conexion.php';

                $cantidad = $_POST['Cantidad'] ?? '';

                // Validar datos
                if (empty($cantidad)) {
                    echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
                    exit;
                }

                 $stmt = $conn->prepare("INSERT INTO CantidadReservacion (CantidadPersonas) VALUES (?)");
                 $stmt->bind_param("s", $cantidad);

                if ($stmt->execute()) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt->error]);
                }

                $stmt->close();
                $conn->close();
                break;
            case "eliminar":
                
                break;
            default:
                echo json_encode(["statusCode" => 400, "error" => "Acción no reconocida"]);
                break;
        }
?>