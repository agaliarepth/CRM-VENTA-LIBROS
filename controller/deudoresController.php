<?php 
require_once("model/deudoresModel.php");

$c=new Deudor();
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="bd")
{  
//$res=$c->getID($_GET["ie"]);
//$c->borrarFoto($res["logo"]);
$c->borrar($_GET["id"]);


	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=deudoress&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos();
require_once("view/deudores.php");
?>