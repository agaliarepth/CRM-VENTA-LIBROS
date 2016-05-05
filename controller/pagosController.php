<?php 
require_once("model/pagosModel.php");
require_once("model/cuentasModel.php");


$c=new Cuenta();
$p=new Pago();


$res=$p->listarTodos();
require_once("view/addPagos.php");




?>