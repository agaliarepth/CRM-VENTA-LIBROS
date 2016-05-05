<?php 
require_once("model/usuariosModel.php");
require_once("model/perfilesModel.php");

	 $c=new Usuario();
	 $p=new  Perfiles();
	 
	 
	 $res=$c->listarTodos();
	 if(isset($_GET["iu"]) && isset($_GET["e"]) && $_GET["e"]=="bu")
{  
$c->borrar($_GET["iu"]);
	 header("Location:".config::ruta()."?accion=usuarios");
	
	}
	

require_once("view/usuarios.php");



?>