<?php  
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/devolucionObrasModel.php");
require_once("model/cuotasModel.php"); 
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
require_once("model/pagosModel.php");






$c=new Contrato();
$det=new detalleContrato();
$dev=new devolucionObras();
$det2=new detalleDevolucionObras();
$cuota=new Cuotas();
$credito=new Credito();
$cobra=new Cobrador();
$vendedor=new Vendedores();
$pago=new Pago();




  if(isset($_POST["consulta"]) && $_POST["consulta"]=='consulta'){

  	$res=$credito->getCreditoContratoId($_POST["idcuenta"]);

    $res3=$det->getDetalle($res["idcontratos"]);

//$res4=$credito->getContratosId($_GET["id"]);
    $sumPagos=$pago->sumPagosCredito($_POST["idcuenta"]);

}


if(isset($_POST["enviarCuenta"]) && $_POST["enviarCuenta"]=="enviarCuenta")
{
	
	
	$dev->fecha=$_POST["fecha"];
	$dev->num_cuenta=$_POST["numcuenta"];
	$dev->num_contrato=$_POST["num_contrato"];
	$dev->cliente=$_POST["cliente"];
	$dev->cobrador=$_POST["cobrador"];
	$dev->vendedor=$_POST["vendedor"];
	$dev->coordinador=$_POST["coordinador"];
	$dev->supervisor=$_POST["supervisor"];
	$dev->gerente=$_POST["gerente"];
	$dev->estado="sin enviar";
	if($_POST["saldofin"]<=0){
		
			$dev->tipo_devolucion="DEVOLUCION TOTAL";
		}
	if($_POST["saldofin"]>0){
		
			$dev->tipo_devolucion="DEVOLUCION PARCIAL";
		}

	$dev->obs=$_POST["obs"];
	$dev->nombre_usuario=$_SESSION["nombres"];
	$dev->idcontrato=$_POST["idcontrato"];
	$dev->idingreso=0;
	$dev->monto_total=$_POST["totaldevo"];
	$dev->cuota_inicial=$_POST["cuotainicial"];
	$dev->saldo=$_POST["saldo"];
	$dev->pago_cuenta=0;
	$dev->procedencia="COBRANZAS";
	$dev->idvendedor=$_POST["idvendedor"];
	$dev->idcobrador=$_POST["idcobrador"];
    $dev->nuevo();
	$lastID=devolucionObras::$lastId;
	$pc=0;
    $de=new detalleDevolucionObras();
for($i=0; $i<$_POST["num_filas"];$i++){
		  if(isset($_POST["elegido"][$i])){
			  
			  $pos=$_POST["elegido"][$i];

		 $de->cantidad=$_POST["cantidad"][$pos];
		 $de->codigo=$_POST["codigo"][$pos];
		 $de->titulo=$_POST["titulo"][$pos];
		 $de->volumen=$_POST["tomo"][$pos];
     	 $de->precio_unitario=$_POST["precio_unit"][$pos];
		 $pc+=$_POST["cantidad"][$pos]*$_POST["precio_unit"][$pos];
		 $de->precio_total=$_POST["precio_total"][$pos];
		 $de->libros_idlibros=$_POST["idlibro"][$pos];
		 $de->idkardex=0;
		 $de->devolucionObras_iddevolucionObras=$lastID;
         $de->insertar();
		  }
       


		 }
		  $de->nuevo();
		 $dev->updatePagoCuenta($pc,$lastID);

		 if($_POST["saldofin"]>0){
            // $cuota->updateEstado($_POST["idcredito"],0,0,1,1);
			for($i=0; $i<$_POST["numfilascuotas"];$i++){
			    $cuota->monto=$_POST["montocuota"][$i];
				$cuota->fechavencimiento=$_POST["fechacuota"][$i];
				$cuota->numcuota=$_POST["numcuota"][$i];
				$cuota->estado=0;
                $cuota->sw=1;
                $cuota->credito_idcredito=$_POST["idcredito"];
				$cuota->nuevo ();
				}


	 
		}
		 
		header("Location:".config::ruta()."?accion=devolucionVentasCobranza");

}



	require_once("view/anularCuenta.php");



?>