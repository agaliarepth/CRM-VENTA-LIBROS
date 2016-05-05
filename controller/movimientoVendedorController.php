<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");
require_once("model/librosModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");




$det1=new detalleIngreso();
$det2=new detalleEgreso();

$c=new Contrato();
$det=new detalleContrato();
$remi=new detalleRemision();
$devo=new detalleDevolucion();
$traspaso= new detalleTraspasoAlmacen();
$libro=new Libros();
$k=new kardexVendedor();
$ven= new Vendedores();

	
	
	if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){

				$sum2=0;
				$f1=date("Y-m-d",strtotime($_POST["fecha_ini"]));
				$f2=date("Y-m-d",strtotime($_POST["fecha_fin"]));
		$fecha2=strtotime('-1 day', strtotime($f1)); 
		$fecha2=date("Y-m-d",$fecha2);
		
		$listaLibros=$k->getCargosPorVendedorMes($_POST["id_vendedor"],$f1,$f2);

	}
require_once("view/movimientoVendedor.php");
?>