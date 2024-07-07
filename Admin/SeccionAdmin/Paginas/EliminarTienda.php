<?php

require('../php/db.php');
$objeto = new Conexion();  
$conexion =$objeto-> Conectar();  
session_start();

if (isset($_GET['Id_Empresa'])) {
    $Id = $_GET['Id_Empresa'];
    $Sentencia = $conexion->prepare('delete from empresa where Id_Empresa = ?;');
    $Sentencia ->execute([$Id]); 
    $datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
    header('Location: index.php');
}
?>