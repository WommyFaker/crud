<?php
/**
 * Metodo que realiza la conexión con la base de datos
 * return devuelve un boolean de acuerdo si ha conectado a la base de datos o no
 */
function conexion()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "usuarios";
    $conn = mysqli_connect($servername, $username, $password, $db);


    return $conn;
}
