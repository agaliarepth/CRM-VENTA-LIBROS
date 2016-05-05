<?php 
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");


 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);
$ni=new Egreso();
$li=new Libros();
$al=new Almacen();
$la=new librosAlmacenes();
$res2=$al->autocompletar();

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="s" ){
	$d=new detalleEgreso();
	$res4=$ni->getId($_GET["id"]);
	$res3=$d->getDetalle($_GET["id"]);
	 
		 
		 require_once("view/addEgreso.php");
	
	
	}
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		
		             $de=new detalleEgreso();
					 $de->borrarPorNotaEgreso($_POST["idegreso"]);
		
		            
                     $ni->envia=$_POST["nombre_almacen"];
					  $ni->fecha=$_POST["fecha"];
					 $ni->recibe=strtoupper($_POST["nombre_envia"]);	
					$ni->destino=$_POST["destino"];
					 $ni->cant_total=$_POST["cant_total"];
					  $ni->precio_total=$_POST["monto_total"];
					 $ni->estado="Sin Enviar";
					 $ni->idusuario=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$_POST["id_almacenes"];
		             $ni->nombre_almacen=$_POST["nombre_almacen"];
					  $ni->terminado=0;
					   $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					  $ni->obs=$_POST["obs1"];
					 $ni->actualizar($_POST["idegreso"]);
					
					 $lastID=$_POST["idegreso"];
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->egreso_idegreso=$lastID;
		 $de->obs=$_POST["obs"][$i];
		 $de->insertar();
		 
		 }
		 
		  $de->nuevo();
		  unset($de);
		header("Location:".config::ruta()."?accion=notasEgreso");

	 
			  }
	
	
	
	
	

if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n"){
	$nota=$ni->getId($_GET["id"]);
	$d=new detalleEgreso();
	$det=$d->getDetalle($_GET["id"]);
	$ni->actualizarEstado($_GET["id"]);
	foreach($det as $r){
		 $la->quitarStockEgreso($r["libros_idlibros"],$nota["idalmacenes"],$r["cantidad"]);
		 $li->quitarStockEgreso($r["libros_idlibros"],$r["cantidad"]);
		  
		 
	                   }
						header("Location:".config::ruta()."?accion=notasEgreso");

	
	
	                    }
	
	
	
	
	
	
	
if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	
	
	if($_POST["nombre_envia"]=="" ){
		 
		 header("Location:".config::ruta()."?accion=addEgreso&m=2");
		 }
		 else{
			 if($_POST["num_filas"]==""|| $_POST["cant_total"]=="")
			  header("Location:".config::ruta()."?accion=addEgreso&m=3");
			  else{

	               
                     $ni->envia=$_POST["nombre_almacen"];
					  $ni->fecha=$_POST["fecha"];
					 $ni->recibe=strtoupper($_POST["nombre_envia"]);	
					$ni->destino=$_POST["destino"];
					 $ni->cant_total=$_POST["cant_total"];
					  $ni->precio_total=$_POST["monto_total"];
					 $ni->estado="Sin Enviar";
					 $ni->idusuario=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$_POST["id_almacenes"];
		             $ni->nombre_almacen=$_POST["nombre_almacen"];
					  $ni->terminado=0;
					   $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					  $ni->obs=$_POST["obs1"];
					$ni->nuevo();
					 $lastID=Egreso::$lastId;
		for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleEgreso();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		  $de->obs=$_POST["obs"][$i];
		 $de->egreso_idegreso=$lastID;
		 $de->insertar();
		 unset($de);
		
		
		 
		 }
		  $de=new detalleEgreso();
		  $de->nuevo();
		  unset($de);
					header("Location:".config::ruta()."?accion=verEgreso&id=".$lastID);
	 
					 

					 
			  }
	
		 }
	
	}
require_once("view/addEgreso.php");

?>