<?php
//Comprobacion de conexión de la base de datos
/* Hacemos un include el fichero conexion.php ya que nos devolvera un boolean 
para comprobar la conexión */
include("db/conexion.php");
$conn = conexion();
// Si es false lanzara un mensaje de error entonces se conectara con la base de datos
if (!$conn) {
    die("Error de conexión con la db " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/animation.css" rel="stylesheet">
    <title>CRUD</title>
</head>

<body>
    <!-- Header de la página-->
    <div class="container-fluid mt-0  ">
        <div class="row pt-4 pb-4 bg-dark shadow">
            <div class="col text-center text-white ">
                <div class="display-4 ">ALTAS, BAJAS Y CONSULTAS</div>
            </div>
        </div>
        <!-- Formulario de inserción de datos -->
        <div class="container-md">
            <form method="POST" action="insert.php">
                <div class="row g-3  justify-content-center mt-5 ">
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12 ">
                        <label for="input-id" class="col-form-label">Codigo</label>
                        <input type="text" name="input-id" class="form-control w-3">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        <label for="input-nombre" class="col-form-label">Nombre</label>
                        <input type="text" name="input-nombre" class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        <label for="input-clave" class="col-form-label">Clave</label>
                        <input type="text" name="input-clave" class="form-control">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-12">
                        <label for="input-rol" class="col-form-label">Rol</label>
                        <input type="text" name="input-rol" class="form-control">
                    </div>
                    <div class="co-md-* align-self-center col-md-*">
                        <button type="submit" name="insertar" class="btn btn-primary">INSERTAR DATOS</button>
                    </div>
                </div>
            </form>
            <!--Tabla donde se mostrarán los datos que se han enviado a la base de datos-->
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Borrar</th>
                    </tr>
                </thead>
                <?php
                
                $sql = "SELECT * FROM users"; //Hacemos una select de todos los campos de la tabla usuarios
                // Prepraramos la query y la guardamos
                $result = mysqli_query($conn, $sql);
                // Si existe algín resultado en la base de datos recorremos todas las filas y mostraremos los datos 
                if ($result) {
                    // Guardamos los datos en una array asociativa
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th scope="col"><?php echo $row['codigo']; ?></th>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['clave']; ?></td>
                            <td><?php echo $row['rol']; ?></td>
                            <td><a href="edit.php?editar=<?php echo $row['codigo']  ?>">Editar</a></td>
                            <td><a href="delete.php?delete=<?php echo $row['codigo'] ?>">Borrar</a></td>

                        </tr>
                <?php }
                    // Liberamos memoria de la sentencia SELECT 
                    mysqli_free_result($result);
                } ?>
                <tbody>
                </tbody>
            </table>
            <?php
            // Comprobación de errores tanto de la insercion de datos, como modifcar y eliminar
            if (!isset($_GET['datos'])) {
                exit();
            } else {
                $checkData = $_GET['datos'];

                if ($checkData == "enviados") {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-success text-white zoom-in">DATOS  ENVIADOS </div>';
                    exit();
                } elseif ($checkData == "noenviado") {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-danger text-white zoom-in">DATOS NO ENVIADOS </div>';
                    exit();
                } elseif ($checkData == 'mod') {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-success text-white zoom-in">DATOS  MODIFICADOS </div>';
                    exit;
                } elseif ($checkData == 'nomod') {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-danger text-white zoom-in">DATOS NO MODIFICADOS </div>';
                    exit;
                } elseif ($checkData == 'borrados') {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-success text-white zoom-in">DATOS  BORRADOS </div>';
                } elseif ($checData == 'noborrados') {
                    echo  '<div class="mb-4 text-center fs-3 shadow rounded-pill bg-danger text-white zoom-in">DATOS NO MODIFICADOS </div>';
                }
            }
            ?>
        </div>
    </div>
    
    <?php  mysqli_close($conn) // Cierre de conexión con la base de datos?>       
</body>

</html>