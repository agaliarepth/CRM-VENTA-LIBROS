<?php
require_once("helpers/Helpers.php");
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");
require_once("model/pagocuotainicialModel.php");
require_once("model/facturasCuotasModel.php");
require_once("model/recibosCuotasModel.php");
require_once("model/cobradoresModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/referenciasModel.php");
require_once("model/cuotasModel.php");
require_once("model/detallecuentaModel.php");
require_once("model/cuentasModel.php");
require_once("model/numcuentaModel.php");



$nc=new NumCuenta();
$contrato=new Contrato();
$det_contrato=new detalleContrato();
$recibo=new RecibosCuotas();
$factura=new FacturasCuotas();
$pago=new pagosCuotaInicial();
$credito=new Credito();
$cobrador= new Cobrador();
$vendedor=new Vendedores();
$kv=new kardexVendedor();
$contado= new Contado();

$cuota=new Cuotas();
$ref=new Referencias();
$cu=new Cuenta();
$det2=new detalleCuenta();

if(isset($_GET["id"])){
	$det=$det_contrato->getDetalle($_GET["id"]);
	$cont=$contrato->getId($_GET["id"]);
	$cred=$credito->getPorContrato($_GET["id"]);
	$listaPagos=$pago->getPagosCuotaCredito($cred["idcredito"]);
	
	
	}
	

	
	if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
		
		
		$pago->monto=$_POST["monto"];
		$pago->fecha=$_POST["fecha"];
		$pago->terminado=0;
		$pago->credito_idcredito=$_POST["credito_idcredito"];
		$pago->tipo=$_POST["tipodoc"];
		$pago->nuevo();
		$lastID=pagosCuotaInicial::$lastId;
		
		if($_POST["tipodoc"]=="FACTURA"){
			
			$recibo->fecha=$_POST["fecha"];
			$recibo->monto=$_POST["monto"];
			$recibo->nombres=strtoupper($_POST["nombresfactura"]);
		    $recibo->cinit=$_POST["carnetfactura"];
			$recibo->descripcion=strtoupper($_POST["descripcionfactura"]);
			$recibo->pagoscuotainicial_idcuota_inicial=$lastID;
			$recibo->numero=$_POST["numfactura"];
            $recibo->tipo="FACTURA";
			$recibo->nuevo();

			
			}
		if($_POST["tipodoc"]=="RECIBO"){
			$recibo->monto=$_POST["monto"];
			$recibo->fecha=$_POST["fecha"];
			$recibo->descripcion=$_POST["descripcionrecibo"];
			$recibo->nombres=strtoupper($_POST["nombresrecibo"]);
			$recibo->pagoscuotainicial_idcuota_inicial=$lastID;
			$recibo->numero=$_POST["numrecibo"];
            $recibo->tipo="RECIBO";
			$recibo->nuevo();
			
			
		}
		
		header("Location:".config::ruta()."?accion=addPagoContratos&id=".$_POST["idcontrato"]);

		}
		
		if(isset($_GET["e"])&&$_GET["e"]=="borrar"){
			
			
			$pago->borrar($_GET["id"]);
			
	header("Location:".config::ruta()."?accion=addPagoContratos&id=".$credito->getContrato($_GET["idcred"]));
			
			}
			
			
			
  if(isset($_POST["regVenta"])&& $_POST["regVenta"]=='regVenta' && $_POST["tipocuota"]=='cc'){
	  
	  $idcontrato=$credito->getContrato($_POST["idcredito"]);
	  
	  $res=$kv->todosContratosDiferidos($idcontrato);
        
	  // $mumcuenta=$credito->getNumCuenta()+1;
	    $mumcuenta=$_POST["numcuenta"];
        //$nc->credito_idcredito=$_POST["idcredito"];
        //$nc->nuevo();
       // $mumcuenta=NumCuenta::$lastId;

	    $pago->monto=$_POST["montoventa"];
		$pago->fecha=$_POST["fechaventa"];
		$pago->terminado=1;
		$pago->credito_idcredito=$_POST["idcredito"];
		$pago->tipo="PAGOTOTAL";
		$pago->nuevo();
		$lastID=pagosCuotaInicial::$lastId;
	if($_POST["tipodocventa"]=="RECIBO"){
		
		    $recibo->monto=$_POST["montoventa"];
			$recibo->fecha=$_POST["fechaventa"];
			$recibo->descripcion=$_POST["descripcionreciboventa"];
			$recibo->nombres=strtoupper($_POST["nombresreciboventa"]);
			$recibo->pagoscuotainicial_idcuota_inicial=$lastID;/// EL PROBLEMA--------------------------
			$recibo->numero=$_POST["numreciboventa"];
            $recibo->tipo="RECIBO";
			$recibo->nuevo();
	
  $credito->actualizarVenta($_POST["idcredito"],$mumcuenta,$_POST["numreciboventa"],$_POST["numreporterecibo"],$_POST["montoventa"],$_POST["fechaventa"],$_POST["idcobrador"],$_POST["tipodocventa"]);
	}
	
	if($_POST["tipodocventa"]=="FACTURA"){
	        $recibo->fecha=$_POST["fechaventa"];
			$recibo->monto=$_POST["montoventa"];
			$recibo->nombres=strtoupper($_POST["nombresfacturaventa"]);
			$recibo->cinit=$_POST["carnetfacturaventa"];
			$recibo->descripcion=strtoupper($_POST["descripcionfacturaventa"]);
			$recibo->pagoscuotainicial_idcuota_inicial=$lastID;
			$recibo->numero=$_POST["numfacturaventa"];
            $recibo->tipo="FACTURA";
			$recibo->nuevo();
  $credito->actualizarVenta($_POST["idcredito"],$mumcuenta,$_POST["numfacturaventa"],$_POST["numreportefactura"],$_POST["montoventa"],$_POST["fechaventa"],$_POST["idcobrador"],$_POST["tipodocventa"]);
	}
	
	foreach($res as $v){
		 
        		 $kv->actualizarEstadoVenta($v["idkardexvendedor"],$mumcuenta,$idcontrato);
		

           }
		   
		   $contrato->updateEstado($idcontrato,"VENTA");
		   $credito->updateEstado($_POST["idcredito"],"C");

           $contra= $credito->getContratosId($idcontrato);
     
          $array_cuotas = Helpers::planPagos($contra["fechadoc"], 0, $contra["numcuotas"] * 30, $contra["numcuotas"], $contra["saldo"]);


          foreach ($array_cuotas as $row2) {

              $cuota->fechavencimiento = $row2["fecha"];
              $cuota->numcuota = $row2["numcuota"];
              $cuota->monto = $row2["monto"];
              $cuota->credito_idcredito =$_POST["idcredito"] ;
              $cuota->estado = 1;
              $cuota->sw = 1;
              $cuota->nuevo();


     
      }

		   
		header("Location:".config::ruta()."?accion=contratoVenta");
	  
	  
	  }			
	  
	  if(isset($_POST["regVenta"])&& $_POST["regVenta"]=='regVenta' && $_POST["tipocuota"]=='sc'){
	  
	  $idcontrato=$credito->getContrato($_POST["idcredito"]);
	  $res=$kv->todosContratosDiferidos($idcontrato);
      $mumcuenta=$credito->getNumCuenta()+1;
	//$mumcuenta=$_POST["numcuenta"];
	  $credito->actualizarVenta($_POST["idcredito"],$mumcuenta,"000000","000000","0",$_POST["fechaventa"],$_POST["idcobrador"],$_POST["tipodocventa"]);
	
	
	foreach($res as $v){
		 
        		 $kv->actualizarEstadoVenta($v["idkardexvendedor"],$mumcuenta,$idcontrato);
		

           }
		   
		   $contrato->updateEstado($idcontrato,"VENTA");
		   $credito->updateEstado($_POST["idcredito"],"C");
		   
		  header("Location:".config::ruta()."?accion=contratoVenta");
	  
	  
	  }			
require_once("view/addPagoContrato.php");


?>