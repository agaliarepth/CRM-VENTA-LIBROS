<?php 
require_once("model/cuentasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detallecuentaModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
require_once("model/referenciasModel.php");
require_once("model/creditoModel.php");
require_once("model/cuotasModel.php");


$credito=new Credito();
$cuota=new Cuotas();
$ref=new Referencias();
$det=new detalleContrato();
$c=new Contrato();
$cu=new Cuenta();
$det2=new detalleCuenta();
$cobrador=new Cobrador();
$vendedor=new Vendedores();
if(isset($_GET["id"])){
$res=$c->getContratoId($_GET["id"]);
$cred=$credito->getPorContrato($_GET["id"]);
	
$res2=$det->getDetalle($_GET["id"]);
$referencia=$ref->getContrato($_GET["id"]);
require_once("view/addCuenta.php");}

if(isset($_POST["enviarCuenta"])&& $_POST["enviarCuenta"]=="enviarCuenta"){
	
	$cu->num_cuenta=$_POST["num_cuenta"];
	$cu->nombre_cliente=strtoupper($_POST["cliente"]);
	$cu->monto_total=$_POST["monto_total"];
	$cu->pago_inicial=$_POST["cuotainicial"];
	$cu->saldo=$_POST["saldo"];
	$cu->numero_cuotas=$_POST["numero_cuotas"];
	$cu->nombre_cobrador=$_POST["nombre_cobrador"];
	$cu->idcobrador=$_POST["idcobrador"];
	$cu->nombre_vendedor=$_POST["nombre_vendedor"];
	$cu->idvendedor=$_POST["idvendedor"];
	$cu->fecha_contrato=$_POST["fechaContrato"];
	$cu->idcontrato=$_POST["idcontrato"];
	$cu->numcontrato=$_POST["num_contrato"];
	$cu->estado="";
	$cu->fecha_creacion=$_POST["fecha"];
	$cu->ci_cliente=$_POST["ci_cliente"];
	$cu->verificador=$_POST["verificador"];
	$cu->transferencia=$_POST["transferencia"];
	$cu->gc=$_POST["gc"];
	$cu->sup=$_POST["sup"];
	$cu->saldo_actual=$_POST["saldo"];
	$cu->porcentaje=0;
	$cu->zona=$_POST["zona"];
	$cu->barrio=$_POST["barrio"];
	$cu->dir=$_POST["dir"];
	$cu->telf=$_POST["telf"];
	$cu->lugar=$_POST["lugar"];
    $cu->diacobranza=$_POST["diacobranza"];
	$cu->cuotamensual=$_POST["cuotamensual"];
	$cu->obs=$_POST["obs"];
	if($cu->nuevo())
	{
	$last=Cuenta::$lastId;
	
	$res=$det->getDetalle($_POST["idcontrato"]);
	foreach($res as $v){
	$det2->cantidad=$v["cantidad"];
	$det2->codigo=$v["codigo"];
	$det2->titulo=$v["titulo"];
	$det2->volumen=$v["volumen"];
	$det2->libros_idlibros=$v["libros_idlibros"];
	$det2->cuentas_idcuentas=$last;
	$det2->precio_unitario=$v["precio_unitario"];
	$det2->nuevo();
		
		
		
		}
		//print_r($_POST);
		 for($i=0; $i<$_POST["numfilascuotas"];$i++){
			  $cuota->fechavencimiento=$_POST["fechacuota"][$i];
			  $cuota->numcuota=$_POST["numcuota"][$i];
			  $cuota->monto=$_POST["montocuota"][$i];
			  $cuota->cuentas_idcuentas=$last;
			  $cuota->estado=1;
			  $cuota->sw=1;
			  $cuota->nuevo();
			
			  }
			  
		
	//$c->updateEstado($_POST["idcontrato"],"CUENTA");
	
	header("location:".config::ruta()."?accion=verTarjetaCobranza&id=".$last."&acc=volver");
	}
	else
	{
		
		header("Location:".config::ruta()."?accion=error&m=3");

		}
}
