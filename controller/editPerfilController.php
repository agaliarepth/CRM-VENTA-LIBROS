<?php
require_once("model/perfilesModel.php");
	 $c=new Perfiles();
 
 if(isset($_GET["e"])&& $_GET["e"]=="ep"){
	
	$res=$c->getId($_GET["ip"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	if(isset($_POST["modulo_catalogo"]))
	 $c->modulo_catalogo=$_POST["modulo_catalogo"];
	 else
	 $c->modulo_catalogo="0";
	 if(isset($_POST["modulo_almacenes"]))
	 $c->modulo_almacenes=$_POST["modulo_almacenes"];
	  else
	 $c->modulo_almacenes="0";
	 if(isset($_POST["modulo_vendedores"]))
	 $c->modulo_vendedores=$_POST["modulo_vendedores"];
	  else
	 $c->modulo_vendedores="0";
	 if(isset($_POST["modulo_yovendedor"]))
	 $c->modulo_yovendedor=$_POST["modulo_yovendedor"];
	  else
	 $c->modulo_yovendedor="0";
	 if(isset($_POST["modulo_administracion"]))
	 $c->modulo_administracion=$_POST["modulo_administracion"];
	  else
	 $c->modulo_administracion="0";
	 
	  if(isset($_POST["modulo_ventas"]))
	 $c->modulo_ventas=$_POST["modulo_ventas"];
	  else
	 $c->modulo_ventas="0";
	 
	  if(isset($_POST["modulo_cobranzas"]))
	 $c->modulo_cobranzas=$_POST["modulo_cobranzas"];
	  else
	 $c->modulo_cobranzas="0";
	 
	 $c->descrip=strtoupper($_POST["descrip"]);
	 
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=roles");

	 
 }
require_once("view/editPerfil.php");

?>