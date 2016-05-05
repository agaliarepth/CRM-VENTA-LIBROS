<?php

require_once("model/editorialesModel.php");
	 $c=new Editoriales();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
      $c->logo=$c->guardarFoto();
	 $c->nombre=strtoupper($_POST["nombre"]);
	 $c->direccion=$_POST["direccion"];
	  $c->telefono=$_POST["telefono"];
	   $c->email=$_POST["email"];
	 $c->nuevo();
	header("Location:".config::ruta()."?accion=addEditoriales&m=1");

	 
 }

require_once("view/addEditoriales.php");

?>