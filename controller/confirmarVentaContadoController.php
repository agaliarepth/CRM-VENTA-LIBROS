<?php 
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");
require_once("model/pagocuotainicialModel.php");
require_once("model/facturasModel.php");
require_once("model/reciboModel.php");
require_once("model/cobradoresModel.php");
require_once("model/kardexVendedorModel.php");



$contrato=new Contrato();
$det_contrato=new detalleContrato();
$recibo=new Recibos();
$factura=new Facturas();
$pago=new pagosCuotaInicial();
$credito=new Credito();
$cobrador= new Cobrador();
$vendedor=new Vendedores();
$kv=new kardexVendedor();
$contado= new Contado();


	
	if(isset($_GET["id"]) && $_GET["tipo"]=='contado'){
      //$cred=$credito->getPorContrato($_GET["id"]);
	  $idcontrato=$contado->getPorContrato($_GET["id"]);
	  $res=$kv->todosContratosDiferidos($idcontrato);
	  foreach($res as $v){
		 
        		 $kv->actualizarEstadoVenta($v["idkardexvendedor"],'000000',$_GET["id"]);
		

           }
		   
		   $contrato->updateEstado($_GET["id"],"VENTA");
		   
		  header("Location:".config::ruta()."?accion=contratoVenta");
	
	}
	?>