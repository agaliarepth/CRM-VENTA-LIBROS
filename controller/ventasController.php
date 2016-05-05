<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/librosModel.php");
require_once("model/recibosCuotasModel.php");



$c=new Contrato();
$det=new detalleContrato();
$cobra=new Cobrador();
$ven=new Vendedores();
$libro=new Libros();
$recibo=new RecibosCuotas();

if(isset($_POST["consulta"])&&($_POST["consulta"]=="consulta")){
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$tipo=$_POST["tipo"];
	$orden=$_POST["orden"];


	if($_POST["filtro"]=="MES"&& $_POST["tipo"]=="CREDITO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
	$res=$c->getContratosVendidosFechaCredito($mes,$anio,$orden);
	if($_POST["filtro"]=="MES"&& $_POST["tipo"]=="DIFERIDO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
	$res=$c->getContratosDiferidosFecha($mes,$anio,$orden);
	if($_POST["filtro"]=="MES"&& $_POST["tipo"]=="CONTADO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
	$res=$c->getContratosVendidosFechaContado($mes,$anio,$orden);
	if($_POST["filtro"]=="MES"&& $_POST["tipo"]=="CONTCRED" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
	$res=$c->getContratosVendidosFechaContCred($mes,$anio,$orden);

    if($_POST["filtro"]=="RANGO"&& $_POST["tipo"]=="CREDITO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaCreditoRango($_POST["fechainicio"],$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="RANGO"&& $_POST["tipo"]=="DIFERIDO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosDiferidosFechaRango($_POST["fechainicio"],$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="RANGO"&& $_POST["tipo"]=="CONTADO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaContadoRango($_POST["fechainicio"],$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="RANGO"&& $_POST["tipo"]=="CONTCRED" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaContCredRango($_POST["fechainicio"],$_POST["fechafin"],$orden);


    if($_POST["filtro"]=="ACUMULADO"&& $_POST["tipo"]=="CREDITO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaCreditoRango("2013-01-01",$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="ACUMULADO"&& $_POST["tipo"]=="DIFERIDO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosDiferidosFechaRango("2013-01-01",$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="ACUMULADO"&& $_POST["tipo"]=="CONTADO" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaContadoRango("2013-01-01",$_POST["fechafin"],$orden);
    if($_POST["filtro"]=="ACUMULADO"&& $_POST["tipo"]=="CONTCRED" && $_POST["cobrador"]==""&&$_POST["vendedor"]=="")
        $res=$c->getContratosVendidosFechaContCredRango("2013-01-01",$_POST["fechafin"],$orden);









	
	if($_POST["tipo"]=="CREDITO"&&$_POST["cobrador"]!=""&&$_POST["vendedor"]=="")
	$res=$c->getContratosCreditoCobrador($mes,$anio,$orden,$_POST["cobrador"]);
	
	if($_POST["tipo"]=="CREDITO"&&$_POST["cobrador"]==""&&$_POST["vendedor"]!="")
	$res=$c->getContratosCreditoVendedor($mes,$anio,$orden,$_POST["vendedor"]);
	
	if($_POST["tipo"]=="DIFERIDO"&&$_POST["cobrador"]!=""&&$_POST["vendedor"]=="")
	$res=$c->getContratosDiferidosCobrador($mes,$anio,$orden,$_POST["cobrador"]);
	
	if($_POST["tipo"]=="DIFERIDO"&&$_POST["cobrador"]==""&&$_POST["vendedor"]!="")
	$res=$c->getContratosDiferidosVendedor($mes,$anio,$orden,$_POST["vendedor"]);
	
	if($_POST["tipo"]=="CONTADO"&&$_POST["cobrador"]!=""&&$_POST["vendedor"]=="")
	$res=$c->getContratosContadoCobrador($mes,$anio,$orden,$_POST["cobrador"]);
	
	if($_POST["tipo"]=="CONTADO"&&$_POST["cobrador"]==""&&$_POST["vendedor"]!="")
	$res=$c->getContratosContadoVendedor($mes,$anio,$orden,$_POST["vendedor"]);
	
	
	if($_POST["tipo"]=="CONTCRED"&&$_POST["cobrador"]!=""&&$_POST["vendedor"]=="")
	$res=$c->getContratosVendidosFechaContCredCobrador($mes,$anio,$_POST["cobrador"],$orden);
	
	if($_POST["tipo"]=="CONTCRED"&&$_POST["cobrador"]==""&&$_POST["vendedor"]!="")
	$res=$c->getContratosVendidosFechaContCredVendedor($mes,$anio,$_POST["vendedor"],$orden);
	
	}
	
	if(isset($_POST["consulta2"])&&($_POST["consulta2"]=="consulta2")){
		
		$fecha="".$_POST["anio2"]."-".$_POST["mes2"]."-1";
	$mes=$_POST["mes2"]; $anio=$_POST["anio2"];
	$tipo=$_POST["tipo2"];
	$orden=$_POST["orden2"];
	if($_POST["tipo2"]=="VENTA")
	$res=$det->ReporteVenta($_POST["libro"],$mes,$anio);
	if($_POST["tipo2"]=="DIFERIDO")
	$res=$det->ReporteDiferido($_POST["libro"],$mes,$anio);
	
	
		
		}

$res3=$cobra->listarTodos();
	$res4=$ven->listarTodos();
	

require_once("view/ventas.php");



?>