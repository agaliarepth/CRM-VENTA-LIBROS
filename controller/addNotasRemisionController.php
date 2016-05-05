<?php
 
require_once("model/nota_pedidoModel.php");
require_once("model/detalle_notaPedidoModel.php");
require_once("model/remisionModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/librosModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/librosAlmacenesModel.php");



  if(isset($_POST["Enviar"])&&$_POST["Enviar"]=="Enviar" && isset($_GET["acc"])){
	
 $np=new notaPedido();
$li=new Libros();
$det=new detalleNotaPedido();
$re=new Remision();
$la=new librosAlmacenes();
$re->fecha=$_POST["fecha"];
$re->nombre_vendedor=$_POST["nombre_vendedor"];
$re->ci_vendedor=$_POST["ci_vendedor"];
$re->vendedores_idVendedores=$_POST["idVendedor"];
$re->estado="registrado";
$re->almacen=$_POST["desc_almacen"];
$re->idalmacenes=$_POST["idalmacenes"];
$re->idusuarios=$_SESSION["ses_id"];
$re->nombres_usuario=$_SESSION["nombres"];
$re->cargo_usuario=$_SESSION["cargo"];
$re->cant_total=$_POST["total"];
$re->nota_pedido_idnota_pedido=$_POST["idnota_pedido"];
$re->obs=$_POST["obser"];
$re->nuevo();
$last=Remision::$lastId;
$np->actualizarEstado($_POST["idnota_pedido"],"REMITIDO");

 $k=new kardexVendedor();


for($i=0; $i<(int)$_POST["num_filas"];$i++){
         $de=new detalleRemision();
         $de->codigo=$_POST["codigo"][$i];
         $de->cantidad=$_POST["cantidad"][$i];
         $de->titulo=$_POST["titulo"][$i];
         $de->volumen=$_POST["volumen"][$i];
		 $de->obs=$_POST["obs"][$i];

		 $de->remision_idremision=$last;
		 $de->libros_idlibros=$_POST["idlibros"][$i];



		 $de->insertar();
		 for($f=1; $f<=$_POST["cantidad"][$i]; $f++){
			 
			
			$k->fecha_remision=$_POST["fecha"];
			$k->num_remision=$last;
			$k->fecha_devolucion="";
			$k->num_devolucion="";
			$k->cod_libro=$_POST["codigo"][$i];
			$k->titulo_libro=$_POST["titulo"][$i];
			$k->estado_libro="Remitido";
			$k->num_contrato="";
			$k->reg_ventas="";
			$k->nombres_cliente="";
			$k->vendedores_idVendedores=$_POST["idVendedor"];
			$k->idlibro=$_POST["idlibros"][$i];
			$k->idalmacenes=$_POST["idalmacenes"];
			$k->tomo_libro=$_POST["volumen"][$i];
			$k->idcontrato="";
			$k->cargo=0;
			$k->traspaso=0;
			$k->idtraspaso=0;
			$k->insertar();
			
			 
			 }
			$k->nuevo();
			 
		  $de->nuevo();
		  
		  }
		 unset($de);
		 unset($k);
	header("Location:".config::ruta()."?accion=verRemision&id=".$last);
	}
 if(isset($_GET["id"])){
  


$np=new notaPedido();
$li=new Libros();
$det=new detalleNotaPedido();
$re=new Remision();
$res=$np->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
$res3=$re->validarRequerimiento($_GET["id"]);
if($res3>0){
	
	 echo "<script type='text/javascript'>
 
 alert('Ya se ha realizado un Nota de Remision para esta Nota de Requerimiento....');
 window.close();
 </script>";
	
	}


	

 }

require_once("view/addNotaRemision.php");
?>