<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
$c=new Contrato();
$vendedor=new Vendedores();
$det=new detalleContrato();

	
	if(isset($_POST["tipo"])&& $_POST["tipo"]=="mensual"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$res=$c->getVendedoresProduccion($mes,$anio);
	
	
	}
	

	require_once("view/produccionMensualVentas.php");

?>