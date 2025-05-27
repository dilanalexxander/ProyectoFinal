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

                $reservacion = $_POST['ReservacionID'] ?? '';
                $comentario = $_POST['Comentario'] ?? '';
                $calificacion = $_POST['Calificacion'] ?? '';

                // Validar datos
                if (empty($reservacion) || empty($comentario) || empty($calificacion) ) {
                    echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
                    exit;
                }

                 $stmt = $conn->prepare("INSERT INTO opinion (ReservacionID, Comentario, Calificacion) VALUES (?,?,?)");
                 $stmt->bind_param("isi", $reservacion, $comentario, $calificacion);

                if ($stmt->execute()) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt->error]);
                }

                $stmt->close();
                $conn->close();
                break;
            case "eliminar":
                 $id = $_POST['id'] ?? null;
                if (!$id || !is_numeric($id)) {
                    echo json_encode(["statusCode" => 400, "error" => "ID inválido"]);
                    exit;
                }
                $stmt = $conn->prepare("DELETE FROM opinion WHERE OpinionID = ?");
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    echo json_encode(["statusCode" => 200, "mensaje" => "Categoría eliminada"]);
                } else {
                    echo json_encode(["statusCode" => 500, "error" => $stmt->error]);
                }

                $stmt->close();
                $conn->close();
                break;
            default:
                echo json_encode(["statusCode" => 400, "error" => "Acción no reconocida"]);
                break;
        }
?>