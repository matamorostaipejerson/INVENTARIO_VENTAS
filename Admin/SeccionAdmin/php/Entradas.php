<?php   
include "./db.php";

$conexion = new Conexion();
$con =  $conexion->Conectar();


$Option = $_POST['Option']?$_POST['Option']:0;
$Id = $_POST['Id']?$_POST['Id']:0;

switch ($Option) {
    case 1:
        $sentencia = "SELECT Id_Articulo,Codigo,Nombre,Marca,PrecioCosto FROM articulos WHERE Id_Articulo =$Id";
        $exe =$con->prepare($sentencia);
        $exe->execute();
        $datos = $exe-> fetch(PDO::FETCH_ASSOC);

        break;
    case 2:
        $sentencia = "SELECT Id_Entrada,Ar.Codigo,Ar.Nombre,Ar.Marca,detalle_entrada.Cantidad,detalle_entrada.Precioxunidad,detalle_entrada.Total FROM detalle_entrada
        INNER JOIN articulos as Ar on detalle_entrada.Id_Articulo =Ar.Id_Articulo
        WHERE Id_Entrada =$Id";
        $exe =$con->prepare($sentencia);
        $exe->execute();
        $datos = $exe-> fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $sentencia = "SELECT Estado From entradas WHERE Id_Entrada =$Id";
        $exe =$con->prepare($sentencia);
        $exe->execute();
        $Estado = $exe-> fetch(PDO::FETCH_ASSOC);
        if ($Estado['Estado'] ==1) {
            $sentencia = "UPDATE entradas SET Estado =0 WHERE Id_Entrada =$Id";
            $exe =$con->prepare($sentencia);
            $exe->execute();
            $datos = true;
        }else if($Estado['Estado'] ==0) {
            $sentencia = "UPDATE entradas SET Estado =1 WHERE Id_Entrada =$Id";
            $exe =$con->prepare($sentencia);
            $exe->execute();
            $datos = true;
        }
        break;
}
print json_encode($datos, JSON_UNESCAPED_UNICODE);  /* para enviar el array final en formato json  a JS */

$con = NULL;
?>