<?php
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");




$vendedor=new Vendedores();
$cobrador=new Cobrador();
$c=new Contrato();
$det=new detalleContrato();
$kv=new kardexVendedor();
$f=getdate();
$res=$c->listarBajaMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
	if($_POST["filtro"]=="MES") {
        $res = $c->listarBajaMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
        $res = $c->listarBajaRango($_POST["fechainicio"],$_POST["fechafin"]);
	}
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $c->listarBajaRango("2013-01-01",$_POST["fechaacumulado"]);

    }
}
require_once("view/contratosBaja.php");



if(isset($_GET["ic"]) && isset($_GET["e"]) && $_GET["e"]=="bc")
{
	$res=$kv->todosContratosDiferidos($_GET["ic"]);


	foreach($res as $v){
		$kv->eliminadoDiferido($v["idkardexvendedor"]);
		                }
    $c->borrar($_GET["ic"]);
header("Location:".config::ruta()."?accion=contratos");
}

?>
