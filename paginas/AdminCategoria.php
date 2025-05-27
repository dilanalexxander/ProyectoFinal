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

    <div class="container-fluid my-3">
        <a href="../paginas/PerfilAdmin.php">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">CATEGORÍAS</h1>
    </section> <br>

    <div class="container text-center">

        <div style="max-height: 60vh; overflow-y: auto;">
            <?php 
                try{
                    require_once('../php/bd_conexion.php');
                    $sql = "SELECT * FROM categoria";
                    $resultado = $conn->query($sql);
                } catch(\Exception $e){
                    echo $e->getMessage();
                }
            ?> 
            
            <table class="table table-hover justify-content-center align-items-center text-center textStyleUser">
            <thead>
                <tr class="table-dark">
                <th scope="col"></th>
                <th scope="col">Categoría</th>
                <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody id="tablaCategoria">
                 <?php while($categorias = $resultado->fetch_assoc()){
                    $cat = "cat-" . $categorias['CategoriaID'];
                    $radioCat =  "radio" .$cat;   
                ?>

                <tr class="tableDato" id="<?php echo $cat; ?>" onclick="seleccionCategoria('<?php echo $cat; ?>')">
                    <td class="catselect p-5">
                        <div class="form-check align-content-center">
                            <input class="form-check-input" type="radio" name="<?php echo $radioCat; ?>" id="<?php echo $radioCat; ?>">
                        </div>
                    </td>
                    <td class="catnombre"><?php echo $categorias['Nombre'];?></td>
                    <td class="catfoto">
                        <?php $urlC = "../imagenes/menu/". $categorias['Foto']; ?>
                        <img src="<?php echo $urlC;?>" class="img-thumbnail" alt="..." style="height: 200px;">
                    </td>
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>

        <?php
            $conn->close();
        ?>
      
        <div class="d-flex justify-content-center align-items-center tButtons">
            <button type="button" onclick="window.location.href='AgregarCategoria.html'" class="btn btn-primary btn-lg " style="margin-right: 100px">Nuevo</button>
            <button type="submit" class="btn btn-secondary btn-lg" onclick="eliminarCategoria()">Eliminar</button>
        </div>
        
    </div>

    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/Categoria.js"></script>
    <script src="../js/Funciones.js"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
</body>