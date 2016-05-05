<?php 
require_once("model/cobradoresModel.php");
require_once("model/contratosModel.php");
require_once("model/pagosModel.php");
require_once("helpers/Helpers.php");
require_once("model/VendedoresModel.php");
require_once("model/creditoModel.php");
require_once("model/referenciasModel.php");




$cobrador=new Cobrador();
$ve=new Vendedores();
$credito=new Credito();
$c=new Contrato();
$p=new Pago();
$ref=new Referencias();
if(isset($_POST["consulta"])&&$_POST["consulta"]="consulta")
{
	$fecha=$_POST["anio"]."-".$_POST["mes"]."-"."31";
	$fecha1=$_POST["anio"]."-".$_POST["mes"]."-"."1";
	$mes=$_POST["mes"];
	$anio=$_POST["anio"];
 $res=$credito->cuentasPorCobrador2($_POST["id"],$fecha1);
 require_once("view/asignaciones.php");
}



if(isset($_POST["asignaciones"])&&$_POST["asignaciones"]=="asignaciones")
{
	require_once("view/reports/asignaciones.php");
	
	
}
if($_GET["accion"]=="asignaciones"){
 require_once("view/asignaciones.php");
}

?>