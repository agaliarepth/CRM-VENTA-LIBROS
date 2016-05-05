<?php
require_once("helpers/Helpers.php");
require_once("model/contratosModel.php");
require_once("model/creditoModel.php");
require_once("model/PagosModel.php");
require_once("model/cuotasModel.php");
require_once("model/cuotas_has_pagosModel.php");
require_once("model/cobradoresModel.php");
require_once("model/devolucionObrasModel.php");




$credito=new Credito();
$cobrador=new Cobrador();
$pagos=new Pago();
$cuotas=new Cuotas();
$cuotasPagos=new CuotasPagos();
$devob=new devolucionObras();

if((isset($_POST["consulta"]) && $_POST["consulta"]=='consulta')||(isset($_GET["consulta"]) && $_GET["consulta"]=='consulta')){

	$res=$credito-> getCreditoContratoId($_REQUEST["idcuenta"]);
	$res2=$cuotas->getIdCuentasActivas($_REQUEST["idcuenta"]);

	}
	if(isset($_POST["envio"]) ){



$pagos->monto=$_POST["monto"];
$pagos->fecha=$_POST["fecha"];
$pagos->cliente=$_POST["cliente"];
$pagos->num_reporte=$_POST["num_reporte"];
$pagos->idcobrador=$_POST["idcobrador"];
$pagos->estado="Enviado";
$pagos->numrecibo=$_POST["numrecibo"];
$pagos->terminado=1;
$pagos->credito_idcredito=$_POST["credito_idcredito"];
$pagos->obs=$_POST["obs"];
$pagos->nuevo();
$lastID=Pago::$lastId;
for($f=0;$f<$_POST["numfilas"];$f++){
      if(isset($_POST["check"][$f])){
      $pos=$_POST["check"][$f];
            //  echo $pos;
  $cuotasPagos->cuotas_idcuotas=$_POST["idcuotas"][$f];
  $cuotasPagos->pagos_idpagos=$lastID;
  $cuotasPagos->monto=$_POST["montocuota"][$f];
  $cuotasPagos->nuevo();

}
	}

}

require_once("view/addPagos.php");




?>
