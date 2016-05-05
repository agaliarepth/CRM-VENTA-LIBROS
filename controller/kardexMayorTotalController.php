<?php 
require_once("model/kardexMayorModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/librosModel.php");

$det1=new detalleIngreso();
$det2=new detalleEgreso();
$li=new Libros();
$km=new kardexMayor();
$c=new Contrato();
$det=new detalleContrato();

if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"]; $anio2=$_POST["anio"];
	$mes2=$_POST["mes"];
	$sum2=0;
	$ini=0;
	
	$fecha=$anio."-".$mes."-31";
	if($mes==1){
	$anio2=$anio2-1;
	$fecha2=$anio2."-"."12"."-31";
	
	}
	else{
	$mes2=$mes2-1;
	$fecha2=$anio2."-".$mes2."-31";
		
		}
		$res=$km->kardexMayorTotal($_POST["mes"],$_POST["anio"]);

		$sv=0;
		$res3=$c->kardexMayorTotal($_POST["mes"],$_POST["anio"]);

	
	
	
	
	}
require_once("view/kardexMayorTotal.php");
?>