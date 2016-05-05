<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
$c=new Contrato();
$vendedor=new Vendedores();
$cobrador=new Cobrador();
$det=new detalleContrato();
if(isset($_POST["tipo"])&& $_POST["tipo"]=="diaria"){
	
	$res=$c->produccionDiaria($_POST["fecha"]);
	
	}
	
	
	require_once("view/produccionDiariaVentas.php");

?>