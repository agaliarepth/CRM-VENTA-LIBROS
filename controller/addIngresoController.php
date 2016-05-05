<?php 
require_once("model/notasIngresoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$ni=new notaIngreso();
$li=new Libros();

$la=new librosAlmacenes();
$al=new Almacen();
$res2=$al->autocompletar();

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="s" ){
	$d=new detalleIngreso();
	$res4=$ni->getId($_GET["id"]);
	$res3=$d->getDetalle($_GET["id"]);
	 
		 
		 require_once("view/addIngreso.php");
	
	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		
		             $de=new detalleIngreso();
					 $de->borrarPorNotaIngreso($_POST["idingreso"]);
					
					 unset($de);
		
		             $cadena = explode("/",$_POST["almacenes"]);
                     $ni->recibe=$cadena[1];
					 $ni->envia=strtoupper($_POST["nombre_envia"]);	
					 $ni->fecha=$_POST["fecha"];
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Sin Enviar";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->idusuarios=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$cadena[0];
		             $ni->nombre_almacen=$cadena[1];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 $ni->obs=$_POST["obser"];
					 $ni->actualizar($_POST["idingreso"]);
					
					 $lastID=$_POST["idingreso"];
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleIngreso();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->ingreso_idingreso=$lastID;
		 $de->insertar();
		 unset($de);

		 }
		  $de=new detalleIngreso();
		  $de->nuevo();
		  unset($de);
					header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
					 

					 
			  }
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n" ){
	
	$nota=$ni->getId($_GET["id"]);
	$d=new detalleIngreso();
	$det=$d->getDetalle($_GET["id"]);
	$ni->actualizarEstado($_GET["id"]);
	
	/*foreach($det as $r){
		
			 $km=new kardexMayor();
		 if($la->validarExiste($r["libros_idlibros"],$nota["idalmacenes"])>0){
		 $la->sumarStock($r["libros_idlibros"],$nota["idalmacenes"],$r["cantidad"]);
		 $li->sumarStock($r["libros_idlibros"],$r["cantidad"]);
		 }
		 else{
			 $la1=new librosAlmacenes(); 
			 
			 $la1->libros_idlibros=$r["libros_idlibros"];
			 $la1->almacenes_idalmacenes=$nota["idalmacenes"];
			 $la1->stock_reservado=0;
			 $la1->stock_disponible=0;
			 $la1->stock=$r["cantidad"];
			 $la1->nuevo();
			 $li->sumarStock($r["libros_idlibros"],$r["cantidad"]);
			 
			
			 }*/
			
		
		
		//}
		header("Location:".config::ruta()."?accion=notasIngreso");
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
					 $ni->estado="Sin Enviar";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->idusuarios=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$cadena[0];
		             $ni->nombre_almacen=$cadena[1];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 $ni->obs=$_POST["obser"];
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
		 $de->obs=$_POST["obs"][$i];
		 $de->ingreso_idingreso=$lastID;
		  $de->insertar();
		 unset($de);

		 

		 }
		  $de=new detalleIngreso();
		  $de->nuevo();
		  unset($de);
					header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
					 

					 
			  }
	
		 }
	
	}
require_once("view/addIngreso.php");

?>