<?php 
require_once("model/notasIngresoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/almacenesModel.php");

$ni=new notaIngreso();
$det=new detalleIngreso();
$al=new Almacen();

$res2=$al->autocompletar();
if(isset($_POST["consulta"])&&($_POST["consulta"]=="reporteIngreso")){
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$cad=explode("/",$_POST["almacenes"]);
	$nom=$cad[1];
	if($_POST["concepto"]=="todos"){
		$res=$det->reportePorMesTodosPaginado($_POST["orden"],$mes,$anio,$cad[0],1);
		$cont=$det->reportePorMesTodos($_POST["orden"],$mes,$anio,$cad[0]);
		
		}
		else{
	$res=$det->reportePorMesPaginado($_POST["orden"],$mes,$anio,$cad[0],$_POST["concepto"],1);
		$cont=$det->reportePorMes($_POST["orden"],$mes,$anio,$cad[0],$_POST["concepto"]);

		}
	
	
	}
	

if(isset($_GET["pag"])){
	$nom=$_GET["nom"];
	$mes=$_GET["mes"];
	$anio=$_GET["anio"];
	if($_GET["concepto"]=="todos"){
		$cont=$det->reportePorMesTodos($_GET["orden"],$_GET["mes"],$_GET["anio"],$_GET["id"]);
		$res=$det->reportePorMesTodosPaginado($_GET["orden"],$_GET["mes"],$_GET["anio"],$_GET["id"],$_GET["pag"]);
		
		}
		else{
	$cont=$det->reportePorMes($_GET["orden"],$_GET["mes"],$_GET["anio"],$_GET["id"],$_GET["concepto"]);
		$res=$det->reportePorMesPaginado($_GET["orden"],$_GET["mes"],$_GET["anio"],$_GET["id"],$_GET["concepto"],$_GET["pag"]);

		}
	
	
	}

require_once("view/reporteIngreso.php");



?>