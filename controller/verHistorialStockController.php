<?php

require_once("model/stockModel.php");
require_once("model/detalleStockModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosModel.php");
$li=new Libros();
$al=new Almacen();
$det=new detalleStock();
$st=new Stock();
$res=$det->getdetalle($_GET["id"]);
$res3=$st->getId($_GET["id"]);

require_once("view/verHistorialStock.php");


 ?>