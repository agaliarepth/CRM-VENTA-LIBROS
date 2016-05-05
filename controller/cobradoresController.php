<?php
require_once("model/cobradoresModel.php");
$c=new Cobrador();
$res=$c->listarTodos();
if(isset($_GET["ic"]) && isset($_GET["e"]) && $_GET["e"]=="bc")
{  

$c->borrar($_GET["ic"]);

	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=cobradores&m=3";</script>';

		}
		
require_once("view/cobradores.php");





?>