<?php 
require_once("model/cierresModel.php");

$c=new Cierres();
$res=$c->listarTodos();

if(isset($_POST["guardar"])&&$_POST["guardar"]=="guardar"){
	
	$c->mes=$_POST["mes"];
	$c->anio=$_POST["anio"];
	$c->llave=0;
	$c->modulo=$_POST["modulo"];
	$c->nuevo();
		header("Location:".config::ruta()."?accion=cierres");

	}
	
	if(isset($_GET["e"])&&$_GET["e"]=="a"){
		
		$c->updateEstado($_GET["id"],1);
		header("Location:".config::ruta()."?accion=cierres");
		
		}
		
			if(isset($_GET["e"])&&$_GET["e"]=="c"){
		
		$c->updateEstado($_GET["id"],0);
		header("Location:".config::ruta()."?accion=cierres");
		
		}
		
require_once("view/cierres.php");


?>