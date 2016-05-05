<?php 

require_once("model/notasIngresoModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/detalle_notasIngresoModel.php");

$det=new detalleIngreso();
$la=new librosAlmacenes();
$li=new Libros();
$ni=new notaIngreso();


$li =new Libros();
$la=new librosAlmacenes();
$f=getdate();
$res=$ni->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["consulta"])){
	
	$res=$ni->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}
require_once("view/notasIngreso.php");
if(isset($_GET["ii"]) && isset($_GET["e"]) && $_GET["e"]=="bi")
{
	$res=$ni->getId($_GET["ii"]);
	$res2=$det->getDetalle($_GET["ii"]);
if($res["terminado"]==1){
	foreach($res2 as $v){
	
		$la->quitarStock($v["libros_idlibros"],$res["idalmacenes"],$v["cantidad"]);
		$li->quitarStock($v["libros_idlibros"],$v["cantidad"]);
		
		
		}
	
    $ni->borrar($_GET["ii"]);
}
else{
	$ni->borrar($_GET["ii"]);
	
	}

header("Location:".config::ruta()."?accion=notasIngreso");
}

		if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="anular"&&isset($_SESSION["modulo_almacenes"]))
{  

$ni-> actualizarEstado1($_GET["id"],"ANULADO");




header("Location:".config::ruta()."?accion=notasIngreso");





	
	}

?>