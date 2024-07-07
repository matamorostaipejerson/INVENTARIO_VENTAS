<?php   
include "./db.php";

$conexion = new Conexion();
$con =  $conexion->Conectar();

//parametros
$Option = $_POST['Option']?$_POST['Option']:0;
if ($Option == 1) {

    $Fecha = $_POST['Fecha']?$_POST['Fecha']:0;
    $Nombre = $_POST['Nombre']?$_POST['Nombre']:0;
    $Proveedor = $_POST['Proveedor']?$_POST['Proveedor']:0;
    $total = $_POST['total']?$_POST['total']:0; 
}elseif ($Option ==2) {
    $Id = $_POST['Id']?$_POST['Id']:0;
    $Id_Articulo = $_POST['Id_Articulo']?$_POST['Id_Articulo']:0;
    $Cantidad = $_POST['Cantidad']?$_POST['Cantidad']:0;
    $PrecioU = $_POST['PrecioU']?$_POST['PrecioU']:0;
    $Total = $_POST['Total']?$_POST['Total']:0;
}

switch ($Option) {
    case 1:
        $sentencia = "INSERT INTO entradas(Nombre,Id_Proveedor,Fecha,ValorTotal) VALUES('$Nombre',$Proveedor,'$Fecha',$total)";
        $exe =$con->prepare($sentencia);
        if($exe->execute()){
            $datos = true;
        }else{
            $datos =false;
        }

    break;

    case 2:
        $sentencia = "INSERT INTO detalle_entrada(Id_Articulo,Id_Entrada,Cantidad,Precioxunidad,Total ) VALUES($Id_Articulo,$Id,$Cantidad,$PrecioU,$Total)";
        $exe =$con->prepare($sentencia);
        if($exe->execute()){
            $sentencia = "
            SET @cant = (SELECT Cantidad FROM articulos WHERE Id_Articulo= $Id_Articulo);
            SET @total = @cant+$Cantidad ;
            UPDATE articulos set Cantidad = @total WHERE Id_Articulo =$Id_Articulo ";
            $exe =$con->prepare($sentencia);
            $datos = ($exe->execute()) ? true : false ;
        }else{
            $datos =false;
        }
    break;
    
}
print json_encode($datos, JSON_UNESCAPED_UNICODE);  /* para enviar el array final en formato json  a JS */

$con = NULL;
?>