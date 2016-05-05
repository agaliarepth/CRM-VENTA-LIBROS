<?php 
require_once("model/editorialesModel.php");

$c=new Editoriales();
if(isset($_GET["ie"]) && isset($_GET["e"]) && $_GET["e"]=="be")
{  
$res=$c->getID($_GET["ie"]);
$c->borrarFoto($res["logo"]);
$c->borrar($_GET["ie"]);


	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=editoriales&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/editoriales.php");
?>