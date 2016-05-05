<?php
require_once("model/editorialesModel.php");
	 $c=new Editoriales();
 
 if(isset($_GET["e"])&& $_GET["e"]=="ee"){
	
	$res=$c->getId($_GET["ie"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	$c->logo=$c->guardarFoto();
	 $c->nombre=strtoupper($_POST["nombre"]);
	 $c->direccion=$_POST["direccion"];
	  $c->telefono=$_POST["telefono"];
	   $c->email=$_POST["email"];
	 
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=editoriales");

	 
 }
require_once("view/editEditoriales.php");

?>