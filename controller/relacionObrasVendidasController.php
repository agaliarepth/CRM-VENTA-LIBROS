<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/LibrosModel.php");

$c=new Contrato();
$det=new detalleContrato();
$li=new Libros();

if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	$res=$c->kardexMayorTotal($_POST["mes"],$_POST["anio"]);
	
	}
require_once("view/relacionObrasVendidas.php");

?>