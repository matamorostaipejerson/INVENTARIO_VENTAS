<?php   
include "./db.php";

$conexion = new Conexion();
$con =  $conexion->Conectar();


$Option = $_POST['Option']?$_POST['Option']:0;
if($Option ==1 || $Option ==2 ){
    $Nombre = $_POST['Nombre']?$_POST['Nombre']:0;
    $Fecha = $_POST['Fecha']?$_POST['Fecha']:0;
    $ValorTotal = $_POST['ValorTotal']?$_POST['ValorTotal']:0;
}elseif ($Option ==3 || $Option ==4) {
    $Id = $_POST['Id']?$_POST['Id']:0;
}



switch ($Option) {
    case 1: //Caso 1 para insertar ingresos
        $sentencia = "INSERT INTO administracion(Fecha,Descripcion,ValorTotal,Tipo)VALUES('$Fecha','$Nombre',$ValorTotal,1)";
        $exe =$con->prepare($sentencia);
        if ($exe->execute()) {
            $datos =true;
        }else{
            $datos=false;
        }
       

        break;
    case 2: //Caso 2 para insertar Egresos
        $sentencia = "INSERT INTO administracion(Fecha,Descripcion,ValorTotal,Tipo)VALUES('$Fecha','$Nombre',$ValorTotal,2)";
        $exe =$con->prepare($sentencia);
        if ($exe->execute()) {
            $datos =true;
        }else{
            $datos=false;
        }
       
    break;
    case 3: //Actualizar Registro ingresos (Salidas)
        $sentencia = "UPDATE salidas SET Procesado = 1 WHERE Id_Salida = $Id";
        $exe =$con->prepare($sentencia);
        if ($exe->execute()) {
            $datos =true;
        }else{
            $datos=false;
        }
       
    break;

    case 4: //Actualizar Registro egresos (Entradas)
        $sentencia = "UPDATE entradas SET Procesado = 1 WHERE Id_Entrada = $Id";
        $exe =$con->prepare($sentencia);
        if ($exe->execute()) {
            $datos =true;
        }else{
            $datos=false;
        }
       
    break;
   
}
print json_encode($datos, JSON_UNESCAPED_UNICODE);  /* para enviar el array final en formato json  a JS */

$con = NULL;
?>