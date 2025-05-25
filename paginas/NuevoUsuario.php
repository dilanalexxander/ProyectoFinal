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
    <div class="container-fluid my-3">
        <a href="../paginas/PerfilAdmin.php">
            <img src="../imagenes/Logo.png" class="mx-auto d-block img-fluid menuLogoBack">
        </a>
    </div>

    <br><section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado" id="infoUsuario">EDITAR INFORMACIÓN</h1>
    </section> <br>

    <div class="container">
        <div class="mb-3 mt-3 textStyle">
            <label for="uname" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="uname" value="Introduce el nombre" name="uname" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="uuser" class="form-label">Nombre de usuario:</label>
            <input type="text" class="form-control" id="uuser" value="Introduce el nombre de usuario" name="uuser" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="utel" class="form-label">Telefono:</label>
            <input type="text" class="form-control" id="utel" value="Introduce el telefono" name="utel" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="upass" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="upass" Value="Introduce la contraseña" name="upass" required>
        </div>

        <?php 
            try{
                require_once('../php/bd_conexion.php');
                $sql = "SELECT * FROM tipousuario";
                $resultado = $conn->query($sql);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
        ?> 

        <div class="mb-3 mt-3 textStyle">
            <label for="utipo" class="form-label">Tipo de usuario</label>
            <select class="form-select" id="utipo">
                <option value="default" selected disabled hidden>Selecciona tipo de usuario</option>
                <?php      
                    while($usuarios = $resultado->fetch_assoc()){ echo "<option value='" . $usuarios['TipoID'] . "'>" . $usuarios['NombreTipo'] . "</option>";}
                ?>
            </select>
        </div>
        <?php
            $conn->close();
        ?>

        <div class="d-flex justify-content-center align-items-center my-5">
        <button type="button" class="btn btn-primary btn-lg " style="margin-right: 100px">Guardar</button>
        <button type="button" onclick="window.location.href='./PerfilAdmin.php'" class="btn btn-secondary btn-lg">Cancelar</button>
        </div>
        
    </div>

    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
</body>