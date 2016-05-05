<?php 
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");


$kv=new kardexVendedor();
$v=new Vendedores();

   
if(isset($_GET["iv"])&&($_GET["iv"]!="")){

$res2=$v->listarTodos();
$res3=$kv->verRemisionescolumna($_GET["mes"],$_GET["anio"]);

	require_once("view/verResumenCargosTabla.php");
	
	}




?>