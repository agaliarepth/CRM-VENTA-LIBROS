<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");




if(isset($_GET["id"])&& $_GET["id"]!=""){
$c=new Contrato();
$res=$c->getId($_GET["id"]);
require_once("view/regVentaContrato.php");
}

if(isset($_POST["regVenta"])&&$_POST["regVenta"]=="regVenta"){
	
	$c=new Contrato();
	$det=new detalleContrato();
	$kv=new kardexVendedor();
	
		$res=$kv->todosContratosDiferidos($_POST["idcontrato"]);

	$mumcuenta=$c->getNumCuenta()+1;
	
  $c->actualizarVenta($_POST["idcontrato"],$mumcuenta,$_POST["numrecibo"],$_POST["numreporte"],$_POST["montorecibo"],$_POST["fecharecibo"],$_POST["idcobrador"],$_POST["nombrecobrador"],$_POST["cicobrador"]);
	
	
	foreach($res as $v){
		 
        		 $kv->actualizarEstadoVenta($v["idkardexvendedor"],$mumcuenta,$_POST["idcontrato"]);
		

           }
		   
		   
		   header("Location:".config::ruta()."?accion=contratoVenta");
	}




?>