<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
$c=new Contrato();
$ven=new Vendedores();
$det=new detalleContrato();

	
	if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	
	$listaVendedores=$c->getVendedoresContratos($_POST["fecha_ini"] ,$_POST["fecha_fin"]);
	
	
	}
	

	require_once("view/produccionOrganizacion.php");

?>