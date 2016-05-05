<?php
require_once("model/contratosModel.php");
require_once("model/cuentasModel.php");
require_once("model/PagosModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoModel.php");
require_once("model/cobradoresModel.php");







$c=new Cuenta();
$credito=new Credito();
$p=new Pago();
$cuota=new Cuotas();
$cobrador=new Cobrador();
$f=getdate();

$res=$p->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["consulta"])){

	$res=$p->listarTodosMes($_POST["mes"],$_POST["anio"]);

	}
if(isset($_GET["id"])&&isset($_GET["e"])&& $_GET["e"]=="bp"){


	$p->borrar($_GET["id"]);
	  header("location:".config::ruta()."?accion=listaPagos");

	}

require_once("view/listaPagos.php");




?>
