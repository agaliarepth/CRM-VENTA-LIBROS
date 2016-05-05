<?php 
require_once("model/devolucionObrasModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/contratosModel.php");
require_once("model/vendedoresModel.php");

$dev=new devolucionObras();
$det=new detalleDevolucionObras();
$c=new Contrato();
$ven=new Vendedores();

if(isset($_GET["id"])){
$res=$dev->getId($_GET["id"]);
   $vendedorChofer=$c->getVendedorChofer($res["idcontrato"]);

$res2=$det->getDetalle($res["iddevolucionObras"]);
require_once("view/verDevolucionObras.php");

}
?>