<?php 

require_once("model/tipoCambioModel.php");
$tc=new tipoCambio();
$res=$tc->validar();
if($res==0){
	$tc->valor="6.96";
	$tc->fecha= date("Y-m-d H:i:s");
	$tc->nuevo();
	
	}
	$res2=$tc->recuperarUltimo();
	$res3=$tc->getId($res2);

if(isset ($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	$tc->valor=$_POST["valor"];
	$tc->fecha= date("Y-m-d H:i:s");
	$tc->nuevo();
	
	}
require_once("view/tipoCambio.php");


?>