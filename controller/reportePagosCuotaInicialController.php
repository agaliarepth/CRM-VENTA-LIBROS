<?php 
require_once("helpers/Helpers.php");
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/recibosCuotasModel.php");
require_once("model/facturasCuotasModel.php");


$recibo= new RecibosCuotas();
$factura=new FacturasCuotas();

$contrato=new Contrato();
$credito=new Credito();
$cobrador= new Cobrador();
$vendedor=new Vendedores();
if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"){
	
	if($_POST["tipo"]=='RECIBOS'){
		$lista=$recibo->reportePagos($_POST["fecha_ini"],$_POST["fecha_fin"]);
		
		}
	
	
	if($_POST["tipo"]=='FACTURAS'){
		
		$lista=$factura->reportePagos($_POST["fecha_ini"],$_POST["fecha_fin"]);
		}
	
	
	}


	  		
require_once("view/reportePagosCuotaInicial.php");


?>