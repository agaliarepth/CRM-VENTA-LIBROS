<?php
require_once("model/cobradoresModel.php");
require_once("model/cuentasModel.php");
require_once("model/pagosModel.php");
require_once("helpers/Helpers.php");

  $co=new Cobrador();
  $cu=new Cuenta();
  $pa=new Pago();
if(isset($_POST["consulta"])&&$_POST["consulta"]="consulta")
{
	$fecha=$_POST["anio"]."-".$_POST["mes"]."-"."31";
	$mes=$_POST["mes"];
	$anio=$_POST["anio"];
 $res=$co->listarTodos1($_POST["orden"]);
}
require_once("view/produccion.php");
if(isset($_GET["tipo"])&&$_GET["tipo"]=="reporteProduccion"){
	
	require_once("view/reports/reporteProduccion.php");
	}
?>