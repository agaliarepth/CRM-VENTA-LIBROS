<?php

require_once("model/categoriasModel.php");
	 $c=new Categorias();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	 $c->descripcion=strtoupper($_POST["descripcion"]);
	 $c->codigo=strtoupper($_POST["codigo"]);
	 $c->nuevo($c->get_tabla(),$c->get_objeto());
	header("Location:".config::ruta()."?accion=addCategorias&m=1");

	 
 }
 if(isset($_GET["e"])&& $_GET["e"]=="ec"){
	 	
	$res=$c->get_Id($c->get_id(),$_GET["ic"],$c->get_tabla());
	
	
	 
	 }
require_once("view/addCategorias.php");

?>