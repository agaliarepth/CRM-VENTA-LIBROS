<?php
require_once("model/usuariosModel.php");
require_once("model/perfilesModel.php");
	 $c=new Usuario();
 $p=new Perfiles();
	$res1= $p->autocompletar();
 if(isset($_GET["e"])&& $_GET["e"]=="eu"){
	
	$res=$c->getId($_GET["iu"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
    
	 $c->username=$_POST["username"];
	  $c->password=$_POST["password"];
	 $c->nombres=strtoupper($_POST["nombres"]);
	 $c->cargo=strtoupper($_POST["cargo"]);
	  $c->perfiles_idperfiles=$_POST["perfiles_idperfiles"];
	 $c->actualizar($_POST["idValor"]);
	
	header("Location:".config::ruta()."?accion=usuarios");

 }
require_once("view/editUsuario.php");

?>