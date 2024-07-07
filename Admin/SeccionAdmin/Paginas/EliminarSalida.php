<?php

require('../php/db.php');
$objeto = new Conexion();  
$conexion =$objeto-> Conectar();  
session_start();

if (isset($_GET['Id_Salida'])) {
    $Id = $_GET['Id_Salida'];
    $Sentencia = $conexion->prepare('delete from salidas where Id_Salida = ?;');
    $Sentencia ->execute([$Id]); 
    $datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
    header('Location: salidas.php');
}
?>