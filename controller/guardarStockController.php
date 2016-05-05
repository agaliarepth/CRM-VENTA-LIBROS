<?php
require_once("model/stockModel.php");
require_once("model/detalleStockModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
$st=new Stock();
$dst=new detalleStock();
$la=new librosAlmacenes(); 
if(isset($_GET["id"])){
	
	$res=$la->getStockAlmacen($_GET["id"]);
	$st->fecha=date("Y-m-d H:i:s");
	$st->almacen=$_GET["id"];
	$st->nuevo();
	$lastID=Stock::$lastId;
	 foreach($res as $v){
	$dst->idlibros=$v["libros_idlibros"];
	$dst->reservado=$v["stock_reservado"];
    $dst->disponible=$v["stock_disponible"];
	$dst->fisico=$v["stock_disponible"];
	$dst->stock_idstock=$lastID;
    $dst->nuevo();
		 
		 }
		 echo "<script type='text/javascript'>
			alert('El Stock se ah guardado Correctamente....');
			location.href='".config::ruta()."?accion=almacenes'
			</script>";
	
	}
 ?>