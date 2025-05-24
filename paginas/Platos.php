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
     <?php $varCat = $_GET['varCat'];?>

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
                $sqlC = "SELECT CategoriaID FROM platillo WHERE CategoriaID =" . $varCat;
                $resultadoC = $conn->query($sqlC);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 


        <H1 class="text-center encabezado"><?php echo $resultadoC['CategoriaID'] ?></H1>
        
        <?php 
            $listaCat = array();
            while($plato = $resultadoP->fetch_assoc()){ 
                $listaCat[] = $plato;
            }
            
            $total = count($listaCat);

            for($i = 0; $i<$total; $i++)
            {
                if($i%2 == 0){
                    if($i != 0){
                        ?>
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="row">
                            <div class="card col-md c_menu">
                                <img src="../imagenes/menu/<?php . $listaCat[i]['Imagen'] .?>" class="card-img-top" alt="<?php . $listaCat[i]['Nombre'] .?>">
                                <div class="card-body">
                                    <div class="card-title row">
                                        <h5 class="col-8"><?php echo $listaCat[i]['Nombre'];?></h5>
                                        <h5 class="col-4 precio"><?php echo $listaCat[i]['Precio'];?></h5>
                                    </div>
                                <p class="card-text"><?php echo $listaCat[i]['Descripcion'];?></p>
                                </div>
                            </div>
                        <?php
                    }
                }
                else{
                    <div class="card col-md c_menu">
                        <img src="../imagenes/menu/<?php . $listaCat[i]['Imagen'] .?>" class="card-img-top" alt="<?php . $listaCat[i]['Nombre'] .?>">
                        <div class="card-body">
                            <div class="card-title row">
                                <h5 class="col-8"><?php echo $listaCat[i]['Nombre'];?></h5>
                                <h5 class="col-4 precio"><?php echo $listaCat[i]['Precio'];?></h5>
                            </div>
                            <p class="card-text"><?php echo $listaCat[i]['Descripcion'];?></p>
                        </div>
                   </div>
                }
                if($total == $i+1){
                    ?>
                    </div>
                    <?php
                }
            }
            ?>
        <?php
            $conn->close();
        ?>
    </div>
    

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>