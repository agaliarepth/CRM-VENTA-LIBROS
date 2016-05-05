<?php
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/vendedoresModel.php");

	 $ob=new notaPedido();
	 $la=new librosAlmacenes();
	 $li=new Libros();
	 $ve=new Vendedores();
	 
	 		 $la=new librosAlmacenes();
			 
 if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="s" ){
	 
	 $de=new detalleNotaPedido();
	$res4=$ob->getId($_GET["id"]);
	$vendedor=$ve->getId($res4["vendedores_idVendedores"]);
	$res3=$de->getDetalle($_GET["id"]);
	 
		 
		 require_once("view/addRequerimiento.php");
 }
 
 			 
 if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="enviar" ){
	$de=new detalleNotaPedido();
	$res2=$ob->getId($_GET["id"]);
	$res3=$de->getDetalle($_GET["id"]);
	
	
		 $ob->actualizarTerminado($res2["idnota_pedido"],1);
		 header("Location:".config::ruta()."?accion=notasRequerimiento");
 }
 
 
 if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
	                  $de=new detalleNotaPedido();
					 $de->borrarPorNotaRequerimiento($_POST["idnota_pedido"]);
				
				  $ob->nombre_vendedor=$_POST["nombre_vendedor"];
			      $ob->fecha=$_POST["fechaRemision"];
	              $ob->ci_vendedor=$_POST["ci_vendedor"];
	              $ob->total=$_POST["cant_total"];
	              $ob->terminado=0;
	              $ob->estado="SIN REMITIR";
	              $ob->usuario=$_SESSION["nombres"];
	              $ob->cargo=$_SESSION["cargo"];
	              $ob->idusuarios=$_SESSION["ses_id"];
		          $ob->vendedores_idVendedores=$_POST["id_vendedor"];
		          $ob->idalmacenes=$_POST["id_almacenes"];
		          $ob->desc_almacen=$_POST["desc_almacen"];
		 $ob->actualizar($_POST["idnota_pedido"]);
		 $lastID=$_POST["idnota_pedido"];
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleNotaPedido();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->nota_pedido_idnota_pedido=$lastID;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->insertar();
		 unset($de);
		
		 
		 
		 }
		  $de=new detalleNotaPedido();
		  $de->nuevo();
		  unset($de);
		 	header("Location:".config::ruta()."?accion=verRequerimiento&id=$lastID");

	 
	 }

	if(isset($_POST["almacenes"])){
		$vect=explode("/",$_POST["almacenes"]);
		$nom=$vect[1];
		$idalmacen=$vect[0];
	}
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
    
			 if($_POST["num_filas"]==""|| $_POST["cant_total"]=="")
			  header("Location:".config::ruta()."?accion=addRequerimiento&m=3");
			  else{
				
	              $ob->nombre_vendedor=$_POST["nombre_vendedor"];
			      $ob->fecha=$_POST["fechaRemision"];
	              $ob->ci_vendedor=$_POST["ci_vendedor"];
	              $ob->total=$_POST["cant_total"];
	              $ob->terminado=0;
	              $ob->estado="SIN REMITIR";
	              $ob->usuario=$_SESSION["nombres"];
	              $ob->cargo=$_SESSION["cargo"];
	              $ob->idusuarios=$_SESSION["ses_id"];
		          $ob->vendedores_idVendedores=$_POST["id_vendedor"];
		          $ob->idalmacenes=$_POST["id_almacenes"];
		           $ob->desc_almacen=$_POST["desc_almacen"];
	  
	 $ob->nuevo();
	 $lastID=notaPedido::$lastId;
	 
		 
	 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleNotaPedido();
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->nota_pedido_idnota_pedido=$lastID;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->insertar();
		 
		 }
		  $de->nuevo();
		  unset($de);
	header("Location:".config::ruta()."?accion=verRequerimiento&id=$lastID");
			  }
		 }
		 

	 
 

require_once("view/addRequerimiento.php");

?>