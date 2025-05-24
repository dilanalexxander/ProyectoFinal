<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Admin.css">
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body class="bg-light">

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">RESERVACIONES </h1>
    </section> <br>

    <div class="container text-center">

      <div class="row align-items-center">
        <?php 
                try{
                    require_once('../php/bd_conexion.php');
                    $sqlH = "SELECT * FROM horarioreservacion";
                    $resultadoH = $conn->query($sqlH);
                } catch(\Exception $e){
                    echo $e->getMessage();
                }

                try{
                    require_once('../php/bd_conexion.php');
                    $sqlC = "SELECT * FROM cantidadreservacion";
                    $resultadoC = $conn->query($sqlC);
                } catch(\Exception $e){
                    echo $e->getMessage();
                }
            ?>
        <div class="col-md-6">
          <table class="table table-hover justify-content-center align-items-center text-center textStyleAdmin">
            <thead>
              <tr class="table-dark">
                <th scope="col"></th>
                <th scope="col">Hora</th>
              </tr>
            </thead>
            <tbody>
                <?php while($horas = $resultadoH->fetch_assoc()){
                    $hora = "hora" . $horas['HorarioID'];
                    $horaCat =  "radio" .$hora;   
                ?>
              <tr class="tableDato" id="<?php . $hora . ?>" onclick="seleccionCategoria('<?php . $hora . ?>')">
                <td>
                    <input type="hidden" id="horaId" name="horaId" value="<?php . $horas['HorarioID'] . ?>">
                </td>
                <td class="horaselect catselect p-5">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="<?php . $horaCat . ?>" id="<?php . $horaCat . ?>" aria-label="...">
                  </div>
                </td>
                <td class="hora"><?php . $horas['Hora'] . ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          
          <div class="d-flex justify-content-center align-items-center tButtons">
            <button type="button" onclick="window.location.href='AgregarHoras.php'" class="btn btn-primary btn-lg " style="margin-right: 100px">Agregar Hora</button>
            <button type="button" class="btn btn-secondary btn-lg" onclick="">Eliminar Hora</button>
          </div>
        </div>
        
        <div class="col-md-6">
          <table class="table table-hover justify-content-center align-items-center text-center textStyleAdmin">
            <thead>
              <tr class="table-dark">
                <th scope="col"></th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>
               <?php while($cantidades = $resultadoC->fetch_assoc()){
                    $cant = "cantidad" . $cantidades['CantidadID'];
                    $cantCat =  "radio" .$cant;   
                ?>
              <tr class="tableDato" id="<?php . $cant . ?>" onclick="seleccionCategoria('<?php . $cant . ?>')">
                <td>
                    <input type="hidden" id="cantId" name="cantId" value="<?php . $cantidades['CantidadID'] . ?>">
                </td>
                <td class="cantselect catselect p-5">
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="<?php . $cantCat . ?>" id="<?php . $cantCat . ?>" value="" aria-label="...">
                  </div>
                </td>
                <td class="cantidad"><?php . $cantidades['CantidadPersonas'] . ?></td>
              </tr>
              <?php } ?>
            </tbody>
             <?php
                $conn->close();
              ?>
          </table>
          
          <div class="d-flex justify-content-center align-items-center tButtons">
            <button type="button" onclick="window.location.href='AgregarHoras.php'" class="btn btn-primary btn-lg " style="margin-right: 100px">Agregar Cantidad</button>
            <button type="button" class="btn btn-secondary btn-lg">Eliminar Cantidad</button>
          </div>
        </div>
      </div>
     
    </div>

    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/Categoria.js"></script>
</body>