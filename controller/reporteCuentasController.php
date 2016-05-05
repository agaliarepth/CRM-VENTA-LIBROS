<?php 
require_once("model/cobradoresModel.php");
require_once("model/cuentasModel.php");
require_once("model/contratosModel.php");
require_once("model/pagosModel.php");
require_once("helpers/Helpers.php");
require_once("model/devolucionObrasModel.php");

$co=new Cobrador();
$cu=new Cuenta();
$c=new Contrato();
$p=new Pago();
$dev =new devolucionObras();
if(isset($_GET['tipo'])&&$_GET['tipo']=="estadoCancelacion"){
	
	$res2=$co->listarTodos();
	if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta")
{
	$fecha=$_POST["anio"]."-".$_POST["mes"]."-"."31";
	$mes=$_POST["mes"];
	$anio=$_POST["anio"];
	if($_POST["filtro"]=="todos"){
		$res=$cu->getCuentasCanceladasTodos($mes,$anio,$_POST["orden"]);
		
		}
		else
 $res=$cu->getCuentasCanceladasCobrador($mes,$anio,$_POST["filtro"],$_POST["orden"]);
}
	require_once("view/estadoCancelacion.php");
	
	}
	
	
	
	
	if(isset($_GET['tipo'])&&$_GET['tipo']=="cuentasNuevasCobradas"){
	
	$res2=$co->listarTodos();
	if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta")
{
	$fecha=$_POST["anio"]."-".$_POST["mes"]."-"."31";
	$mes=$_POST["mes"];
	$anio=$_POST["anio"];
	if($_POST["filtro"]=="todos"){
		$res=$p->cuentasNuevasCobradas($mes,$anio);
	}
	else
	$res=$p->cuentasNuevasCobradasCobrador($mes,$anio,$_POST["filtro"]);
		
	
}
	require_once("view/cuentasNuevasCobradas.php");
	
	}




if(isset($_GET['tipo'])&&$_GET['tipo']=="devoluciones"){
	
	$res2=$co->listarTodos();
	if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta")
{
	$fecha=$_POST["anio"]."-".$_POST["mes"]."-"."31";
	$mes=$_POST["mes"];
	$anio=$_POST["anio"];
	if($_POST["filtro"]=="todos"){
		
		if($_POST["tipoDevolucion"]=="DEVOLUCION TOTAL")
		$res=$dev->getDevolucionesCuenta($mes,$anio,$_POST['orden'],"DEVOLUCION TOTAL");
		if($_POST["tipoDevolucion"]=="DEVOLUCION PARCIAL" )
		$res=$dev->getDevolucionesCuenta($mes,$anio,$_POST['orden'],"DEVOLUCION PARCIAL");
	}
	
	else{
	 if($_POST["tipoDevolucion"]=="DEVOLUCION TOTAL")
	$res=$dev->getDevolucionesCuentaCobrador($mes,$anio,$_POST['orden'], $_POST['filtro'],"DEVOLUCION TOTAL");
		 if($_POST["tipoDevolucion"]=="DEVOLUCION PARCIAL")
	$res=$dev->getDevolucionesCuentaCobrador($mes,$anio,$_POST['orden'], $_POST['filtro'],"DEVOLUCION PARCIAL");
	}
		
	
	}
	require_once("view/devolucionCuentas.php");
}



if(isset($_GET['tipo'])&&$_GET['tipo']=="reporteDevolucion"){
	require_once("view/reports/reporteDevolcioncuentas.php");
	
	}
	
	if(isset($_GET['tipo'])&&$_GET['tipo']=="reporteCuentasCanceladas"){
	require_once("view/reports/reporteCuentasCanceladas.php");
	
	}
	
	if(isset($_GET['tipo'])&&$_GET['tipo']=="nuevasCuentasCobradas"){
	require_once("view/reports/nuevasCuentasCobradas.php");
	
	}
	
?>