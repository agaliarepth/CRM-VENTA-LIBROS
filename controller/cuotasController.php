<?php 
require_once("helpers/Helpers.php");
require_once("model/contratosModel.php");
require_once("model/creditoModel.php");
require_once("model/PagosModel.php");
require_once("model/cuotasModel.php");


$credito=new Credito();

$pagos=new Pago();
$cuotas=new Cuotas();

if((isset($_POST["consulta"]) && $_POST["consulta"]=='consulta')||(isset($_GET["consulta"]) && $_GET["consulta"]=='consulta')){
	
	$res=$credito-> getCreditoContratoId($_REQUEST["idcuenta"]);
	$res2=$cuotas->getIdCuentasActivas($_REQUEST["idcuenta"]);
	
	}
	if(isset($_GET["idcuenta"]) ){

	$res=$credito-> getCreditoContratoId(["idcuenta"]);
	$res2=$cuotas->getIdCuentas($_GET["idcuenta"]);
	
	}

require_once("view/cuotas.php");




?>