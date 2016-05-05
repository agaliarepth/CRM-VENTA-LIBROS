<?php 
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/almacenesModel.php");
require_once("model/vendedoresModel.php");

$nd=new Devolucion();
$det=new detalleDevolucion();
$al=new Almacen();
$vendedor=new Vendedores();

$res2=$al->autocompletar();
if(isset($_POST["consulta"])&&($_POST["consulta"]=="relacionNotasDevolucion")){
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$cad=explode("/",$_POST["almacenes"]);
	$nom=$cad[1];
	
	if($_POST["almacenes"]=="TODOS"){
		
		$res=$det->relacionNotasRemisionTodos($anio,$mes);
		
		}
	else{
		
		$res=$det->relacionNotasRemisionAlmacen($anio,$mes,$cad[0]);
		
		}
	
	


	
	
	}

require_once("view/relacionNotasDevolucion.php");



?>