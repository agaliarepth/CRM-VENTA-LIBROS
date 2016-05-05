<?php 
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");


$kv=new kardexVendedor();
$v=new Vendedores();


if(isset($_GET["iv"])&&($_GET["iv"]!="")){
$res=$kv->todosCargos($_GET["iv"]);
$nombres= $v->getNombresVendedor($_GET["iv"]);

	require_once("view/verResumenCargos.php");
	
	}




?>