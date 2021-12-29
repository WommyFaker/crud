<?php
include("db/conexion.php");

$conn = conexion();
$id = $_GET['delete'];
$sql = "DELETE FROM users 
        WHERE codigo = $id";

if(mysqli_query($conn, $sql)){
    header("Location:index.php?datos=borrados");
    exit();
}else{
    header("Location:index.php?datos=noborrados");
    exit();
}

