<?php

require_once("model/stockModel.php");
require_once("model/almacenesModel.php");
$al=new Almacen();

$st=new Stock();
$res=$st->listarTodos();
require_once("view/historialStock.php");

if(isset($_GET["id"])){
	$st->borrar($_GET["id"]);
	header("location:".config::ruta()."?accion=historialStock");
	
	}
 ?>