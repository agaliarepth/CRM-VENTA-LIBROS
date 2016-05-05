<?php 

require_once("model/cambioObrasModel.php");
require_once("model/creditoModel.php");
require_once("model/almacenesModel.php");
require_once("model/detalleCambioObraModel.php");
require_once("model/librosModel.php");
require_once("model/notasIngresoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/cuotasModel.php");
require_once("model/detalle_contratoModel.php");

$al=new Almacen();
$res2=$al->autocompletar();
$detCambio=new detalleCambioObra();
$l=new Libros();
$c=new CambioObra();
$credito=new Credito();
$ni=new notaIngreso();
$de=new detalleIngreso();
$ne=new Egreso();
$d=new detalleEgreso();
$cuota= new Cuotas();
$detContrato=new detalleContrato();




$res=$c->listarPorEstado("ALMACEN","1");
$listaIngreso=$detCambio->getDetalleIngreso($_GET["id"]);
$listaEgreso=$detCambio->getDetalleEgreso($_GET["id"]);

$result=$c->getId($_GET["id"]);


if(isset($_POST["guardar"])&&$_POST["guardar"]=="guardar"){
	

         
                     $cadena = explode("/",$_POST["almacenesIngreso"]);
                     $ni->recibe=$cadena[1];
					 $ni->envia=strtoupper($_POST["nombre_enviaIngreso"]);	
					 $ni->fecha=$_POST["fechaIngreso"];
					 $ni->concepto=$_POST["tipoIngreso"];
					 $ni->cant_total=$_POST["cant_totalIngreso"];
					 $ni->estado="Enviado";
					 $ni->precio_total=$_POST["monto_totalIngreso"];
					 $ni->idusuarios=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$cadena[0];
		             $ni->nombre_almacen=$cadena[1];
					 $ni->terminado="1";
					 $ni->moneda="";
					 $ni->valor_cambio="";
					 $ni->obs=$_POST["obsIngreso"];
					 $ni->nuevo();
					 $lastID_ingreso=notaIngreso::$lastId;
		 for($i=0; $i<$_POST["numfilasIngreso"];$i++){
		 $de->cantidad=$_POST["cantidadIngreso"][$i];
		 $de->codigo=$_POST["codigoIngreso"][$i];
		 $de->titulo=$_POST["tituloIngreso"][$i];
		 $de->volumen=$_POST["tomoIngreso"][$i];
		 $de->precio_unitario=$_POST["precio_unitIngreso"][$i];
		 $de->precio_total=$_POST["precio_totalIngreso"][$i];
		 $de->libros_idlibros=$_POST["idlibroIngreso"][$i];
		 $de->obs=$_POST["obs_Ingreso"][$i];
		 $de->ingreso_idingreso=$lastID_ingreso;
		 $de->insertar();

		 }
		  $de->nuevo();
		  
         $cadena = explode("/",$_POST["almacenesEgreso"]);
		 $ne->envia=$cadena[1];
		 $ne->fecha=$_POST["fechaEgreso"];
		 $ne->recibe=strtoupper($_POST["recibeEgreso"]);	
		 $ne->destino=$_POST["destino"];
		 $ne->cant_total=$_POST["cant_totalEgreso"];
		 $ne->precio_total=$_POST["monto_totalEgreso"];
		 $ne->estado="Enviado";
		 $ne->idusuario=$_SESSION["ses_id"];
		 $ne->nombre_usuario=$_SESSION["nombres"];
		 $ne->cargo_usuario=$_SESSION["cargo"];
		 $ne->idalmacenes=$cadena[0];
		 $ne->nombre_almacen=$cadena[1];
		 $ne->terminado=1;
		 $ne->moneda="";
		 $ne->valor_cambio="";
		 $ne->obs=$_POST["obsEgreso"];
		 $ne->nuevo();
		 $lastID_egreso=Egreso::$lastId;
		 for($i=0; $i<$_POST["numfilasEgreso"];$i++){
		 $d->cantidad=$_POST["cantidadEgreso"][$i];
		 $d->codigo=$_POST["codigoEgreso"][$i];
		 $d->titulo=$_POST["tituloEgreso"][$i];
		 $d->volumen=$_POST["tomoEgreso"][$i];
		 $d->precio_unitario=$_POST["precio_unitEgreso"][$i];
		 $d->precio_total=$_POST["precio_totalEgreso"][$i];
		 $d->libros_idlibros=$_POST["idlibroEgreso"][$i];
		 $d->obs=$_POST["obs_Egreso"][$i];
		 $d->egreso_idegreso=$lastID_egreso;
		 $d->insertar();
				 
		 }
		 
		  $d->nuevo();

          $cred=$credito->getId($_POST["idcuentas"]);
		  $listaObras=$detCambio->getDetalle($_POST["idcambioObra"]);
		  $listaContratos=$detContrato->getDetalle($cred["contratos_idcontratos"]);


		  
		  foreach($listaObras as $f1){
			   if($f1["tipo"]==1){
				   $libro=$l->getId($f1["idlibro"]);
				   $detContrato->cantidad=1;
	               $detContrato->codigo=$libro["codigo"];
	               $detContrato->titulo=$libro["titulo"];
	               $detContrato->volumen=$libro["tomo"];
	               $detContrato->libros_idlibros=$f1["idlibro"];
	               $detContrato->contratos_idcontratos=$cred["contratos_idcontratos"];
	               $detContrato->precio_unitario=$f1["precio_unit"];
				   $detContrato->sw=1;
	               $detContrato->nuevo();
				   }
				   else{
			  foreach($listaContratos as $f2){
				  
				    if($f1["tipo"]==2 &&$f1["idlibro"]==$f2["libros_idlibros"]){
						
						$detContrato->actualizarVista($f2["iddetalle_contrato"],0);
						
						}
				  }
				   }
			  }
		   $getCambio=$c->getId($_POST["idcambioObra"]);
		   $c->updateEstadoCambioObra("APROVADO","1",$lastID_ingreso,$lastID_egreso,$_POST["idcambioObra"]);

		   $cuota->updateEstado($_POST["idcuentas"],0,2,1,1);
	       $cuota->updateEstado($_POST["idcuentas"],1,1,0,0);


     header("Location:".config::ruta()."?accion=cambioObrasAlmacen");
		 
	}
require_once("view/addCambioObrasAlmacen.php");






?>