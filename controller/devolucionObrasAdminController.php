<?php 
require_once("model/devolucionObrasModel.php");
require_once("model/devolucionObrasModel.php");
require_once("model/vendedoresModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/almacenesModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/contratosModel.php");
require_once("model/notasIngresoModel.php");
require_once("model/cuentasModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/detalle_contratoModel.php");


$ni=new notaIngreso();
$ve=new Vendedores();
$dev2=new Devolucion();
$li=new Libros();
$la=new librosAlmacenes();
$kv=new kardexVendedor();
$al=new Almacen();
$det=new detalleDevolucion();
$dev=new devolucionObras();
$c=new Contrato();
$cuenta=new Cuenta();
$detaDevolucionObras=new detalleDevolucionObras();
$detContrato= new  detalleContrato();

$res=$dev->listarTodos("admin");

require_once("view/devolucionObrasAdmin.php");




if(isset($_GET["e"])&&$_GET["e"]=="aprobado"&&!isset($_GET["pro"]))
{
	
	
          $cont=0;
		  $res3=$dev->getId($_GET["id"]);
		  $res2=$det->getDetalle($res3["idingreso"]);
		  $res=$dev2->getId($res3["idingreso"]);
		  
		
		
		   foreach($res2 as $v){
		
		$kv->actualizarEstadoDevueltoObras($v["codigo"],$res3["num_contrato"],$res3["idingreso"],$res["fecha"]);		 
		   
					         }
		 
		  
			                  if($res3["tipo_devolucion"]=="DEVOLUCION TOTAL"){
			
							  $dev->updateEstado($_GET["id"],"aprobado");
							  
							  
							 $c->updateEstado($res3["idcontrato"],"Anulado");
							 
							 $dev2->actualizarEstado($res3["idingreso"]);
							 
							
							  }
							 
							  
							  else{
								  
						    $dev->updateEstado($_GET["id"],"aprobado");
							  
							  $listaDetalleDevolucion=$detaDevolucionObras->getDetalle2($res3["iddevolucionObras"]);
							  
							
							  
							  $dev=0;
							  $cantdev=0;
							  foreach($listaDetalleDevolucion as $v){
								  $dev+=$v["precio_total"];
								  $detContrato->BorrarFilasPorLibro($v["libros_idlibros"],$v["idcontrato"]);
								
								  }
								    $detalleContrato=$detContrato->getDetalle($res3["idcontrato"]);
									
									
									foreach($detalleContrato as $r){
										
											 $kv->actualizarEstadoRemitido2($r["idkardex"]);

																				}
								 $c->updateDevolucionParcial($res3["idcontrato"],$dev);
							     $dev2->actualizarEstado($res3["idingreso"]);
								  
								  
								  }
						
								
							

header("Location:".config::ruta()."?accion=devolucionObrasAdmin");
}

if(isset($_GET["e"])&&$_GET["e"]=="rechazado" &&!isset($_GET["pro"])){
	
	  $res3=$dev->getId($_GET["id"]);
	  $dev->updateEstado($_GET["id"],"sin enviar");
	  $dev2->borrar($res3["idingreso"]);
	header("Location:".config::ruta()."?accion=devolucionObrasAdmin");

	}











if(isset($_GET["e"])&&$_GET["e"]=="aprobado"&&isset($_GET["pro"]))
{
	
	
 
		  $res3=$dev->getId($_GET["id"]);
		  $res2=$det->getDetalle($res3["idingreso"]);
		  $res=$ni->getId($res3["idingreso"]);
		  $dev->updateEstado($_GET["id"],"aprobado");
		 $res5=$cuenta->getId($res3["num_cuenta"]);
		 $ni->actualizarEstado($res3["idingreso"]);
		 $cuenta->restarsaldo($res5["idcuentas"],$res3["monto_total"]);
						 
header("Location:".config::ruta()."?accion=devolucionObrasAdmin");
}

if(isset($_GET["e"])&&$_GET["e"]=="rechazado" &&isset($_GET["pro"])){
	
	  $res3=$dev->getId($_GET["id"]);
	  $dev->updateEstado($_GET["id"],"sin enviar");
	  $ni->borrar($res3["idingreso"]);
	header("Location:".config::ruta()."?accion=devolucionObrasAdmin");

	}
?>
