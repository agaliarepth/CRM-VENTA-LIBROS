<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");
require_once("model/librosModel.php");


$det1=new detalleIngreso();
$det2=new detalleEgreso();

$c=new Contrato();
$det=new detalleContrato();
$remi=new detalleRemision();
$devo=new detalleDevolucion();
$traspaso= new detalleTraspasoAlmacen();
$libro=new Libros();

	
	
	if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){

				$sum2=0;
				$f1=date("Y-m-d",strtotime($_POST["fecha_ini"]));
				$f2=date("Y-m-d",strtotime($_POST["fecha_fin"]));
		$fecha2=strtotime('-1 day', strtotime($f1)); 
		$fecha2=date("Y-m-d",$fecha2);
		
		$listaLibros=$libro->listarTodos();


		/*
		$si=$det1->sumIngreso($fecha2,$listaLibros["idlibros"]);
		$se=$det2->sumEgreso($fecha2,$listaLibros["idlibros"]);
		$sr=$remi->sumRemisiones($fecha2,$listaLibros["idlibros"]);
		$sd=$devo->sumDevolucion($fecha2,$listaLibros["idlibros"]);
		$sc=$det->sumContratosKardexMayor($fecha2,$listaLibros["idlibros"]);
		$t_envia=$traspaso->sumTraspasoEnvia($fecha2,$listaLibros["idlibros"],5);
		$t_recibe=$traspaso->sumTraspasoRecibe($fecha2,$listaLibros["idlibros"],5);
		
	
		$saldo=($sd["suma"]+$si["suma"]+$t_recibe["suma"])-($se["suma"]+$sr["suma"]+$t_envia["suma"]);
		
		
		
		
		$res1=$det1->getMes($_POST["idlibro"],$f1,$f2);
		$res2=$det2->getMes($_POST["idlibro"],$f1,$f2);
		$res3=$remi->getMes($_POST["idlibro"],$f1,$f2);
		$res4=$devo->getMes($_POST["idlibro"],$f1,$f2);
		//$res5=$det->getMesSumado($_POST["idlibro"],$f1,$f2);
		$res6=$traspaso->getMesEnvia($_POST["idlibro"],$f1,$f2,5);
		$res7=$traspaso->getMesRecibe($_POST["idlibro"],$f1,$f2,5);
		*/

	
	
	}
require_once("view/movimientoItems.php");
?>