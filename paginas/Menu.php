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

    <div class="container-fluid my-3">
        <a href="../index.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
  </div>
  

    <div class="container">
        <H1 class="text-center encabezado">MENÚ</H1>

         <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sql = "SELECT * FROM categoria";
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <?php
            while($categorias = $resultado->fetch_assoc()){
                echo "
                <div class="row">
                    <a href="../paginas/Platos.php?varCat=$categorias['CategoriaID']">
                        <div class="menu_cat" style="background-image: url(../imagenes/menu/". $categorias['Foto'] .")">
                            <div class="overlay_menu d-flex">
                            <h2 class="menu_h2 textStyle">". $categorias['Nombre'] ."</h2>
                            </div>
                        </div>
                    </a>
                </div>";
            }
        ?>

        <?php
            $conn->close();
        ?>
    </div>
    
            
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>