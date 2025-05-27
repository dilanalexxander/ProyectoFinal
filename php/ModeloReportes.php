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
            case "opiniones":
                $desde = $_POST['fechaDesde'] ?? '';
                $hasta = $_POST['fechaHasta'] ?? '';

                // Validar datos
                if (empty($desde) || empty($hasta)) {
                    echo json_encode(["statusCode" => 201, "error" => "Faltan datos"]);
                    exit;
                }

                //CALIFICACIONES
                 $stmt1 = $conn->prepare("SELECT COUNT(opinion.OpinionID) AS Total, opinion.Calificacion, WEEKDAY(reservacion.Fecha) AS Dias FROM opinion INNER JOIN reservacion ON opinion.ReservacionID = reservacion.ReservacionID WHERE reservacion.Fecha BETWEEN ? AND ? GROUP BY opinion.Calificacion, WEEKDAY(reservacion.Fecha)");
                 $stmt1->bind_param("ss", $desde, $hasta);
                if ($stmt1->execute()) {
                    $estrellas = [];
                     $lun_good = 0;
                    $lun_avg = 0;
                    $lun_bad = 0;

                    $mar_good = 0;
                    $mar_avg = 0;
                    $mar_bad = 0;

                    $mier_good = 0;
                    $mier_avg = 0;
                    $mier_bad = 0;

                    $jue_good = 0;
                    $jue_avg = 0;
                    $jue_bad = 0;

                    $vie_good = 0;
                    $vie_avg = 0;
                    $vie_bad = 0;

                    $sab_good = 0;
                    $sab_avg = 0;
                    $sab_bad = 0;
                    
                    $dom_good = 0;
                    $dom_avg = 0;
                    $dom_bad = 0;
                    $result = $stmt1->get_result();
                    while ($resultadosD = $result->fetch_assoc()){
                        $calificaciones  = array("Calificacion" => $resultadosD['Calificacion'], "Dias" => $resultadosD['Dias'], "Total" => $resultadosD['Total']);
                        switch($resultadosD['Dias']){
                            case 0:
                                if($resultadosD['Calificacion'] === 2){
                                    $lun_avg = $lun_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $lun_bad = $lun_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $lun_good = $lun_good + 1;
                                }
                                break;
                            case 1:
                                 if($resultadosD['Calificacion'] === 2){
                                    $mar_avg = $mar_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $mar_bad = $mar_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $mar_good = $mar_good + 1;
                                }
                                break;
                            case 2:
                                 if($resultadosD['Calificacion'] === 2){
                                    $mier_avg = $mier_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $mier_bad = $mier_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $mier_good = $mier_good + 1;
                                }
                                break;
                            case 3:
                                 if($resultadosD['Calificacion'] === 2){
                                    $jue_avg = $jue_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $jue_bad = $jue_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $jue_good = $jue_good + 1;
                                }
                                break;
                            case 4:
                                 if($resultadosD['Calificacion'] === 2){
                                    $vie_avg = $vie_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                   $vie_bad = $vie_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $vie_good = $vie_good + 1;
                                }
                                break;
                            case 5:
                                 if($resultadosD['Calificacion'] === 2){
                                    $sab_avg = $sab_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $sab_bad = $sab_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $sab_good = $sab_good + 1;
                                }
                                break;
                            case 6:
                                 if($resultadosD['Calificacion'] === 2){
                                    $dom_avg = $dom_avg + 1;
                                }
                                else if($resultadosD['Calificacion'] < 2){
                                    $dom_bad = $dom_bad + 1;
                                }else if($resultadosD['Calificacion'] > 2){
                                    $dom_good = $dom_good + 1;
                                }
                                break;
                        }
                    }                 
                } 
                $stmt1->close();
                
                $diasCal = array(
                    array("lunes",$lun_good),
                    array("lunes",$lun_avg),
                    array("lunes",$lun_bad),
                    array("martes",$mar_good),
                    array("martes",$mar_avg),
                    array("martes",$mar_bad),
                    array("miercoles",$mier_good),
                    array("miercoles",$mier_avg),
                    array("miercoles",$mier_bad),
                    array("jueves",$jue_good),
                    array("jueves",$jue_avg),
                    array("jueves",$jue_bad),
                    array("viernes",$vie_good),
                    array("viernes",$vie_avg),
                    array("viernes",$vie_bad),
                    array("sabado",$sab_good),
                    array("sabado",$sab_avg),
                    array("sabado",$sab_bad),
                    array("domingo",$dom_good),
                    array("domingo",$dom_avg),
                    array("domingo",$dom_bad)
                );

                 //RESUMEN GENERAL
                 $stmt2 = $conn->prepare("SELECT COUNT(opinion.OpinionID) AS Estrellas, opinion.Calificacion FROM opinion INNER JOIN reservacion ON opinion.ReservacionID = reservacion.ReservacionID WHERE reservacion.Fecha BETWEEN ? AND ? GROUP BY opinion.Calificacion ORDER BY opinion.Calificacion ASC");
                 $stmt2->bind_param("ss", $desde, $hasta);

                if ($stmt2->execute()) {
                    //echo json_encode(["statusCode" => 200]);
                    $estrellas = [];
                    $result2 = $stmt2->get_result();
                    while ($resultados = $result2->fetch_assoc()) {
                        $calificaciones  = array("Estrellas" => $resultados['Estrellas'], "Total" => $resultados['Calificacion']);
                    }
                    for ($x = 0; $x < 5; $x++){
                        if ($calificaciones[$x]['Calificacion'] == ($x + 1)){
                            $estrellas = array($calificaciones[$x]['Total']);
                        }else{
                            $estrellas= array("0");
                        }
                    }
                    //echo json_encode(["Estrellas"] => $estrellas, ["Dias"] => $diasCal);
                    echo json_encode([
                        "statusCode" => 200,
                        "Estrellas" => $estrellas,
                        "Dias" => $diasCal
                    ]);
                } else {
                    echo json_encode(["statusCode" => 201, "error" => $stmt1->error]);
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