<?php 
require_once("model/usuariosModel.php");
require_once("model/vendedoresModel.php");
	 $c=new Usuario();
     $v=new Vendedores();
	 
	 $res=$v->listarTodos();
	 if(isset($_GET["iu"]) && isset($_GET["e"]) && $_GET["e"]=="bu")
{  
$c->borrar($_GET["iu"]);
	 header("Location:".config::ruta()."?accion=usuarios");
	
	}
	

require_once("view/usuariosVendedor.php");



?>