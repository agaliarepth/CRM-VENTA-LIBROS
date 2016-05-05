<?php 

require_once("model/cambioObrasModel.php");
require_once("model/detalleCambioObraModel.php");
require_once("model/librosModel.php");
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");



$detCambio=new detalleCambioObra();
$l=new Libros();
$c=new CambioObra();
$credito=new Credito();
$cobrador=new Cobrador();
$vendedor=new Vendedores();

$res=$c->getId($_GET["id"]);
$res2=$credito->getCreditoContratoId($res["credito_idcredito"]);

$listaIngreso=$detCambio->getDetalleIngreso($_GET["id"]);
$listaEgreso=$detCambio->getDetalleEgreso($_GET["id"]);

require_once("view/verCambioObra.php");


?>