<?php 
require_once("model/perfilesModel.php");


if(isset($_SESSION["idperfiles"])){
	$p=new Perfiles();
$res=$p->getId($_SESSION["idperfiles"]);
foreach($res as $v){
	if($res["modulo_almacenes"]=="1")
	$_SESSION["modulo_almacenes"]="1";
	
	if($res["modulo_catalogo"]=="1")
	$_SESSION["modulo_catalogo"]="1";
	
	if($res["modulo_vendedores"]=="1")
	$_SESSION["modulo_vendedores"]="1";
	
	if($res["modulo_yovendedor"]=="1")
	$_SESSION["modulo_yovendedor"]="1";
	
	if($res["modulo_administracion"]=="1")
	$_SESSION["modulo_administracion"]="1";
	
	if($res["modulo_ventas"]=="1")
	$_SESSION["modulo_ventas"]="1";
	
	if($res["modulo_cobranzas"]=="1")
	$_SESSION["modulo_cobranzas"]="1";
	
	
	
	}
}
require_once("view/home.php");
?>