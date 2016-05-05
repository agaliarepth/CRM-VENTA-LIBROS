<?php 
require_once("model/vendedoresModel.php");
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
require_once("model/librosModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");

$al=new Almacen();
$res3=$al->autocompletar();
$la=new librosAlmacenes();
$v=new Vendedores();
$no=new notaPedido();
$detno=new detalleNotaPedido();
$f=getdate();
$res=$no->listarTodosMes($f["mon"],$f["year"]);

$li=new Libros();
if(isset($_POST["consulta"])){
	
	$res=$no->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}

require_once("view/requerimiento.php");




if(isset($_GET["ir"]) && isset($_GET["e"]) && $_GET["e"]=="br")
{  

$no->borrar($_GET["ir"]);


header("Location:".config::ruta()."?accion=notasRequerimiento");
	
	}
	
	
	
	if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="anular"&&isset($_SESSION["modulo_almacenes"]))
{  

$no-> actualizarEstado($_GET["id"],"ANULADO");



header("Location:".config::ruta()."?accion=notasRequerimiento");




	
	}
	
?>