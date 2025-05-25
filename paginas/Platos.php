<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Menu.css" rel="stylesheet"> 
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body>
     <?php $varCat = $_GET['cat_id'];?>

    <div class="container-fluid my-3">
        <a href="../index.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>
  

    <div class="container">
         <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sqlP = "SELECT * FROM platillo WHERE CategoriaID =" . $varCat;
                $resultadoP = $conn->query($sqlP);
            } catch(\Exception $e){
                echo $e->getMessage();
            }

             try{
                require_once('../php/bd_conexion.php');
                $sqlC = "SELECT Nombre FROM categoria WHERE CategoriaID =" . $varCat;
                $resultadoC = $conn->query($sqlC);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <?php  $categoria = $resultadoC->fetch_assoc(); ?>

        <H1 class="text-center encabezado"><?php echo $categoria['Nombre'] ?></H1>
        <div class="container w-75">
        
             <?php 
            $listaCat = array();
            while($plato = $resultadoP->fetch_assoc()){  ?>

             <div class="card p-2 m-2 my-5 card_plato">
                <?php $urlP = "../imagenes/menu/" .$plato['Imagen']; ?>
                <div class="w-90">
                    <img src="<?php echo $urlP; ?>" class="card-img-top" alt="<?php echo $plato['Nombre']; ?>">
                </div>
                <div class="card-body">
                    <div class="card-title row">
                        <h5 class="col-8"><?php echo $plato['Nombre'];?></h5>
                        <?php $precio = "$". $plato['Precio'];?>
                        <h5 class="col-4 precio"><?php echo $precio;?></h5>
                    </div>
                  <p class="card-text"><?php echo $plato['Descripcion'];?></p>
                </div>
            </div>

                <?php
            }?>

            
        </div>
        <?php
            $conn->close();
        ?>
    </div>
    

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
