<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title> 
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.2.css">
    <link rel="stylesheet" href="../css/Opiniones.css"> 
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
    <link rel="stylesheet" href="../css/Admin.css">
</head>
</head>

<body>
    
    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">PERFIL DE ADMINISTRADOR</h1>
    </section> <br>
    

    <!-- Nav tabs -->

    <div class="container">
    <ul class="nav nav-tabs justify-content-center nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#reservaciones">Reservaciones</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#menu">Menú</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#usuarios">Usuarios</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#opiniones">Opiniones</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#reportes">Reportes</a>
        </li>
    </ul>
    </div>

    
    <div class="tab-content">
        <div class="tab-pane fade show active container" id="reservaciones">
            <h2 class="text-center encabezado2 my-3">Reservaciones</h2>

            <div class="text-end">
                <a href="./AdminReserva.html" class="btn btn-md btn-secondary my-2">Editar opciones de reservación</a>
            </div>

            <div style="max-height: 50vh; overflow-y: auto;">
                <table class="table table-hover justify-content-center align-items-center text-center textStyleAdmin">
                      <?php 
                            try{
                                require_once('../php/bd_conexion.php');
                                $sqlR = "SELECT SELECT reservacion.Fecha, horarioreservacion.Hora, cantidadreservacion.CantidadPersonas AS Cantidad, estadoreservacion.EstadoReservacion AS Estado, usuarios.Nombre FROM reservacion INNER JOIN horarioreservacion ON reservacion.HorarioID = horarioreservacion.HorarioID INNER JOIN  cantidadreservacion ON reservacion.CantidadID = cantidadreservacion.CantidadID INNER JOIN usuarios ON reservacion.UsuarioID = usuarios.UsuarioID INNER JOIN estadoreservacion ON reservacion.EstadoID = estadoreservacion.EstadoID";
                                $resultadoR = $conn->query($sqlR);
                            } catch(\Exception $e){
                                echo $e->getMessage();
                            }
                        ?>
                    <thead>
                    <tr class="table-dark">
                        <th> </th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Cantidad de personas</th>
                        <th>Estado de reservación</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while($reservaciones = $resultadoR->fetch_assoc()){ 
                            $res = "res" . $reservaciones['PlatilloID'];
                            $radioRes =  "radio" .$res;   
                        ?>
                        <tr class="tableDato" id="<?php . $res . ?>" onclick="seleccionCategoria('<?php . $res . ?>')">
                            <td>
                                <input type="hidden" id="resId" name="resId" value="<?php . $reservaciones['PlatilloID'] . ?>">
                            </td>
                            <td class="catselect p-5"><input type="radio" class="form-check-input" id="<?php . $radioRes . ?>" name="<?php . $radioRes . ?>"></td>
                            <td id="rnomS1"><?php echo $reservaciones['Nombre']; ?></td>
                            <td id="rfechaS1"><?php echo $reservaciones['Fecha']; ?></td>
                            <td id="rhoraS1"><?php echo $reservaciones['Hora']; ?></td>
                            <td id="rperS1"><?php echo $reservaciones['Cantidad']; ?></td>
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
                        </tr>
                        <?php } ?>
                    </tbody>
                     <?php
                        $conn->close();
                    ?> 
                </table>
            </div> <br>

            <div>
                <button class="btn btn-lg float-start btn-secondary mx-3">Cancelar</button>
                <button class="btn btn-lg float-start btn-primary mx-3">Confirmar</button>
                <a href="./ReservacionAdmi.html" class="btn btn-lg float-end btn-primary">Nueva Reservación</a>
            </div>

        </div>

        <div class="tab-pane fade container" id="menu">
            <h2 class="text-center encabezado2 my-3">Menú</h2>

            <div class="text-end">
                <a href="./AdminCategoria.html" class="btn btn-md btn-secondary my-2">Editar Categorias</a>
            </div>

            <div style="max-height: 50vh; overflow-y: auto;">
                <table class="table-hover table justify-content-center align-items-center text-center textStyleAdmin">
                    <?php 
                            try{
                                require_once('../php/bd_conexion.php');
                                $sqlM = "SELECT platillo.PlatilloID, platillo.Nombre, platillo.Precio, platillo.Descripcion, platillo.Imagen, categoria.Nombre AS Categoria FROM platillo INNER JOIN categoria ON platillo.CategoriaID = categoria.CategoriaID";
                                $resultadoM = $conn->query($sqlM);
                            } catch(\Exception $e){
                                echo $e->getMessage();
                            }
                        ?>
                    <thead>
                        <tr class="table-dark">
                            <th> </th>
                            <th>Categoria</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php while($menus = $resultadoM->fetch_assoc()){ 
                            $menu = "menu" . $menus['PlatilloID'];
                            $radioMenu =  "radio" .$menu;   
                        ?>
                        <tr class="tableDato" id="<?php . $menu . ?>" onclick="seleccionCategoria('<?php . $menu . ?>')">
                            <td>
                                <input type="hidden" id="menuId" name="menuId" value="<?php . $menus['PlatilloID'] . ?>">
                            </td>
                            <td class="catselect p-5"><input type="radio" class="form-check-input" id="<?php . $radioMenu . ?>" name="<?php . $radioMenu . ?>"></td>
                            <td id="mcatS1"><?php echo $menus['Categoria']; ?></td>
                            <td id="mplaS1"><?php echo $menus['Nombre']; ?></td>
                            <td id="mpreS1"><?php echo $menus['Precio']; ?></td>
                            <td id="mdesS1"><?php echo $menus['Descripcion']; ?></td>
                            <td class="catfoto">
                                <img src="../imagenes/menu/<?php . $menus['Imagen'] . ?>"  class="img-thumbnail" alt="..." style="height: 200px;">
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    <?php
                        $conn->close();
                    ?> 
                </table>
            </div> <br>

            <div>
                <button class="btn btn-lg float-start btn-secondary mx-3">Eliminar Platillo</button>
                <a href="./EditarPlato.html" class="btn btn-lg float-start btn-primary mx-3">Editar Platillo</a>
                <a href="./EditarPlato.html" class="btn btn-lg float-end btn-primary">Nuevo Platillo</a>
            </div>
        </div>

        <div class="tab-pane fade container" id="usuarios">
            <h2 class="text-center encabezado2 my-3">Usuarios</h2>

            <div style="max-height: 50vh; overflow-y: auto;">
                <table class="table-hover table justify-content-center align-items-center text-center textStyleAdmin">
                     <?php 
                            try{
                                require_once('../php/bd_conexion.php');
                                $sqlU = "SELECT usuarios.UsuarioID, usuarios.Nombre, usuarios.NombreUsuario, usuarios.Telefono, usuarios.Contrasena, tipousuario.NombreTipo FROM usuarios INNER JOIN tipousuarios ON usuarios.TipoID = tipousuario.TipoID";
                                $resultadoU = $conn->query($sqlU);
                            } catch(\Exception $e){
                                echo $e->getMessage();
                            }
                        ?>
                    <thead>
                    <tr class="table-dark">
                        <th> </th>
                        <th>Tipo de usuario</th>
                        <th>Nombre de usuario</th>
                        <th>Nombre completo</th>
                        <th>Teléfono</th>
                        <th>Contraseña</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                         <?php while($usuarios = $resultadoU->fetch_assoc()){ 
                            $user = "user" . $usuarios['UsuarioID'];
                            $radioUser =  "radio" .$user;   
                        ?>
                        <tr class="tableDato" id="<?php . $user . ?>" onclick="seleccionCategoria('<?php . $user . ?>')">
                            <td>
                                <input type="hidden" id="userId" name="userId" value="<?php . $usuarios['UsuarioID'] . ?>">
                            </td>
                            <td class="catselect p-5"><input type="radio" class="form-check-input" id="<?php . $radioUser . ?>" name="<?php . $radioUser . ?>"></td>
                            <td><?php echo $usuarios['NombreTipo']; ?></td>
                            <td><?php echo $usuarios['NombreUsuario']; ?></td>
                            <td><?php echo $usuarios['Nombre']; ?></td>
                            <td><?php echo $usuarios['Telefono']; ?></td>
                            <td><?php echo $usuarios['Contrasena']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                     <?php
                        $conn->close();
                    ?> 
                </table>
            </div> <br>
            <div>
                <button class="btn btn-lg float-start btn-secondary mx-3">Eliminar Usuario</button>
                <a href="./NuevoUsuario.html" class="btn btn-lg float-start btn-primary mx-3">Editar Usuario</a>
                <a href="./NuevoUsuario.html" class="btn btn-lg float-end btn-primary mx-3">Nuevo Usuario</a>
            </div>

        </div>

        <div class="tab-pane fade container" id="opiniones">
             <?php 
                  try{
                      require_once('../php/bd_conexion.php');
                      $sqlO = "SELECT opinion.Comentario, opinion.Calificacion FROM opinion INNER JOIN reservacion ON opinion.ReservacionID = reservacion.ReservacionID WHERE opinion.Activo = 1";
                        $resultadoO = $conn->query($sqlO);
                  } catch(\Exception $e){
                      echo $e->getMessage();
                  }
              ?> 
            <h2 class="text-center encabezado2 my-3">Opiniones</h2>
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
            <div class="d-flex justify-content-center">
                <button class="btn btn-lg btn-secondary my-3">Eliminar Opinión</button>
            </div>
            <?php
                $conn->close();
            ?>
        </div>

        <div class="tab-pane fade container" id="reportes">
            <div class="container my-5">
            <br>
            <div class="d-grid" style="margin: 20px;">
                
                <a href="./ReporteOpiniones.html" class="btn btn-block btn-secondary">Reporte de Opiniones</a>
            </div>
            <br>
            <div class="d-grid" style="margin: 20px;">
                <a href="./ReporteReservaciones.html" class="btn btn-block btn-secondary">Reporte de Reservaciones</a>
            </div>
            </div>
        </div>
    </div>






    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/font-awesome.min.js"></script>
    <script src="../js/Categoria.js"></script>
</body>
</html>