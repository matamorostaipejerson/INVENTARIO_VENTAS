<?php

require('../php/db.php');
$objeto = new Conexion();  
$conexion =$objeto-> Conectar();  
session_start();

if (isset($_GET['Id_Proveedor'])) {
    $Id = $_GET['Id_Proveedor'];
    $Sentencia = $conexion->prepare('delete from proveedor where Id_Proveedor = ?;');
    $Sentencia ->execute([$Id]); 
    $datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
    header('Location: Proveedores.php');
}
?>