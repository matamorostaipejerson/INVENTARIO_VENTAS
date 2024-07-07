<?php

require('../php/db.php');
$objeto = new Conexion();  
$conexion =$objeto-> Conectar();  
session_start();

if (isset($_GET['Id_Articulo'])) {
    $Id = $_GET['Id_Articulo'];
    $Sentencia = $conexion->prepare('delete from articulos where Id_Articulo = ?;');
    $Sentencia ->execute([$Id]); 
    $datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
    header('Location: Productos.php');
}
?>