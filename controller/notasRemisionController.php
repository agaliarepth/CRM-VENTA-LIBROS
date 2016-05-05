<?php 
require_once("model/vendedoresModel.php");
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
require_once("model/remisionModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/librosModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");

$v=new Vendedores();
$no=new notaPedido();
$detno=new detalleNotaPedido();
$remi=new Remision();
$detremi=new detalleRemision();
$kv=new kardexVendedor();
$li =new Libros();
$la=new librosAlmacenes();
$f=getdate();
$res=$remi->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["consulta"])){
	
	$res=$remi->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}
require_once("view/remision.php");
if(isset($_GET["ir"]) && isset($_GET["e"]) && $_GET["e"]=="br")
{
	$kv->borrarKardex($_GET["ir"]);
	$res2=$detremi->getDetalle($_GET["ir"]);
	$res3=$remi->getId($_GET["ir"]);


	$no->actualizarEstado($res3["nota_pedido_idnota_pedido"],"SIN REMITIR");
	$no->actualizarTerminado($res3["nota_pedido_idnota_pedido"],0);

	$remi->borrar($_GET["ir"]);
header("Location:".config::ruta()."?accion=notasRemision");
}




	if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="anular"&&isset($_SESSION["modulo_almacenes"]))
{  

$remi-> actualizarEstado($_GET["id"],"ANULADO");

    $kv->borrarKardex($_GET["id"]);
	$res2=$detremi->getDetalle($_GET["id"]);
	$res3=$remi->getId($_GET["id"]);


	$no->actualizarEstado($res3["nota_pedido_idnota_pedido"],"SIN REMITIR");
	$no->actualizarTerminado($res3["nota_pedido_idnota_pedido"],0);

header("Location:".config::ruta()."?accion=notasRemision");




	
	}
?>