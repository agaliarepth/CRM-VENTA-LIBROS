<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");




$vendedor=new Vendedores();
$cobrador=new Cobrador();
$c=new Contrato();
$det=new detalleContrato();
$kv=new kardexVendedor();
$f=getdate();
$res=$c-> listarTodosMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
	
	$res=$c->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}
require_once("view/registroContratos.php");




?>