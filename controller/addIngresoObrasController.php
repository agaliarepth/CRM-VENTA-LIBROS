<?php 
require_once("model/devolucionObrasModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/contratosModel.php");
require_once("model/notasIngresoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");
require_once("model/detalleDevolucionObrasModel.php");

$dev=new devolucionObras();
$det=new detalleDevolucionObras();
$c=new Contrato();

$tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$ni=new notaIngreso();
$li=new Libros();
$al=new Almacen();
$la=new librosAlmacenes();
$res4=$al->autocompletar();

if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="gi"){
	
	$det=new detalleDevolucionObras();
	$res2=$dev->getId($_GET["id"]);
	$res3=$det->getDetalle($res2["iddevolucionObras"]);
	require_once("view/addIngresoObras.php");

}
	
	if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	
	
	if($_POST["nombre_envia"]=="" ){
		 
		 header("Location:".config::ruta()."?accion=addIngreso&m=2");
		 }
		 else{
			 if($_POST["num_filas"]==""|| $_POST["cant_total"]=="")
			  header("Location:".config::ruta()."?accion=addIngreso&m=3");
			  else{

	                 $cadena = explode("/",$_POST["almacenes"]);
                     $ni->recibe=$cadena[1];
					 $ni->envia=strtoupper($_POST["nombre_envia"]);	
					 $ni->fecha=$_POST["fecha"];
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Procesando";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->idusuarios=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$cadena[0];
		             $ni->nombre_almacen=$cadena[1];
					 $ni->terminado="1";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 	 $ni->obs=$_POST["obs"];
					 $ni->nuevo();
					 $lastID=notaIngreso::$lastId;
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleIngreso();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->ingreso_idingreso=$lastID;
		 $de->nuevo();
		 

		 }
		 $dev->updateEstado($_POST["idobras"],"admin");
		  $dev->updateNotaIngreso($_POST["idobras"],$lastID);
					header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
					 

					 
			  }
	
		 }
	
	}
	
		

?>