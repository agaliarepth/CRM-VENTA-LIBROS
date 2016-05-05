<?php 

require_once("model/devolucionObrasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/cuotasModel.php"); 
require_once("model/creditoModel.php");

$det=new detalleDevolucionObras();
$c=new Contrato();
$dev=new devolucionObras();
$cuota=new Cuotas();
$credito=new Credito();
$f=getdate();
$res=$dev->listarTodosCobranzasMes($f["mon"],$f["year"]);

if(isset($_POST["devolucionObras"])){
	
    $res=$dev->listarTodosCobranzasMes($_POST["mes"], $_POST["anio"]);

}


if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="ae"){
	
	
	$res=$dev->updateEstado($_GET["id"],"enviado");
	header("location:".config::ruta()."?accion=devolucionVentasCobranza");
	
	
	}
	
	

if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="bc"){
	
	
	
	 $res=$dev->getId($_GET["id"]);
     $res2=$credito->getPorNumCuenta($res["num_cuenta"]);
     
     $cuota->borrarPorEstado($res2["idcredito"],1,1);
     $cuota->updateEstado($res2["idcredito"],1,1,0,0);


	$dev->borrar($_GET["id"]);
	
		header("location:".config::ruta()."?accion=devolucionVentasCobranza");

	}

require_once("view/devolucionVentasCobranza.php");

?>