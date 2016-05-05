<?php 
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/almacenesModel.php");
$re=new Egreso();
$det=new detalleEgreso();
$al=new Almacen();

if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
require_once("view/verEgreso.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
require_once("view/verEgreso.php");

}
?>