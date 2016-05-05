<?php 
require_once("model/devolucionObrasModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/contratosModel.php");

$dev=new devolucionObras();
$det=new detalleDevolucionObras();
$c=new Contrato();

if(isset($_GET["id"])){
$res=$dev->getId($_GET["id"]);

$res2=$det->getDetalle($res["iddevolucionObras"]);
require_once("view/verDevolucionVenta.php");

}
?>