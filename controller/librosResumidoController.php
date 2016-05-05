<?php 
require_once("model/librosModel.php");

$c=new Libros();
if(isset($_GET["il"]) && isset($_GET["e"]) && $_GET["e"]=="bl")
{  
$res=$c->getID($_GET["il"]);
$c->borrarFoto($res["foto"]);
$c->borrar($_GET["il"]);

	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=libros&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/librosResumido.php");



?>