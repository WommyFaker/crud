<?php
// al dar insertar se ejecutara  el if
if (isset($_POST['insertar'])) {
    include("db/conexion.php");

    $conn = conexion();
    
    $id = mysqli_real_escape_string($conn, $_REQUEST['input-id']);
    $nombre = mysqli_real_escape_string($conn, $_REQUEST["input-nombre"]);
    $clave = mysqli_real_escape_string($conn, $_REQUEST["input-clave"]);
    $rol = mysqli_real_escape_string($conn, $_REQUEST["input-rol"]);

    // realizamos el insert
    $sql = "INSERT INTO users VALUES($id, '$nombre', $clave, $rol)";
    //comprobamos si ha podido realizar el insert
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?datos=enviados");
        exit();
    } else {
        header("Location: index.php?datos=noenviado");
        exit();
    }
}else{
    header("Location: index.php");
    exit();
}


