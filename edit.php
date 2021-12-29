<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/animation.css" rel="stylesheet">
    <title>Editar campo</title>
</head>
<body>
    <!--Cabecera  -->
    <div class="row pt-4 pb-4 bg-dark shadow">
        <div class="col text-center text-white ">
            <div class="display-4 ">EDITAR</div>
        </div>
    </div>
    <?php
    // importamos la conexión
    include("db/conexion.php");
    // verificamos si esta definiada la varibale si es true entramos en la condicion
    if (isset($_POST['update'])) {

        $conn = conexion();
        // pasamos el valor editar que contendra el id del usuario 
        $id = $_GET['editar'];

        $nombre = mysqli_real_escape_string($conn, $_REQUEST["input-nombre"]);
        $clave = mysqli_real_escape_string($conn, $_REQUEST["input-clave"]);
        $rol = mysqli_real_escape_string($conn, $_REQUEST["input-rol"]);

        // realizamos la setencia para actualizar los datos de acuerdo al id pasado por el GET['editar']
        $sql = "UPDATE users 
                    SET nombre = '$nombre', clave = $clave, rol = $rol
                    WHERE codigo = $id";
        //Comprobamos si existen los datos
        if (mysqli_query($conn, $sql)) {
            //si existe procedmos a enviar mensajes por el header 
            header("Location:index.php?datos=mod");
            exit();
        } else {
            header("Location:index.php?datos=nomod");
            exit();
        }
    }
    ?>
    <!-- Formulario para poner los nuevos campos -->
    <div class="container-md">
        <form method="POST">
            <div class="row g-3  justify-content-center mt-5 ">
                <div class="col-lg-7  col-md-6 col-sm-5 col-xs-12">
                    <label for="input-nombre" class="col-form-label">Nombre</label>
                    <input type="text" name="input-nombre" class="form-control">
                </div>
                <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
                    <label for="input-clave" class="col-form-label">Clave</label>
                    <input type="text" name="input-clave" class="form-control">
                </div>
                <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
                    <label for="input-rol" class="col-form-label">Rol</label>
                    <input type="text" name="input-rol" class="form-control">
                </div>
                <div class="co-lg-7 align-self-center col-md-7">
                    <button type="submit" name="update" class="btn btn-primary">MODIFICAR DATOS</button>
                </div>
            </div>
        </form>

    </div>

</html>