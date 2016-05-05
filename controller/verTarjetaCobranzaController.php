<?php
require_once("model/cuentasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/pagosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoModel.php");
require_once("model/referenciasModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");


$cuota=new Cuotas();
$cobrador=new Cobrador();
$p=new Pago();
$det=new detalleContrato();
$c=new Contrato();
$cu=new Cuenta();
$credito=new Credito();
$referencia=new Referencias();
$vendedor=new Vendedores();
if(isset($_GET["id"])){
    $res4=$p->getPagosCuenta($_GET["id"]);
$res=$credito->getCreditoContratoId($_GET["id"]);
    $ref=$referencia->getReferenciaPorCredito($_GET["id"]);

$res3=$det->getDetalle($res["idcontratos"]);
    $cuenta=$cu->getIdCredito($_GET["id"]);
require_once("view/verTarjetaCobranza.php");

}





?>
