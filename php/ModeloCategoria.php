<?php
    $accion = $_POST['accion'];

    switch($accion){
        case "crear":
            break;
        case "actualizar":
            break;
        case "eliminar":
                 include 'bd_conexion.php';
                 $id = $_POST['id'];
                 $sqlP = "DELETE FROM platillo WHERE CategoriaID = $id";
                if (mysqli_query($conn, $sqlP)) {
                    echo json_encode(array("statusCode"=>200));
                } 
                else {
                    echo json_encode(array("statusCode"=>201));
                }

                $sqlC = "DELETE FROM categoria WHERE CategoriaID = $id";
                if (mysqli_query($conn, $sqlC)) {
                    echo json_encode(array("statusCode"=>200));
                } 
                else {
                    echo json_encode(array("statusCode"=>201));
                }

                mysqli_close($conn);

            break;
    }
?>