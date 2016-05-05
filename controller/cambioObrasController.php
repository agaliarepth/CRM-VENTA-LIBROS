<?php 
require_once("helpers/Helpers.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");

require_once("model/cuentasModel.php");
require_once("model/cuotasModel.php");
require_once("model/almacenesModel.php");
require_once("model/detalleCambioObraModel.php");
require_once("model/creditoModel.php");
require_once("model/cambioObrasModel.php");
require_once("model/pagosModel.php");





$cuentas=new Cuenta();
$cuota=new Cuotas();
$cambio=new CambioObra();
$de=new detalleCambioObra();
$almacen=new Almacen();
$credito=new Credito();
$detalle= new detalleContrato();
$pago=new Pago();




if(isset($_POST["consulta"]) && $_POST["consulta"]=='consulta'){
	
	$res=$credito->getCreditoContratoId($_POST["idcuenta"]);

    $res2=$detalle->getDetalle($res["idcontratos"]);
    $sumPagos=$pago->sumPagosCredito($_POST["idcuenta"]);

    $listaAlmacenes=$almacen->autocompletar();
	}
	if(isset($_GET["idcuenta"]) ){

        $res=$credito->getCreditoContratoId($_POST["idcuenta"]);
        $res2=$detalle->getDetalle($res["idcontratos"]);
	
	
	}


if(isset($_POST["guardar"]) && $_POST["guardar"]=='guardar'){
	
	//print_r($_POST);
	
	$cambio->fecha=$_POST["fecha"];
	$cambio->estado='SIN ENVIAR';
	$cambio->credito_idcredito=$_POST["idcuentas"];
	$cambio->terminado=0;
	$cambio->saldo=$_POST["saldofin"];
	$cambio->nuevo();
    $lastID=CambioObra::$lastId;

	 for($i=0; $i<$_POST["num_filas"];$i++){
		 
		 
		
		
			  
		 $de->idlibro=$_POST["idlibro"][$i];
		 $de->cant=$_POST["cantidad"][$i];
		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->tipo=$_POST["tipo"][$i];
		 $de->cambioObra_idcambioObra=$lastID;
		 $de->insertar();
		 
	 }

	     $de->nuevo();
		 
		 	for($i=0; $i<$_POST["numfilascuotas"];$i++){
				
				$cuota->monto=$_POST["montocuota"][$i];
				$cuota->fechavencimiento=$_POST["fechacuota"][$i];
				$cuota->credito_idcredito=$_POST["idcuentas"];
				$cuota->numcuota=$_POST["numcuota"][$i];
				$cuota->estado=0;
                $cuota->sw=0;
				$cuota->nuevo();
				
				
				
				
				}
        header("Location:".config::ruta()."?accion=listarCambioObras");

	
	}

require_once("view/cambioObras.php");




?>