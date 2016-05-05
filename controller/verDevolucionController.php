<?php 
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/almacenesModel.php");
require_once("model/contratosModel.php");
require_once("model/vendedoresModel.php");


$re=new Devolucion();
$det=new detalleDevolucion();
$al=new Almacen();
$cont=new Contrato();
$vendedor=new Vendedores();
if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
$c=$cont->getPorContrato($res["numcontrato"]);
$ven=$vendedor->getNombresVendedor($c["idchofer"]);
require_once("view/verDevolucion.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);

$c=$cont->getPorContrato($res["numcontrato"]);
$ven=$vendedor->getNombresVendedor($c["idchofer"]);
    require_once("view/verDevolucion.php");

}
?>