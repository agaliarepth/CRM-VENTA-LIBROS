<?php 
require_once("model/pagosModel.php");
require_once("model/cuentasModel.php");
require_once("model/reciboModel.php");


$c=new Cuenta();
$p=new Pago();
$rescibo=new Recibos();

if(isset($_GET["id"])){
$res=$p->getPagosCuenta($_GET["id"]);
$res2=$c->getId($_GET["id"]);
require_once("view/pagos.php");
}

if(isset($_GET["e"])){
	$res=$p->getId($_GET["id"]);
	$res2=$c->getId($res["cuentas_idcuentas"]);
	
	
	$p->borrar($_GET["id"]);
	header("location:".config::ruta()."?accion=historialpagos&id=".$res2["idcuentas"]);
	
	
	}

?>