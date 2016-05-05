<?php 

require_once("model/devolucionObrasModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/contratosModel.php");
require_once("model/creditoModel.php");
require_once("model/detalle_contratoModel.php");

$dev=new devolucionObras();
$cont=new Contrato();
$cred=new Credito();
$detcont=new detalleContrato();
$res=$dev->listarTodos("enviado");

if(isset($_GET["e"])&&$_GET["e"]=="rechazar"){
	

    $devob=$dev->getId($_GET["id"]);
    $contrato=$cont->getId($devob["idcontrato"]);
  if($devob["estado"]=="aprobado") {
      if ($devob["tipo_devolucion"] == "DEVOLUCION TOTAL") {

          $cont->updateEstado($contrato["idcontratos"], "DIFERIDO");

      }

      if ($devob["tipo_devolucion"] == "DEVOLUCION PARCIAL") {
          $idcont = $cont->getPorContrato($devob["num_contrato"]);
          $cont->updateEstado($idcont["idcontratos"], "DIFERIDO");
          $credito = $cred->getPorContrato($devob["idcontrato"]);
          //echo $devob["idcontrato"];
          //  $cred->borrarPorContrato($devob["idcontrato"]);
          $cred->reasignarContrato($credito["idcredito"], $idcont["idcontratos"]);

          $detcont->borrarPorContrato($devob["idcontrato"]);
          $cont->borrar($devob["idcontrato"]);


          $dev->updateEstado($_GET["id"], "sin enviar");
          $dev->updateContrato($_GET["id"], $idcont["idcontratos"]);
      }
  }
    else
    {
        $dev->updateEstado($_GET["id"], "sin enviar");
    }
       header("Location:".config::ruta()."?accion=devolucionObras");
	
	
	}

require_once("view/devolucionObras.php");



?>