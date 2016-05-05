<?php 
require_once("model/remisionModel.php");
require_once("model/detalle_remisionModel.php");
$re=new Remision();
$det=new detalleRemision();
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verRemision.php");

}
if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
require_once("view/verRemision.php");

}

?>