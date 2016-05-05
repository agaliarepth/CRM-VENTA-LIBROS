<?php
require_once("model/almacenesModel.php");
	 $c=new Almacen();
 
 if(isset($_GET["e"])&& $_GET["e"]=="ea"){
	
	$res=$c->getId($_GET["ia"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	 $c->descripcion=strtoupper($_POST["descripcion"]);
	  $c->administrador=strtoupper($_POST["administrador"]);
	 $c->direccion=strtoupper($_POST["direccion"]);
	 $c->fono=strtoupper($_POST["fono"]);
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=almacenAdmin");

	 
 }
require_once("view/editAlmacen.php");

?>