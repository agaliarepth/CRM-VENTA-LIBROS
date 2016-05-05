<?php 
require_once("model/creditoModel.php");
require_once("model/pagosModel.php");
require_once("model/cuotasModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");


$credito=new Credito();
$p=new Pago();
$cuota=new Cuotas();
$cobra=new Cobrador();
$vendedor=new Vendedores();


if(isset($_GET["id"])){
	$res=$p->getPagosCuenta($_GET["id"]);
	$res2=$credito->getCreditoContratoId($_GET["id"]);
	require_once("view/verCuenta.php");
	
	
	}
?>