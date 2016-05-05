<?php 
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
$re=new notaPedido();
$det=new detalleNotaPedido();
if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
require_once("view/verRequerimiento.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verRequerimiento.php");

}
?>