<?php
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/vendedoresModel.php");

     $v=new Vendedores();
	 $ob=new notaPedido();
	 $li=new Libros();
	 $la=new librosAlmacenes();

	if(isset($_POST["almacenes"])){
		$vect=explode("/",$_POST["almacenes"]);
		$nom=$vect[1];
		$idalmacen=$vect[0];
		$ven=$v->getId($_SESSION["idvendedores"]);
		
	}
	// $de=new detalleNotaPedido();
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
    
	 $ob->fecha=date("d-m-Y ");
	 if($_POST["nombre_vendedor"]=="" || $_POST["ci_vendedor"]==""){
		 
		 header("Location:".config::ruta()."?accion=addRequerimientoVendedor&m=2");
		 }
		 else{
			 if($_POST["num_filas"]==""|| $_POST["cant_total"]=="")
			  header("Location:".config::ruta()."?accion=addRequerimientoVendedor&m=3");
			  else{
	 $ob->nombre_vendedor=$_POST["nombre_vendedor"];
	  $ob->ci_vendedor=$_POST["ci_vendedor"];
	  
	   $ob->total=$_POST["cant_total"];
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
		 $de->nuevo();
		 $li->reservar($_POST["idlibro"][$i],$_POST["cantidad"][$i]);
		 $la->reservar($_POST["idlibro"][$i],$_POST["id_almacenes"],$_POST["cantidad"][$i]);

		 unset($de);
		 
		 
		 }
	header("Location:".config::ruta()."?accion=verRequerimiento&id=$lastID");
			  }
		 }
		 

	 
 }

require_once("view/addRequerimientoVendedor.php");

?>