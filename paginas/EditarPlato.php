<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEU BLANC</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body class="bg-light">
    <?php $platoID = $_GET['plato_id'];?>

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">EDITAR PLATO</h1>
    </section> <br>

    <div class="container">
        <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sqlC = "SELECT CategoriaID, Nombre FROM categoria";
                $resultadoC = $conn->query($sqlC);
            } catch(\Exception $e){
                echo $e->getMessage();
            }

            try{
                require_once('../php/bd_conexion.php');
                $sqlP = "SELECT * FROM platillo WHERE PlatilloID =" .$platoID;
                $resultadoP = $conn->query($sqlP);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <div class="mb-3 mt-3 textStyle">
            <?php 
                $platillo = $resultadoP->fetch_assoc();?>

            <label for="pname" class="form-label">Categoría:</label>
            <select class="form-select" aria-label="Categoría:" id="pname" value="pname">
                <option disabled>Selecciona la categoría del platillo</option><?php      
                    while($categorias = $resultadoC->fetch_assoc()){ 
                        if ($categorias["CategoriaID"] == $platillo["CategoriaID"] ){
                            echo "<option selected value='" . $categorias['CategoriaID'] . "'>" . $categorias['Nombre'] . "</option>";
                        }else{
                            echo "<option value='" . $categorias['CategoriaID'] . "'>" . $categorias['Nombre'] . "</option>";
                        }
                    }
                ?>

                <option disabled>Selecciona la categoría del platillo</option><?php      
                    while($categorias = $resultadoC->fetch_assoc()){ ?>
                       <option value="<?php echo $categorias['CategoriaID']; ?>"><?php echo $categorias['Nombre'];?></option>
                    <?php
                    }
                ?>
            </select>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="pname" class="form-label">Nombre del platillo:</label>
            <input type="text" class="form-control" id="pname"  placeholder="Introduce el nombre del platillo" name="pname" value="<?php echo $platillo['Nombre']; ?>">
           
        </div>

        <div class="mb-3 mt-3 textStyle" >
            <label for="pprice" class="form-label">Precio:</label>
            <input type="number" class="form-control" step="0.01" id="pprice" placeholder="Introduce el precio del platillo" name="pprice" required value="<?php echo $platillo['Precio']; ?>">
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="pdesc" class="form-label">Descripción:</label>
           <textarea class="form-control" id="pdesc" rows="3" required placeholder="Introduce la descripción del platillo" value="<?php echo $platillo['Descripcion']; ?>"><?php echo $platillo['Descripcion']; ?></textarea>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="pfoto" class="form-label">Introduce la imagen del platillo:</label>
            <input class="form-control" type="file" id="pfoto" accept="image/png, image/jpeg" value="<?php echo $platillo['Imagen']; ?>">
        </div>

        <?php
            $conn->close();
        ?>

        <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-primary btn-lg " style="margin-right: 100px">Guardar</button>
        <button type="button" onclick="window.location.href='./PerfilAdmin.html'" class="btn btn-secondary btn-lg">Cancelar</button>
        </div>
        
    </div>

    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
</body>