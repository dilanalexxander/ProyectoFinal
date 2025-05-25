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
<section class="banner" style="text-align: center;">
        <h1 class="page-title encabezado">AGREGAR USUARIO</h1>
    </section>

    <div class="container">
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
            <label for="uTipo" class="form-label">Tipo de usuario:</label>
            <select class="form-select" aria-label="Tipo de usuario:" id="uTipo" value="uTipo">
                <option disabled value="default">Selecciona el tipo de usuario</option><?php      
                    while($tipos = $resultadoC->fetch_assoc()){ 
                        echo "<option selected value='" . $tipos['TipoID'] . "'>" . $tipos['NombreTipo'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="uName" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="uName" placeholder="Introduce el nombre" name="uName" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="uUser" class="form-label">Nombre de usuario:</label>
            <input type="text" class="form-control" id="uUser" placeholder="Introduce el nombre de usuario" name="uUser" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="uTel" class="form-label">Telefono:</label>
            <input type="text" class="form-control" id="uTel" placeholder="Introduce el telefono" name="uTel" required>
        </div>

        <div class="mb-3 mt-3 textStyle">
            <label for="uPass" class="form-label">Contraseña:</label>
            <input type="text" class="form-control" id="uPass" placeholder="Introduce la contraseña" name="uPass" required>
        </div>

         <?php
            $conn->close();
        ?>

        <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-primary btn-lg" onclick="agregarUsuarioAdmin()">Agregar</button>
        <button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='./PerfilAdmin.php'">Cancelar</button>
        </div>
        
    </div>

    <script src="../js/popper.min.js" ></script>
    <script src="../js/bootstrap.bundle.min.js" ></script>
    <script src="../js/Funciones.js"></script>
</body>