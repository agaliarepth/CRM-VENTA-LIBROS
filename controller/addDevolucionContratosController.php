<?php 
require_once("model/devolucionObrasModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/contratosModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/librosModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/kardexVendedorModel.php");


$dev=new devolucionObras();
$det=new detalleDevolucionObras();
$c=new Contrato();
$kv=new kardexVendedor();
$detContrato=new detalleContrato();
$nd=new Devolucion();
$det2=new detalleDevolucion();
$li=new Libros();
$al=new Almacen();
$la=new librosAlmacenes();
$res4=$al->autocompletar();
$detaDevolucionObras=new detalleDevolucionObras();


if(isset($_GET["id"])){
	
	$det=new detalleDevolucionObras();
	$res2=$dev->getId($_GET["id"]);
	$res3=$det->getDetalle($res2["iddevolucionObras"]);
	require_once("view/addDevolucionContratos.php");

}

if(isset($_GET["e"])&&$_GET["e"]=="gi"){
	$dev=new Devolucion();
	$det=new detalleDevolucion();
	$res2=$dev->getId($_GET["id"]);
	$res3=$det->getDetalle($res2["iddevolucion"]);
	require_once("view/addDevolucionContratos.php");

}
	
	
if(isset($cont["editar"])&& $cont["editar"]=="editar" ){
                   $de=new detalleDevolucion();
					 $de->borrarPorNotaDevolucion($cont["iddevolucion"]);
					
					 unset($de);
					 $dev->nombre_vendedor=$cont["nombre_vendedor"];
	                 $dev->almacen=$cont["desc_almacen"];
	                 $dev->fecha=$cont["fecha"];
	$dev->cant_total=$cont["cant_total"];
	$dev->estado="Sin Enviar";
	$dev->vendedores_idVendedores=$cont["id_vendedor"];
	$dev->idalmacenes=$cont["id_almacenes"];
	$dev->idusuarios=$_SESSION["ses_id"];
	$dev->nombres_usuarios=$_SESSION["nombres"];
	$dev->cargo_usuarios=$_SESSION["cargo"];
	$dev->obs=$cont["obs1"];
	$dev->terminado=0;
	 $dev->actualizar($cont["iddevolucion"]);
	 $lastID=$cont["iddevolucion"];
		$fecha=$dev->getFecha($lastID);
	
 for($i=0; $i<$cont["num_filas"];$i++){
		
        $de=new detalleDevolucion();
		 $de->cantidad=$cont["cantidad"][$i];
		 $de->codigo=$cont["codigo"][$i];
		 $de->titulo=$cont["titulo"][$i];
		 $de->volumen=$cont["tomo"][$i];
		 $de->obs=$cont["obs"][$i];
		 $de->libros_idlibros=$cont["idlibro"][$i];
		 $de->devolucion_iddevolucion=$lastID;
		 $de->nuevo();
		 unset($de);
	 }
	 
	 header("Location:".config::ruta()."?accion=verDevolucion&id=".$lastID);

}


if(isset($_POST["enviarDevolucion"])&&$_POST["enviarDevolucion"]=="enviarDevolucion"){
	$dev=new Devolucion();
	$dev2=new devolucionObras();
		$det=new detalleDevolucionObras();

	
	 $res3=$dev2->getId($_POST["iddevolucionObras"]);
	 $cadena = explode("||",$_POST["almacen"]);
	$dev->nombre_vendedor=$_POST["nombre_vendedor"];
	$dev->almacen=$cadena[1];
	$dev->fecha=$_POST["fecha"];
	$dev->cant_total=$_POST["cant_total"];
	$dev->estado="Proceso";
	$dev->vendedores_idVendedores=$_POST["id_vendedor"];
	$dev->idalmacenes=$cadena[0];
	$dev->idusuarios=$_SESSION["ses_id"];
	$dev->nombres_usuarios=$_SESSION["nombres"];
	$dev->cargo_usuarios=$_SESSION["cargo"];
	$dev->obs=$_POST["obs1"];
	$dev->terminado=1;
	$dev->tipo="DEVOLUCION VENTA";
	$dev->numcontrato=$res3["num_contrato"];
	$dev->nuevo();
	$lastID=Devolucion::$lastId;
	$fecha=$dev->getFecha($lastID);
	$de=new detalleDevolucion();
	for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->devolucion_iddevolucion=$lastID;
		 $de->nuevo();
  	     $kv->actualizarEstadoDevueltoObras($_POST["codigo"][$i],$res3["num_contrato"],$lastID,$_POST["fecha"],$_POST["id_vendedor"]);

	 }
			
							   $dev2->updateEstado($_POST["iddevolucionObras"],"aprobado");
							   $dev->actualizarEstado($lastID);
							   $detalleContrato=$c->getId($res3["idcontrato"]);
							          
							  
							  if($res3["tipo_devolucion"]=="DEVOLUCION PARCIAL"){
								    $cont=$c->getId($res3["idcontrato"]);
									
									$c->numcontrato=$cont["numcontrato"];
									$c->tipocontrato="ANULADO";
								    $c->nombres=strtoupper($cont["nombres"]);
									$c->fechacontrato=$cont["fechacontrato"];
									$c->localidad=$cont["localidad"];
									$c->apellidopaterno=strtoupper($cont["apellidopaterno"]);
									$c->apellidomaterno=strtoupper($cont["apellidomaterno"]);
									$c->preciototal=$cont["preciototal"];
									$c->tipoventa=$cont["tipoventa"];
									$c->idvendedor=$cont["idvendedor"];
									$c->idchofer=$cont["idchofer"];
									$c->ci=$cont["ci"];
									$c->terminado=1;
									$c->nuevo();
									
									$lastID2=Contrato::$lastId;
									
									$list_deta=$detContrato->getDetalle($res3["idcontrato"]);
									
									 foreach($list_deta as $v){
											 
										 $detContrato->cantidad=1;
										 $detContrato->codigo=$v["codigo"];
										 $detContrato->titulo=$v["titulo"];
										 $detContrato->volumen=$v["volumen"];
										 $detContrato->precio_unitario=$v["precio_unitario"];
										 $detContrato->libros_idlibros=$v["libros_idlibros"];
										 $detContrato->idkardex=$v["idkardex"];
										 $detContrato->contratos_idcontratos= $lastID2;
										 $detContrato->nuevo(); 
										
											 }
	
								   
								   $listaDetalleDevolucion=$det->getDetalle2($_POST["iddevolucionObras"]);
							  							
							              foreach($listaDetalleDevolucion as $v){
								 
								           $detContrato->borrarFilasPorKardex($v["idkardex"],$v["idcontrato"]);
								  
								                }
												
									

	          						   $c->updateTerminado($res3["idcontrato"],0); 
								       $c->updateNumContrato($res3["idcontrato"],"");
                                  $c->updateEstado($res3["idcontrato"],"espera");
								      
								  }// FIN DE IF
								  else
								  {
									  
									    $c->updateEstado($res3["idcontrato"],"ANULADO"); 
									  
									  }
							  
	                     header("Location:".config::ruta()."?accion=verDevolucion&id=".$lastID);
}
	
		

?>