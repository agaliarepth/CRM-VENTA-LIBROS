<?php 
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");
require_once("model/remisionModel.php");



$k=new kardexVendedor();
$vendedor=new Vendedores();
$re=new Remision();

 if(isset($_GET["id"])&& $_GET["tipo"]=="remision"){


     $remision=$re->getId($_GET["id"]);
	$res=$k->verFilasKardexRemision($_GET["id"],$remision["vendedores_idVendedores"]);
	 
	 
	 }

if(isset($_GET["id"])&& $_GET["tipo"]=="devolucion"){
	$res=$k->verFilasKardexDevolucion($_GET["id"]);
	 
	 
	 }
	 
	 if(isset($_GET["id"])&& $_GET["tipo"]=="contrato"){
	$res=$k->verFilasKardexContrato($_GET["id"]);
	 
	 
	 }
if(isset($_GET["id"])&& $_GET["tipo"]=="traspaso"){
    $res=$k->verFilasKardexTraspaso($_GET["id"]);


}
require_once("view/verFilasKardex.php");

?>