<?php 
require_once("model/vendedoresModel.php");
require_once("model/librosModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/devolucionObrasModel.php");

$detno=new detalleDevolucion();
$dev=new Devolucion();
$li=new librosAlmacenes();
$al=new Almacen();
$la=new Libros();
$kv=new KardexVendedor();
$res3=$al->autocompletar();
$v=new Vendedores();
$res4=$v->listarTodos();
$f=getdate();
$res=$dev->listarTodosMes($f["mon"],$f["year"]);
$devob=new devolucionObras();
if(isset($_POST["consulta"])){
	
	$res=$dev->listarTodosMes($_POST["mes"],$_POST["anio"]);

	
	}




if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="bd")
{  

$res2=$detno->getDetalle($_GET["id"]);
$res3=$dev->getId($_GET["id"]);
if($res3["terminado"]==1 ){
	  $cont=0;

	
	 $kv->actualizarEstadoRemitido1($res3["iddevolucion"]);
     $dev->borrar($_GET["id"]);


header("Location:".config::ruta()."?accion=notasDevolucion");
}
else{
	$dev->borrar($_GET["id"]);


header("Location:".config::ruta()."?accion=notasDevolucion");
	
	}

	
	}
	
		if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="anular"&&isset($_SESSION["modulo_almacenes"]))
{
    $res3=$dev->getId($_GET["id"]);
      if($res3["numcontrato"]!=""){

          $notaDev=$devob->getPorContrato($res3["numcontrato"]);

          $devob->updateEstado($notaDev["iddevolucionObras"],"enviado");

          $kv->anularDevolucionVentas($res3["iddevolucion"],$res3["numcontrato"]);
          $dev->actualizarEstado1($_GET["id"], "ANULADO");



      }
    else {


        $dev->actualizarEstado1($_GET["id"], "ANULADO");


        $kv->actualizarEstadoRemitido1($_GET["id"]);





    }

    header("Location:" . config::ruta() . "?accion=notasDevolucion");
	
	}
require_once("view/devolucion.php");

?>