<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
$c=new Contrato();
$v=new Vendedores();
$det=new detalleContrato();
if(isset($_POST["tipo"])&& $_POST["tipo"]=="diaria"){
	
	$res=$c->produccionDiaria($_POST["fecha"]);
	
	}
	
	if(isset($_POST["tipo"])&& $_POST["tipo"]=="mensual"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$res=$c->getVendedoresProduccion($mes,$anio);
	
	
	}
	
	if(isset($_POST["tipo"])&& $_POST["tipo"]=="comportamiento"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$res1=$c->getContratosContado($mes,$anio);
	$res2=$c->getContratosDosPagos($mes,$anio);
	$res3=$c->getContratosCuatroPagos($mes,$anio);
	$res4=$c->getContratosSeisPagos($mes,$anio);
	$res5=$c->getContratosOchoPagos($mes,$anio);
	$res6=$c->getContratosDiezPagos($mes,$anio);
	
	
	
	}
	require_once("view/produccionVenta.php");

?>