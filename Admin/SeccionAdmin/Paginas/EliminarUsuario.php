<?php

require('../php/db.php');
$objeto = new Conexion();  
$conexion =$objeto-> Conectar();  
session_start();

if (isset($_GET['Id_Usuario'])) {
    $Id = $_GET['Id_Usuario'];
    $Sentencia = $conexion->prepare('delete from usuarios where Id_Usuario = ?;');
    $Sentencia ->execute([$Id]); 
    $datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
    header('Location: AdminUsuarios.php');
}
?>