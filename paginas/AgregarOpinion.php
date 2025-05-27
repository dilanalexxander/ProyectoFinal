<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHATEAU BLANC</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">    
    <link rel="stylesheet" href="../css/Fonts.css">
    <link rel="stylesheet" href="../css/General.css">
</head>

<body class="bg-light">
    <?php $userID = $_GET['user_id'];?>

    <div class="container-fluid my-3">
        <a href="../paginas/PerfilUsuario.html">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">Agregar opinion</h1>
    </section> <br>

    <div class="container">
        <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sql = "SELECT ReservacionID, Fecha FROM reservacion WHERE EstadoID = 2 AND UsuarioID =" .$userID;
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <div class="mb-3 mt-3 textStyle">
            <label for="uname" class="form-label">Reservacion:</label>
            <select class="form-select" id="rFecha">
                <option value="default" selected disabled hidden>Selecciona la fecha de tu reservación</option>
                <?php      
                    while($reservas = $resultado->fetch_assoc()){ echo "<option value='" . $reservas['ReservacionID'] . "'>" . $reservas['Fecha'] . "</option>";}
                ?>
            </select>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="rOpinion" class="form-label">Opinión:</label>
            <input type="text" class="form-control" id="rOpinion" placeholder="Escribe tu opinión" name="rOpinion" required>
        </div>
        
        <div class="mb-3 mt-3 textStyle">
            <label for="uname" class="form-label">Estrellas:</label>
            <select class="form-select" id="rEstrellas">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <?php
            $conn->close();
        ?>
    </div>

    <div class="d-flex justify-content-center align-items-center my-5">
        <?php 
            $urlR = "window.location.href='./PerfilUsuario.php?user_id=" .$userID ."'";
            $agregarO = "agregarOpinion(". $userID .")";
        ?>
        <button type="button" onclick="<?php echo $agregarO; ?>" class="btn btn-primary btn-lg " style="margin-right: 100px">Guardar</button>
        <button type="button" onclick="<?php echo $urlR; ?>" class="btn btn-secondary btn-lg">Cancelar</button>
    </div>


    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/Categoria.js"></script>
    <script src="../js/Funciones.js"></script>
    <script src="../js/jquery-3.1.1.min.js"></script>
</body>