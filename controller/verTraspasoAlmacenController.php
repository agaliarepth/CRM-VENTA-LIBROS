<?php 
require_once("model/traspasoAlmacenModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");
require_once("model/almacenesModel.php");



$t=new TraspasoAlmacen();
$det=new detalleTraspasoAlmacen();
$al=new Almacen();

if(isset($_GET["id"])){
$res=$t->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verTraspasoAlmacen.php");

}


?>