<?php 
require_once("model/comisionesContratoModel.php");

$c=new comisionesContrato();
if(isset($_GET["ic"]) && isset($_GET["e"]) && $_GET["e"]=="bc")
{  
$c->borrar($_GET["ic"]);
	header("Location:".config::ruta()."?accion=comisionContratos");

	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=categorias&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos();
require_once("view/comisionesContratos.php");


?>