<?php 
require_once("model/cambioObrasModel.php");
require_once("model/creditoModel.php");

$credito=new Credito();
$c=new CambioObra();

$f=getdate();

$res=$c->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["cambioObras"])){
	
	$res=$c->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}
	
	  if(isset($_GET["e"])&& $_GET["e"]=="ea"){
		  
		  
		  $c->updateEstado("ALMACEN",1,$_GET["id"]);
     	 header("Location:".config::ruta()."?accion=listarCambioObras");

		  
		  
		  }

require_once("view/listarCambioObras.php");




?>