<?php 
require_once("model/remisionModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/almacenesModel.php");
require_once("model/vendedoresModel.php");

$nr=new Remision();
$det=new detalleRemision();
$al=new Almacen();
$vendedor=new Vendedores();

$res2=$al->autocompletar();
if(isset($_POST["consulta"])&&($_POST["consulta"]=="relacionNotasRemision")){
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	
	
	if($_POST["almacenes"]=="TODOS"){
		
		$res=$det->relacionNotasRemisionTodos($anio,$mes);
		
		}
	else{
		
		$res=$det->relacionNotasRemisionAlmacen($anio,$mes,$cad[0]);
		
		}
	
	


	
	
	}

require_once("view/relacionNotasRemision.php");



?>