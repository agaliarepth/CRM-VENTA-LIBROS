<?php
require_once("helpers/Helpers.php");
require_once("model/contratosModel.php");
require_once("model/PagosModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoModel.php");

$pagos=new Pago();
$cuotas=new Cuotas();
$credito=new Credito();

if((isset($_POST["consulta"]) && $_POST["consulta"]=='consulta')||(isset($_GET["consulta"]) && $_GET["consulta"]=='consulta')){

    $res=$credito->getCreditoContratoId($_REQUEST["idcredito"]);
    $res2=$cuotas->getIdCuentasActivas($_REQUEST["idcredito"]);

}
if(isset($_GET["idcredito"]) ){

    $res=$credito->getCreditoContratoId($_GET["idcredito"]);
    $res2=$cuotas->getIdCuentas($_GET["idcredito"]);

}
if(isset($_POST)&& isset($_POST["numfilas"])){


    for($i=0; $i<$_POST["numfilas"];$i++){
        if($_POST["sw"][$i]==0) {
           $cuotas->updateEstadoCuota($_POST["id"][$i],0,0);

        }
        if($_POST["sw"][$i]==2) {
            $cuotas->monto = $_POST["monto"][$i];
            $cuotas->fechavencimiento = $_POST["fechavencimiento"][$i];
            $cuotas->numcuota = $_POST["numcuota"][$i];
            $cuotas->estado = 1;
            $cuotas->sw = 1;
            $cuotas->credito_idcredito = $_POST["idcreditos"];
            $cuotas->nuevo();
        }
        if($_POST["sw"][$i]==3) {
            $cuotas->monto = $_POST["monto"][$i];
            $cuotas->fechavencimiento = $_POST["fechavencimiento"][$i];
            $cuotas->numcuota = $_POST["numcuota"][$i];
            $cuotas->estado = 1;
            $cuotas->sw = 1;
            $cuotas->credito_idcredito = $_POST["idcreditos"];
            $cuotas->actualizar( $_POST["id"][$i]);


        }

    }


//print_r($_POST);

	header("location:".config::ruta()."?accion=refinanciamiento");
}

require_once("view/refinanciamiento.php");




?>