<?php 
require_once("model/traspasosModel.php");
require_once("model/detalle_traspasosModel.php");
require_once("model/almacenesModel.php");
$al=new Almacen();
$re=new  Traspasos();
$det=new detalleTraspaso();
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verTraspaso.php");
//$nom=$al->getEncargado($res["idalmacenes"]);

}
if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
require_once("view/verTraspaso.php");
//$nom=$al->getEncargado($res["idalmacenes"]);

}

?>