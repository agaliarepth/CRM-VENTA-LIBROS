<?php

require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/categoriasModel.php");
require_once("model/librosModel.php");


$cat=new Categorias();
$la=new librosAlmacenes();
$al=new Almacen();
$li=new Libros();

require_once("view/editStock.php");
if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	
	$la->updateStockAlmacen($_POST["il"],$_POST["ia"],$_POST["stock"],$_POST["stock_disponible"],$_POST["stock_reservado"]);
	
	 header("Location:".config::ruta()."?accion=almacenes&e=stock&id=".$_POST["ia"]);
	}


?>