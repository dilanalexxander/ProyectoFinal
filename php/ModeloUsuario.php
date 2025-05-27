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
print ($accion);
echo json_encode(["debug" => "Recibida acción: $accion"]); exit; // TEMPORAL

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
        $usuario = $_POST['NombreUsuario'] ?? '';
        $telefono = $_POST['Telefono'] ?? '';
        $contrasena = $_POST['Contrasena'] ?? '';
        $tipo = $_POST['TipoID'] ?? '';

        // Validar datos
        if (empty($nombre) || empty($usuario) || empty($telefono) || empty($contrasena) || empty($tipo)) {
            echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
            exit;
        }

        $stmt1= $conn->prepare("INSERT INTO Usuarios (Nombre, NombreUsuario, Telefono, Contrasena, TipoID) VALUES (?,?,?,?,?)");
        $stmt1->bind_param("ssssi", $nombre, $usuario, $telefono, $contrasena, $tipo);

        if ($stmt1->execute()) {
            echo json_encode(["statusCode" => 200]);
        } else {
            echo json_encode(["statusCode" => 201, "error" => $stmt1->error]);
        }

        $stmt1->close();

        /*$stmt2 = $conn->prepare("SELECT UsuarioID FROM usuarios ORDER BY UsuarioID DESC LIMIT 1");
        $stmt2->execute();
        $stmt2->bind_result($row_reciente);
        if($result->num_rows > 0) {
            $dato = $result->fetch_assoc();
            $reciente = $dato['UsuarioID'];
        }*/
        $stmt2->close();

        $conn->close();

        //$url = "localhost/paginas/PerfilUsuario.php?user_id=" . $reciente;
        
       /* header("Location:" . $url );
        exit();*/
        break;
    
    case "admin":        
        $nombre = $_POST['Nombre'] ?? '';
        $usuario = $_POST['NombreUsuario'] ?? '';
        $telefono = $_POST['Telefono'] ?? '';
        $contrasena = $_POST['Contrasena'] ?? '';
        $tipo = $_POST['TipoID'] ?? '';

        // Validar datos
        if (empty($nombre) || empty($usuario) || empty($telefono) || empty($contrasena) || empty($tipo)) {
            echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
            exit;
        }

        $stmt= $conn->prepare("INSERT INTO usuarios (Nombre, NombreUsuario, Telefono, Contrasena, TipoID) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $nombre, $usuario, $telefono, $contrasena, $tipo);

        if ($stmt->execute()) {
            echo json_encode(["statusCode" => 200]);
        } else {
            echo json_encode(["statusCode" => 201, "error" => $stmt->error]);
        }

        $stmt->close();

        $conn->close();

        $url = "localhost/paginas/PerfilAdmin.php";
       /* header("Location:" . $url );
        exit();*/
        break;

    case "iniciarSesion":                
    $telefono = $_POST['Telefono'] ?? '';
    $contrasena = $_POST['Contrasena'] ?? '';

    if (empty($telefono) || empty($contrasena)) {
        echo json_encode(["statusCode" => 400, "error" => "Faltan datos"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT UsuarioID, TipoID FROM usuarios WHERE Telefono = ? AND Contrasena = ?");
    $stmt->bind_param("ss", $telefono, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $dato = $resultado->fetch_assoc();
        $user = $dato['UsuarioID'];
        $tipo = $dato['TipoID'];

        echo json_encode(["statusCode" => 200, "user" => $user, "tipo" => $tipo]);
    } else {
        echo json_encode(["statusCode" => 401, "error" => "Credenciales incorrectas"]);
    }
try{
                    require_once('../php/bd_conexion.php');
                    $sql = "SELECT UsuarioID, TipoID FROM usuarios WHERE Telefono = " . $telefono . " AND Contrasena = " . $contrasena;
                    $resultado = $conn->query($sql);
                } catch(\Exception $e){
                    echo $e->getMessage();
                }

                 $dato = $result->fetch_assoc();
            $user = $dato['UsuarioID'];
            $tipo = $dato['TipoID'];

        stmt->execute();
        $stmt->bind_result($row_reciente);
        if($result->num_rows > 0) {
            $dato = $result->fetch_assoc();
            $user = $dato['UsuarioID'];
            $tipo = $dato['TipoID'];
        }
        $stmt->close();

        $conn->close();
        alert($user . " ". $tipo);
        if($tipo === 3){
            $url = "localhost/paginas/PerfilAdmin.php";
        }else{
            $url = "localhost/paginas/PerfilUsuario.php?user_id=" .$user;
        }
    break;

       /* include 'bd_conexion.php';
        $telefono = $_POST['Telefono'] ?? '';
        $contrasena = $_POST['Contrasena'] ?? '';

        // Validar datos
        if (empty($telefono) || empty($contrasena)) {
            echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
            exit;
        }

         try{
                    require_once('../php/bd_conexion.php');
                    $sql = "SELECT UsuarioID, TipoID FROM usuarios WHERE Telefono = " . $telefono . " AND Contrasena = " . $contrasena;
                    $resultado = $conn->query($sql);
                } catch(\Exception $e){
                    echo $e->getMessage();
                }

                 $dato = $result->fetch_assoc();
            $user = $dato['UsuarioID'];
            $tipo = $dato['TipoID'];

        stmt->execute();
        $stmt->bind_result($row_reciente);
        if($result->num_rows > 0) {
            $dato = $result->fetch_assoc();
            $user = $dato['UsuarioID'];
            $tipo = $dato['TipoID'];
        }
        $stmt->close();

        $conn->close();
        alert($user . " ". $tipo);
        if($tipo === 3){
            $url = "localhost/paginas/PerfilAdmin.php";
        }else{
            $url = "localhost/paginas/PerfilUsuario.php?user_id=" .$user;
        }
        //header("Location:" $url );
        //exit();
        alert($tipo);
        break;*/
    default:
        echo json_encode(["statusCode" => 400, "error" => "Acción no reconocida"]);
        break;
}
?>