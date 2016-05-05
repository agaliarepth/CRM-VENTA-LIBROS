<?php 
require_once("model/librosModel.php");

$c=new Libros();
$res=$c->listarTodos($c->get_tabla());


	


require_once("view/registroCatalogo.php");

?>