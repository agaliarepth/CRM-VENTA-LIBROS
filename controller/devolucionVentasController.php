<?php 

require_once("model/devolucionObrasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalleDevolucionObrasModel.php");

$det=new detalleDevolucionObras();
$c=new Contrato();
$dev=new devolucionObras();
$f=getdate();

$res=$dev->listarTodosVentasMes($f["mon"],$f["year"]);
if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="ae"){
	
	
	$res=$dev->updateEstado($_GET["id"],"enviado");
	header("location:".config::ruta()."?accion=devolucionVentas");
	
	
	}
	if(isset($_POST["consulta"])){
		
		$res=$dev->listarTodosVentasMes($_POST["mes"],$_POST["anio"]);
		
		}
	
	

if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="bc"){
	
	
	
	$res2=$dev->getId($_GET["id"]);
	$c->updateEstado($res2["idcontrato"],"DIFERIDO");
	$dev->borrar($_GET["id"]);
	
		header("location:".config::ruta()."?accion=devolucionVentas");

	}
require_once("view/devolucionVentas.php");


?>