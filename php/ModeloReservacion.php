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

                $usuario = $_POST['UsuarioID'] ?? '';
                $hora = $_POST['HorarioID'] ?? '';
                $cantidad = $_POST['CantidadID'] ?? '';
                $fecha = $_POST['Fecha'] ?? '';
                $estado = $_POST['EstadoID'] ?? '';

                // Validar datos
                if (empty($usuario) || empty($hora) || empty($cantidad) || empty($fecha) || empty($estado) ) {
                    echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
                    exit;
                }

                 $stmt = $conn->prepare("INSERT INTO reservacion (UsuarioID, HorarioID, CantidadID, Fecha, EstadoID) VALUES (?,?,?,?,?)");
                 $stmt->bind_param("iiisi", $usuario, $hora, $cantidad, $fecha, $estado);

                if ($stmt->execute()) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt->error]);
                }

                $stmt->close();
                $conn->close();
                break;
            case "crearAdmin":
                include 'bd_conexion.php';

                $usuario = $_POST['Nombre'] ?? '';
                $hora = $_POST['HorarioID'] ?? '';
                $cantidad = $_POST['CantidadID'] ?? '';
                $fecha = $_POST['Fecha'] ?? '';
                $estado = $_POST['EstadoID'] ?? '';

                $tipo = "4";
                $username = "anomino";
                $telefono = "0000000000";
                $contra = "pass"
            
                // Validar datos
                if (empty($usuario) || empty($hora) || empty($cantidad) || empty($fecha) || empty($estado) ) {
                    echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
                    exit;
                }

                $stmt1= $conn->prepare("INSERT INTO Usuarios (Nombre, NombreUsuario, Telefono, Contrasena, TipoID) VALUES (?,?,?,?,?)");
                $stmt1->bind_param("ssisi", $usuario, $username, $telefono, $contra, $tipo);

                if ($stmt1->execute()) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt1->error]);
                }

                $stmt1->close();

                $stmtU = $conn->prepare("SELECT UsuarioID FROM usuarios ORDER BY UsuarioID DESC LIMIT 1");
                $stmtU->execute();
                $stmtU->bind_result($row_reciente);
                if($result->num_rows > 0) {
                    $dato = $result->fetch_assoc();
                    $reciente = $dato['UsuarioID'];
                }
                $stmtU->close();


                 $stmt2 = $conn->prepare("INSERT INTO reservacion (UsuarioID, HorarioID, CantidadID, Fecha, EstadoID) VALUES (?,?,?,?,?)");
                 $stmt2->bind_param("iiisi", $reciente, $hora, $cantidad, $fecha, $estado);

                if ($stmt2->execute()) {
                    echo json_encode(["statusCode" => 200]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt2->error]);
                }

                $stmt2->close();
                $conn->close();
                break;
            case "eliminar":
                
                break;
            default:
                echo json_encode(["statusCode" => 400, "error" => "Acción no reconocida"]);
                break;
        }
?>