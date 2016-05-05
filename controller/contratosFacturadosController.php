<?php 
require_once("model/contratosModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/cobradoresModel.php");
require_once("model/vendedoresModel.php");





$c=new Contrato();
$det=new detalleContrato();
$kv=new kardexVendedor();
$vendedor=new Vendedores();
$cobrador=new Cobrador();


$res=$c->listarTodosVentas2();
require_once("view/contratosFacturados.php");




?>