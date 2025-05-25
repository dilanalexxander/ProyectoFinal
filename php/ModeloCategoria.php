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
    
    case "eliminar":
        $id = $_POST['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            echo json_encode(["statusCode" => 400, "error" => "ID inválido"]);
            exit;
        }

        // Eliminar primero dependencias (si existen)
        $stmt1 = $conn->prepare("DELETE FROM platillo WHERE CategoriaID = ?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();

        // Luego la categoría
        $stmt2 = $conn->prepare("DELETE FROM categoria WHERE CategoriaID = ?");
        $stmt2->bind_param("i", $id);

        if ($stmt2->execute()) {
            echo json_encode(["statusCode" => 200, "mensaje" => "Categoría eliminada"]);
        } else {
            echo json_encode(["statusCode" => 500, "error" => $stmt2->error]);
        }

        $stmt2->close();
        $conn->close();
    break;
    
    case "crear":
        $nombre = $_POST['Nombre'] ?? '';

        // Validar datos
        if (empty($nombre) || !isset($_FILES['Foto'])) {
            echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
            exit;
        }

        // Carpeta donde se guardarán las imágenes
        $carpetaDestino = __DIR__ . "/../imagenes/menu/";

        // Crear carpeta si no existe
        if (!is_dir($carpetaDestino)) {
            mkdir($carpetaDestino, 0777, true);
        }

        // Datos del archivo subido
        $nombreArchivo = basename($_FILES['Foto']['name']);
        $rutaDestino = $carpetaDestino . $nombreArchivo;

        // Mover archivo subido a la carpeta destino
        if (move_uploaded_file($_FILES['Foto']['tmp_name'], $rutaDestino)) {
            // Insertar en la base de datos (nombre + nombre archivo)
            $stmt = $conn->prepare("INSERT INTO categoria (Nombre, Foto) VALUES (?, ?)");
            $stmt->bind_param("ss", $nombre, $nombreArchivo);

            if ($stmt->execute()) {
                echo json_encode(["statusCode" => 200]);
            } else {
                echo json_encode(["statusCode" => 201, "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["statusCode" => 201, "error" => "Error al mover archivo"]);
        }

        $conn->close();
    break;

    default:
        echo json_encode(["statusCode" => 400, "error" => "Acción no reconocida"]);
        break;
}
?>