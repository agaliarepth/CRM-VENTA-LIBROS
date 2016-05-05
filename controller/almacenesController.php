<?php 
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/categoriasModel.php");
require_once("model/librosModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/detalle_remisionModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/detalle_traspasoAlmacenModel.php");

$cat=new Categorias();
$la=new librosAlmacenes();
$al=new Almacen();
$li=new Libros();
$detingreso=new detalleIngreso();
$detegreso=new detalleEgreso();
$detremision=new detalleRemision();
$detdevolucion=new detalleDevolucion();
$traspaso=new detalleTraspasoAlmacen();

$res3=$al->autocompletar();
if(isset($_POST["verStock"])&& $_POST["verStock"]!="")
{
	
	if($_POST["almacenes"]!='TODOS'){
	$c=explode("/",$_POST["almacenes"]);
	$id=$c[0];
	$almacen=$c[1];
	}
$res=$li->listarTodos();	
$res2=$cat->listarTodos();
     $mes2=1;
	$anio2=2013;
	$ingreso_ant=0;
	$ingreso_act=0;
	$egreso_ant=0;
	$egreso_act=0;
	$remi_ant=0;
	$remi_act=0;
	$dev_ant=0;
	$dev_act=0;
	if($_POST["mes"]==1){
		$mes2=12;
		$anio2=$_POST["anio"]-1;
				
		}
		else{
			$mes2=$_POST["mes"]-1;
		$anio2=$_POST["anio"];
			
			}
	
	}
	
	


require_once("view/almacenes.php");

?>