<?php 
require_once("model/almacenesModel.php");
	 $c=new Almacen();
	 
	 $res=$c->listarTodos();
	 if(isset($_GET["ia"]) && isset($_GET["e"]) && $_GET["e"]=="ba")
{  
$c->borrar($_GET["ia"]);
echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=almacenAdmin";</script>';
	
	}
	

require_once("view/almacenAdmin.php");



?>