<?php   
include "./db.php";

$conexion = new Conexion();
$con =  $conexion->Conectar();


$Option = $_POST['Option']?$_POST['Option']:0;
$Id = $_POST['Id']?$_POST['Id']:0;

switch ($Option) {
    case 1:
        $sentencia = "SELECT Id_Articulo,Codigo,Nombre,Marca,PrecioVenta FROM articulos WHERE Id_Articulo =$Id";
        $exe =$con->prepare($sentencia);
        $exe->execute();
        $datos = $exe-> fetch(PDO::FETCH_ASSOC);

        break;
    case 2:
        $sentencia = "SELECT detalle_venta.Id_Salida,articulos.Codigo,articulos.Nombre,articulos.Marca,detalle_venta.Cantidad,detalle_venta.PrecioXunidad,detalle_venta.Total FROM detalle_venta 
        INNER JOIN articulos ON detalle_venta.Id_Articulo = articulos.Id_Articulo
        INNER JOIN salidas on detalle_venta.Id_Salida = salidas.Id_Salida
        WHERE detalle_venta.Id_Salida =$Id";
        $exe =$con->prepare($sentencia);
        $exe->execute();
        $datos = $exe-> fetchAll(PDO::FETCH_ASSOC);
        break;

        case 3:
            $sentencia = "SELECT Estado From Salidas WHERE Id_Salida =$Id";
            $exe =$con->prepare($sentencia);
            $exe->execute();
            $Estado = $exe-> fetch(PDO::FETCH_ASSOC);
            if ($Estado['Estado'] ==1) {
                $sentencia = "UPDATE Salidas SET Estado =0 WHERE Id_Salida =$Id";
                $exe =$con->prepare($sentencia);
                $exe->execute();
                $datos = true;
            }else if($Estado['Estado'] ==0){
                $sentencia = "UPDATE Salidas SET Estado =1 WHERE Id_Salida =$Id";
                $exe =$con->prepare($sentencia);
                $exe->execute();
                $datos = true;
            }
        break;
   
}
print json_encode($datos, JSON_UNESCAPED_UNICODE);  /* para enviar el array final en formato json  a JS */

$con = NULL;
?>