<?php
 require_once("model/kardexVendedorModel.php");
 require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
 $kv=new kardexVendedor();
 $li=new Libros();
 $la=new librosAlmacenes();
 if(isset($_GET["id"])){
	
	
	 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
		 
 $e[]=array();
	  
    	if($_POST["nombres_cliente"]==""){$e[1]= '<span class="error">Ingrese un nombre de Cliente</span>';}
		 
		  else if($_POST["num_contrato"]==""){$e[2]= '<span class="error">Ingrese un Numero de Contrato</span>';}
		 
		 
		  else{
			  $estado="";
			  
			  if($_POST["reg_ventas"]==""){
				  
				  $estado="Diferidos";
				  }
				  else{
					  $estado="ObrasRegVentas";
					  }
	$kv->actualizarEstadoContrato($_GET["id"],$_POST["num_contrato"],$_POST["reg_ventas"],$estado,$_POST["nombres_cliente"]);
	 $li->reponerStock($_POST["il"],"1");
     $la->reponerStock($_POST["il"],$_POST["ia"],"1");
	header("Location:".config::ruta()."?accion=notasDevolucion");

		  }
	 
	 }
	 
	 require_once("view/devolucionContrato.php");
	 }

 ?>