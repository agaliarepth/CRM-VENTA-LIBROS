<?php
require_once("model/traspasoAlmacenModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");
require_once("model/almacenesModel.php");



$t=new TraspasoAlmacen();
$det=new detalleTraspasoAlmacen();




$res=$t->listartodos();
require_once("view/traspasoAlmacen.php");

if(isset($_GET["it"]) && isset($_GET["e"]) && $_GET["e"]=="bt")
{
	
	$t->borrar($_GET["it"]);

header("Location:".config::ruta()."?accion=traspasoVendedores");
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="anular"&&isset($_SESSION["modulo_almacenes"]))
{  

$t->updateEstado("ANULADO",1,$_GET["id"]);





header("Location:".config::ruta()."?accion=traspasoAlmacen");





	
	}






?>