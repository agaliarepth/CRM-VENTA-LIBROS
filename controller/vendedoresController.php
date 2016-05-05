<?php 
require_once("model/vendedoresModel.php");

$c=new Vendedores();
if(isset($_GET["iv"]) && isset($_GET["e"]) && $_GET["e"]=="bv")
{  
//$res=$c->getID($_GET["ie"]);
//$c->borrarFoto($res["logo"]);
$c->borrar($_GET["iv"]);


	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=vendedores&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/vendedores.php");
?>