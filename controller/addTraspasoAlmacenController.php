<?php
require_once("model/traspasoAlmacenModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");
require_once("model/almacenesModel.php");



$t=new TraspasoAlmacen();
$det=new detalleTraspasoAlmacen();
$al=new Almacen();
 $listaalmacen=$al->listarTodos();

 




if(isset($_GET["e"])&&$_GET["e"]=="s"){
	
	$res2=$t->getId($_GET["id"]);
	$res3=$det->getDetalle($_GET["id"]);
	

}
	



if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="n")
{  

$res=$det->getDetalle($_GET["id"]);
$res2=$t->getId($_GET["id"]);
	  $t->updateEstado("ENVIADO",1,$_GET["id"]);
		  header("Location:".config::ruta()."?accion=traspasoAlmacen");

}
	


if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		         
					 $det->borrarPorTraspaso($_POST["idtraspaso_almacen"]);
					
					 unset($det);
	$t->total=$_POST["cant_total"];
	$t->fecha=$_POST["fecha"];
	$t->estado="SIN ENVIAR";
	$t->terminado=0;
	$t->idalmacen_recibe=$_POST["nombre_recibe"];
	$t->idalmacen_envia=$_POST["nombre_envia"];
	$t->usuario=$_SESSION["nombres"];
	$t->cargo=$_SESSION["cargo"];
	$t->obs=$_POST["obs2"];
	$t->nombre_recibe=$_POST["recibe"];
	$t->nombre_envia=$_POST["envia"];
	$t->actualizar($_POST["idtraspaso_almacen"]);
	
	
	$lastID=$_POST["idtraspaso_almacen"];
	
	 for($i=0; $i<$_POST["num_filas"];$i++){
		
        $de=new detalleTraspasoAlmacen();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=utf8_encode($_POST["titulo"][$i]);
		 $de->volumen=$_POST["tomo"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->traspaso_almacen_idtraspaso_almacen=$lastID;
		  $de->insertar();
		 
		  unset($de);
		
	}
	 $de=new detalleTraspasoAlmacen();
		  $de->nuevo();
		  unset($de);
		  header("Location:".config::ruta()."?accion=verTraspasoAlmacen&id=".$lastID);
	
		  
					 }

if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
	
	
	$t->total=$_POST["cant_total"];
	$t->fecha=$_POST["fecha"];
	$t->estado="SIN ENVIAR";
	$t->terminado=0;
	$t->idalmacen_recibe=$_POST["nombre_recibe"];
	$t->idalmacen_envia=$_POST["nombre_envia"];
	$t->usuario=$_SESSION["nombres"];
	$t->cargo=$_SESSION["cargo"];
	$t->obs=$_POST["obs2"];
	$t->nombre_recibe=utf8_encode($_POST["recibe"]);
	$t->nombre_envia=utf8_encode($_POST["envia"]);
	$t->nuevo();
	
	
	$lastID=TraspasoAlmacen::$lastId;
	$cont=0;
 for($i=0; $i<$_POST["num_filas"];$i++){
		
        $de=new detalleTraspasoAlmacen();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=utf8_encode($_POST["titulo"][$i]);
		 $de->volumen=$_POST["tomo"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->traspaso_almacen_idtraspaso_almacen=$lastID;
		  $de->insertar();
		 
		  unset($de);
		
	}
	 $de=new detalleTraspasoAlmacen();
		  $de->nuevo();
		  unset($de);
	header("Location:".config::ruta()."?accion=verTraspasoAlmacen&id=".$lastID);
	
	

}

require_once("view/addTraspasoAlmacen.php");
?>