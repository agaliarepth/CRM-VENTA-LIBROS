<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/referenciasModel.php");


$re=new  Contrato();
$det=new detalleContrato();
$credito=new Credito();
$vendedor=new Vendedores();
$cobrador=new Cobrador();
//$ref=new Referencias();
if(isset($_GET["id"])){
$res=$credito->getContratosId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
//$res3=$ref->getContrato($_GET["id"]);
require_once("view/verContrato.php");

}
if(isset($_POST["id"])){
$res=$credito->getContratosId($_GET["id"]);
$res2=$det->getDetalle($_POST["id"]);
require_once("view/verTraspaso.php");

}

?>