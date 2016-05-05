<?php 
require_once("model/notasIngresoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/almacenesModel.php");
$re=new notaIngreso();
$det=new detalleIngreso();
$al=new Almacen();

if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
require_once("view/verIngreso.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
require_once("view/verIngreso.php");

}
?>