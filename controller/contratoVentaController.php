<?php 
require_once("model/contratosModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/creditoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");



$c=new Contrato();
$det=new detalleContrato();
$kv=new kardexVendedor();
$credito=new Credito();
$vendedor=new Vendedores();
$cobrador=new Cobrador();

$f=getdate();
$res=$c->listarTodosVentasMesFacturados($f["mon"],$f["year"]);
if(isset($_POST["contratos"])){
	
	$res=$c->listarTodosVentasMesFacturados($_POST["mes"],$_POST["anio"]);

	
	}
require_once("view/contratosVentas.php");

?>