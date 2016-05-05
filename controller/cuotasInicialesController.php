<?php
require_once("helpers/Helpers.php");
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/pagocuotainicialModel.php");




$contrato=new Contrato();
$credito=new Credito();
$cobrador= new Cobrador();
$vendedor=new Vendedores();
$pc=new  pagosCuotaInicial();
if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"){

	$listaCuotas=$contrato->listarDiferidosRango($_POST["fecha_ini"] ,$_POST["fecha_fin"]);


	}



require_once("view/cuotasIniciales.php");


?>
