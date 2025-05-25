<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body>
  <?php $userID = $_GET['user_id'];?>
  
    <div class="container-fluid my-3">
        <a href="../paginas/PerfilUsuario.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <div class="container">
        <H1 class="text-center encabezado">RESERVACIÓN</H1>
        <form>
             <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sqlP = "SELECT * FROM cantidadreservacion WHERE Activo = 1";
                $resultadoP = $conn->query($sqlP);
            } catch(\Exception $e){
                echo $e->getMessage();
            }

            try{
                require_once('../php/bd_conexion.php');
                $sqlH = "SELECT * FROM horarioreservacion WHERE Activo = 1";
                $resultadoH = $conn->query($sqlH);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

            <div class="mb-3 textStyle">
                <label for="FechaR" class="form-label">Fecha de reservación:</label>
                <?php  $fechaAct = date("d-m-y"); ?>
                <input type="date" class="form-control" id="fechaR" name="fechaR" min="<?php echo $fechaAct; ?>" required>
              </div>
            <div class="mb-3 textStyle">
                <label for="PersonasR" class="form-label">Cantidad de personas:</label>
                <select class="form-select" aria-label="Cantidad de personas" name="PersonasR" id="PersonasR">
                <option selected disabled value="personadefault">SELECCIONE LA CANTIDAD DE PERSONAS</option><?php      
                    while($personas = $resultadoP->fetch_assoc()){ echo "<option value='" . $personas['CantidadID'] . "'>" . $personas['CantidadPersonas'] . "</option>";}
                ?>
              </select>
            </div>
            <div class="mb-3 textStyle">
                <label for="HoraR" class="form-label">Hora de reservación:</label>
                <select class="form-select" aria-label="Hora de reservación" name="HoraR" id="HoraR"> 
                  <option selected disabled value="horadefault">SELECCIONE LA HORA</option>
                  <?php      
                    while($horas = $resultadoH->fetch_assoc()){ echo "<option value='" . $horas['HorarioID'] . "'>" . $horas['Hora'] . "</option>";}
                    ?>
                </select>
            </div>
             <?php 
                $reservar = "agregarReserva(". $userID .")";
            ?>
            <button type="submit" value="submit" class="btn btn-lg btn-primary" onclick="<?php echo $reservar; ?>">Reservar</button>
          </form>
           <?php
            $conn->close();
        ?>
    </div>
    

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/Funciones.js"></script>
    
</body>

</html>