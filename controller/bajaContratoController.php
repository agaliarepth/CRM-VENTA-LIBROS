<?php 
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/comisionesContratoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");



$kv=new kardexVendedor();

$c=new Contrato();


 $c->updateEstado($_GET["id"],"BAJA");
$contrato=$c->getId($_GET["id"]);
 if($contrato["idvendedor"]==$contrato["idchofer"]){
	 
	 $kv->actualizarEstadoRemitidoPorNumContrato($contrato["idchofer"],$contrato["numcontrato"]);
	 }
	 
	 else{
		 $kv->borrarRemisionPorVendedorContrato($contrato["idvendedor"],$contrato["numcontrato"]);
		  $kv->actualizarEstadoRemitidoPorNumContrato($contrato["idchofer"],$contrato["numcontrato"]);
		 
		 }
				
header("Location:".config::ruta()."?accion=contratos");

?>