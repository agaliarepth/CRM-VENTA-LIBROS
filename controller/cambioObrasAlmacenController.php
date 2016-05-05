<?php 

require_once("model/cambioObrasModel.php");
require_once("model/creditoModel.php");




$c=new CambioObra();
$credito=new Credito();


$res=$c->listarPorEstado("ALMACEN","1");


if(isset($_GET["e"])&&$_GET["e"]=="rechazar"){
	
	$c->updateEstado("SIN ENVIAR",1,$_GET["id"]);
	
	
	 header("Location:".config::ruta()."?accion=cambioObrasAlmacen");
	
	
	}

require_once("view/cambioObrasAlmacen.php");



?>