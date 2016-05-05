<?php 
require_once("model/almacenesModel.php");
	 $c=new Almacen();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	 $c->descripcion=strtoupper($_POST["descripcion"]);
	  $c->administrador=strtoupper($_POST["administrador"]);
	 $c->direccion=strtoupper($_POST["direccion"]);
	 $c->fono=strtoupper($_POST["fono"]);
	 $c->nuevo();
	
	header("Location:".config::ruta()."?accion=addAlmacen&m=1");

	 
 }


require_once("view/addAlmacen.php");



?>