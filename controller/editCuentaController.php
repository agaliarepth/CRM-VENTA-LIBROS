<?php
require_once("model/cuentasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detallecuentaModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");
require_once("model/referenciasModel.php");
require_once("model/creditoModel.php");
require_once("model/cuotasModel.php");
require_once("model/pagosModel.php");



$credito=new Credito();
$cuota=new Cuotas();
$ref=new Referencias();
$det=new detalleContrato();
$c=new Contrato();
$cu=new Cuenta();
$det2=new detalleCuenta();
$cobrador=new Cobrador();
$vendedor=new Vendedores();
$pago=new Pago();
if(isset($_GET["id"])){
    $res=$credito->getCreditoContratoId($_GET["id"]);
    $res2=$det->getDetalle($_GET["id"]);
     $sumPagos=$pago->sumPagosCredito($_GET["id"]);
    $swc=0;
    $swr=0;
    if($cu->getCreditoCuenta($_GET["id"])>0) {
        $swc = 1;
        $cred=$cu->getIdCredito($_GET["id"]);

    }
    if($ref->getReferenciaCredito($_GET["id"])>0){
        $swr = 1;
        $referencia=$ref->getCredito($_GET["id"]);
    }

    require_once("view/editCuenta.php");
}

if(isset($_POST["enviarCuenta"])&& $_POST["enviarCuenta"]=="enviarCuenta"){


    $cu->verificador=$_POST["verificador"];
    $cu->transferencia=$_POST["transferencia"];
    $cu->gc=$_POST["gc"];
    $cu->sup=$_POST["sup"];
    $cu->obs=$_POST["obs"];
    $cu->credito_idcredito=$_POST["idcredito"];

    $ref->zona=$_POST["zona"];
    $ref->barrio=$_POST["barrio"];
    $ref->direccion=$_POST["dir"];
    $ref->telf=$_POST["telf"];
    $ref->lugarcobranza=$_POST["lugar"];
    $ref->diacobrar=$_POST["diacobranza"];
    $ref->credito_idcredito=$_POST["idcredito"];



    if($cu->getCreditoCuenta($_POST["idcredito"])>0) {
        $cu->actualizar($_POST["idcuenta"]);
    }
    else{

        $cu->nuevo();
    }
    if($ref->getReferenciaCredito($_POST["idcredito"])>0){

      $ref->actualizar($_POST["idref"]);
    }
    else{

        $ref->nuevo();
    }

     header("location:".config::ruta()."?accion=cuentas");
    }
    else
    {

        header("Location:".config::ruta()."?accion=error&m=3");

    }

