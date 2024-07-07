<?php   
include "./db.php";

$conexion = new Conexion();
$con =  $conexion->Conectar();

//parametros
$Option = $_POST['Option']?$_POST['Option']:0;
$Id = $_POST['Id']?$_POST['Id']:0;
$Codigo = $_POST['Codigo']?$_POST['Codigo']:0;
$Cantidad = $_POST['Cantidad']?$_POST['Cantidad']:0; 


switch ($Option) {
    case 1:
            $sentencia = "SELECT Estado From entradas WHERE Id_Entrada =$Id";
            $exe =$con->prepare($sentencia);
            $exe->execute();
            $Estado = $exe-> fetch(PDO::FETCH_ASSOC);
            if ($Estado['Estado'] ==1) {
                $sentencia = "
                SET @cant = (SELECT Cantidad FROM articulos WHERE Codigo= $Codigo);
                SET @total = @cant+$Cantidad ;
                UPDATE articulos set Cantidad = @total WHERE Codigo =$Codigo ";
                $exe =$con->prepare($sentencia);
                $datos = ($exe->execute()) ? true : false ;
            }else {
                $sentencia = "
                SET @cant = (SELECT Cantidad FROM articulos WHERE Codigo= $Codigo);
                SET @total = @cant-$Cantidad ;
                UPDATE articulos set Cantidad = @total WHERE Codigo =$Codigo ";
                $exe =$con->prepare($sentencia);
                $datos = ($exe->execute()) ? true : false ;
            }

    break;

    case 2:
        $sentencia = "SELECT Estado From salidas WHERE Id_Salida =$Id";
            $exe =$con->prepare($sentencia);
            $exe->execute();
            $Estado = $exe-> fetch(PDO::FETCH_ASSOC);
            if ($Estado['Estado'] ==1) {
                $sentencia = "
                SET @cant = (SELECT Cantidad FROM articulos WHERE Codigo= $Codigo);
                SET @total = @cant-$Cantidad ;
                UPDATE articulos set Cantidad = @total WHERE Codigo =$Codigo ";
                $exe =$con->prepare($sentencia);
                $datos = ($exe->execute()) ? true : false ;
            }else {
                $sentencia = "
                SET @cant = (SELECT Cantidad FROM articulos WHERE Codigo= $Codigo);
                SET @total = @cant+$Cantidad ;
                UPDATE articulos set Cantidad = @total WHERE Codigo =$Codigo ";
                $exe =$con->prepare($sentencia);
                $datos = ($exe->execute()) ? true : false ;
            }
    
    break;
    
}
print json_encode($datos, JSON_UNESCAPED_UNICODE);  /* para enviar el array final en formato json  a JS */

$con = NULL;
?>