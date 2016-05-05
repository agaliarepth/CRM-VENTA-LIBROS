<?php 
require_once("model/contratosModel.php");
require_once("model/cuentasModel.php");


$c=new Cuenta();



$res=$c->cuentasSinEnviar();
require_once("view/cuentasNuevas.php");

if(isset($_GET["e"])&& $_GET["e"]=="bc"){
	
	$c->borrar($_GET["ic"]);
		header("location:".config::ruta()."?accion=cuentasNuevas");

	
	}
	
	if(isset($_GET["estado"])&& $_GET["estado"]=="aprobar"){
		
		$c->aprobarCuenta($_GET["id"]);
		header("location:".config::ruta()."?accion=cuentas");
		
		}


?>