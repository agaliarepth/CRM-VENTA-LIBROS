<?php
require_once("model/cobradoresModel.php");

	 $c=new Cobrador();

 if(isset($_GET["e"])&& $_GET["e"]=="ec"){
	
	$res=$c->getId($_GET["ic"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
      $e[]=array();
	  
    	if($_POST["nombres"]==""){$e[1]= '<span class="error">Ingrese su Nombre</span>';}
		  else if($_POST["apellidos"]==""){$e[2]= '<span class="error">Ingrese un Apellido</span>';}
		   else if($_POST["carnet"]==""){$e[3]= '<span class="error">Ingrese un numero de Carnet</span>';}
		
		  else{
		  
	 $c->nombres=strtoupper($_POST["nombres"]);
      $c->apellidos=strtoupper($_POST["apellidos"]);
	 $c->carnet=$_POST["carnet"];
     $c->codigo=substr($c->nombres,0,1).substr($c->apellidos,0,1)."-".$_POST["carnet"];
	 $c->telefono=$_POST["telefono"];
	 $c->direccion=$_POST["direccion"];
	 $c->email=$_POST["email"];

	  $c->nacionalidad=$_POST["nacionalidad"];
	 $c->tipo_documento=$_POST["tipo_documento"];
     $c->estatus=$_POST["estatus"];
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=cobradores");
		  }
	 
 }
require_once("view/editCobradores.php");

?>