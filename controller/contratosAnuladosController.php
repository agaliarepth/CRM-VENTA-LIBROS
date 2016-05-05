<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");



$c=new Contrato();
$det=new detalleContrato();
$kv=new kardexVendedor();

$cobrador=new Cobrador();
$vendedor=new Vendedores();
$cred=new Credito();
$f=getdate();
$res=$c->listarTodosAnuladosMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
    if($_POST["filtro"]=="MES") {
        $res = $c->listarTodosAnuladosMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
        $res = $c->listarTodosAnuladosRango($_POST["fechainicio"],$_POST["fechafin"]);
    }
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $c->listarTodosAnuladosRango("2013-01-01",$_POST["fechaacumulado"]);

    }
}
require_once("view/contratosAnulados.php");


?>