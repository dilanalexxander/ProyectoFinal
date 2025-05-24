<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEU BLANC</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.2.css">
    <link rel="stylesheet" href="../css/Opiniones.css">
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
    <link rel="stylesheet" href="../css/Admin.css">
</head>

<body>
    <?php $userID = $_GET['user_id'];?>

    <div class="container-fluid my-3">
        <a href="../paginas/PerfilUsuario.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">PERFIL DEL USUARIO</h1>
    </section> <br>

    <!-- Nav tabs -->
    
    <div class="container">
    <ul class="nav nav-tabs justify-content-center nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#info">Información del perfil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#reservaciones">Reservaciones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#opiniones">Opiniones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Reservacion.html">Reservar</a>
        </li>
    </ul>
    </div>
    
    <div class="container my-5">
        <div class="tab-content textStyle">
         
            <div class="tab-pane fade show active container-fluid my-5" id="info">
              <?php 
                  try{
                      require_once('../php/bd_conexion.php');
                      $sqlU = "SELECT * FROM usuarios WHERE UsuarioID =" .$userID;
                      $resultadoU = $conn->query($sqlU);
                  } catch(\Exception $e){
                      echo $e->getMessage();
                  }
              ?> 
                <label for="uname" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="uname" placeholder="Nombre del usuario" name="uname" disabled value=".<?php $resultadoU['Nombre'] .?>"><br>
                <label for="uuser" class="form-label">Nombre de usuario:</label>
                <input type="text" class="form-control" id="uuser" placeholder="Nombre de usuario" name="uuser" disabled value="<?php . $resultadoU['NombreUsuario'] . ?>" 
                ><br>
                <label for="utel" class="form-label">Telefono:</label>
                <input type="text" class="form-control" id="utel" placeholder="Telefono del usuario" name="utel" disabled value="<?php . $resultadoU['Telefono'] . ?>"><br>
                <label for="upass" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="upass" placeholder="Contraseña del usuario" name="upass" disabled value="<?php . $resultadoU['Contrasena'] . ?>"><br>
                <div class="d-flex justify-content-center align-items-center">
                    <button onclick="window.location.href='./EditarUsuario.php?user_id='<?php. $userID .?>'';" class="btn btn-secondary btn-lg float-end">Editar</button>
                </div>
                <?php
                  $conn->close();
                ?>
            </div>
            <div class="tab-pane fade container-fluid my-5" id="reservaciones">
                 <?php 
                  try{
                      require_once('../php/bd_conexion.php');
                      $sqlR = "SELECT reservacion.Fecha, horarioreservacion.Hora, cantidadreservacion.CantidadPersonas AS Cantidad, estadoreservacion.EstadoReservacion AS Estado FROM reservacion INNER JOIN horarioreservacion ON reservacion.HorarioID = horarioreservacion.HorarioID INNER JOIN cantidadreservacion ON reservacion.CantidadID = cantidadreservacion.CantidadID INNER JOIN reservacion.EstadoID = estadoreservacion.EstadoID WHERE reservacion.UsuarioID = " .$userID;
                      $resultadoR = $conn->query($sqlR);
                  } catch(\Exception $e){
                      echo $e->getMessage();
                  }
              ?>
                <div class="container mt-3">
                    <h2>Reservaciones</h2>
                    <div style="max-height: 50vh; overflow-y: auto;">   
                      <table class="table table-hover justify-content-center align-items-center text-center textStyleAdmin">
                        <thead>
                          <tr class="table-dark">
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Cantidad de personas</th>
                            <th>Estado de reservación</th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody>
                             <?php while($reservaciones = $resultadoO->fetch_assoc()){ ?>
                                <tr class="tableDato">
                                    <td><?php echo $reservaciones['Fecha'] ?></td>
                                    <td><?php echo $reservaciones['Hora'] ?></td>
                                    <td><?php echo $reservaciones['Cantidad'] ?></td>
                                    <?php switch ($reservaciones['Estado']) {
                                        case "Pendiente":
                                            echo "<td><span class="badge bg-primary badgeSize">Pendiente</span></td>";
                                            break;
                                        case "Confirmada":
                                            echo "<td><span class="badge bg-success badgeSize">Confirmada</span></td>";
                                            break;
                                        case "Pendiente":
                                            echo "<td><span class="badge bg-danger badgeSize">Cancelada</span></td>";
                                            break;
                                    } ?>
                                    <td>
                                    <button type="button" class="btn btn-primary btn-md" id="btnConfirmar1">Confirmar</button>
                                    <button type="button" class="btn btn-secondary btn-md" id="btnCancelar1">Cancelar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                    </div>  
                </div>
               <?php
                  $conn->close();
                ?>   
            </div>
            <div class="tab-pane fade container my-5" id="opiniones">
                <?php 
                  try{
                        require_once('../php/bd_conexion.php');
                        $sqlO = "SELECT opinion.Comentario, opinion.Calificacion FROM opinion INNER JOIN reservacion ON opinion.ReservacionID = reservacion.ReservacionID WHERE opinion.Activo = 1 AND reservacion.UsuarioID =" . $userID;
                        $resultadoO = $conn->query($sqlO);
                  } catch(\Exception $e){
                      echo $e->getMessage();
                  }
              ?>
              <div style="max-height: 50vh; overflow-y: auto;">
                <table class="table table-hover justify-content-center align-items-center text-center textStyleAdmin2">
                    <tbody>
                        <?php while($opiniones = $resultadoO->fetch_assoc()){ 
                            $op = "op" . $opiniones['OpinionID'];
                            $radioOp =  "radio" .$op;   
                        ?>
                      <tr class="tableDato" id="<?php . $cat . ?>" onclick="seleccionCategoria('<?php . $op . ?>')">
                        <td>
                            <input type="hidden" id="opId" name="opId" value="<?php . $opiniones['OpinionID'] . ?>">
                        </td>
                        <td class="catselect p-5"><input type="radio" class="form-check-input" id="<?php . $radioOp . ?>" name="<?php . $radioOp . ?>"></td>
                        <td class="comentario_O"  id="optxtS1"><?php . $opiniones['Comentario'] . ?></td>
                        <td class="estrellas_O">
                             <?php 
                                $estrellas = $opiniones['Calificacion'] - 1;
                                for($x = 0; $x < 5; $x++){
                                    if($estrellas <= $x){
                                        echo "<span class="fa fa-star checked"></span>";
                                    }else{
                                        echo "<span class="fa fa-star"></span>";
                                    }
                                }
                            ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
               <?php
                  $conn->close();
                ?> 
               <div class="d-flex justify-content-center">
                <button class="btn btn-lg btn-primary my-3 mx-3">Agregar Opinión</button>
                <button class="btn btn-lg btn-secondary my-3 mx">Eliminar Opinión</button>
            </div>
            </div>
        </div>
    </div>


    
    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/font-awesome.min.js"></script>
    <script src="../js/Categoria.js"></script>
</body>
</html>