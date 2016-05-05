<?php
require_once("model/categoriasModel.php");
	 $c=new Categorias();
 
 if(isset($_GET["e"])&& $_GET["e"]=="ec"){
	
	$res=$c->getId($_GET["ic"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	 $c->descripcion=strtoupper($_POST["descripcion"]);
	  $c->codigo=strtoupper($_POST["codigo"]);
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=categorias");

	 
 }
require_once("view/editCategorias.php");

?>