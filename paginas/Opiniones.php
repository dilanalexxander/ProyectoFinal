<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.2.css">
    <link href="../css/Opiniones.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body>
    <div class="container-fluid my-3">
        <a href="../paginas/PerfilUsuario.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <div class="container">
        <H1 class="text-center encabezado">OPINIONES</H1>

         <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sql = "SELECT opinion.Comentario, opinion.Calificacion,usuarios.NombreUsuario FROM opinion INNER JOIN reservacion ON opinion.ReservacionID = reservacion.ReservacionID INNER JOIN usuarios ON reservacion.UsuarioID = usuarios.UsuarioID WHERE opinion.activo = 1";
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <?php
         while($opiniones = $resultado->fetch_assoc()){?>
            <div class="row align-items-center opinionT">
                <div class="col-3 usuario_O textStyleUser">
                    <p class="text-center"><?php echo $opiniones['NombreUsuario']; ?></p>
                </div>
                <div class="col-7 comentario_O textStyle text-align-center">
                    <p><?php echo $opiniones['Comentario']; ?></p>
                </div>
                <div class="col-2 estrellas_O text-center comentario_O">
                    <?php 
                        $estrellas = $opiniones['Calificacion'] - 1;
                        for($x = 0; $x < 5; $x++){
                            if($x <= $estrellas){
                                echo "<span class='fa fa-star checked'></span>";
                            }else{
                                echo "<span class='fa fa-star'></span>";
                            }
                        }
                    ?>
                </div>
            </div>
        <?php
         }
        ?>

         <?php
            $conn->close();
        ?>
    </div>
    

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/font-awesome.min.js"></script>
</body>
