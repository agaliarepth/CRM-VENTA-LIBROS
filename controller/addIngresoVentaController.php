<?php
require_once("model/devolucionObrasModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/contratosModel.php");
require_once("model/almacenesModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/librosModel.php");
require_once("model/detalleDevolucionObrasModel.php");
require_once("model/notasIngresoModel.php");
require_once("model/detalle_notasIngresoModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/creditoModel.php");
require_once("model/cuotasModel.php");


$tc=new tipoCambio();
$tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$dev=new devolucionObras();
$det=new detalleDevolucionObras();
$c=new Contrato();
$credito=new Credito();
$cuota= new Cuotas();
$ni=new notaIngreso();
$det2=new detalleIngreso();
$li=new Libros();
$al=new Almacen();
$la=new librosAlmacenes();
$detContrato=new detalleContrato();

$res4=$al->autocompletar();

if(isset($_GET["id"])){

	$det=new detalleDevolucionObras();
	$res2=$dev->getId($_GET["id"]);
	$res3=$det->getDetalle($res2["iddevolucionObras"]);

}



if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
			 $de=new detalleIngreso();

	 $cadena = explode("/",$_POST["almacenes"]);
                     $ni->recibe=$cadena[1];
					 $ni->envia=strtoupper($_POST["nombre_envia"]);
					 $ni->fecha=$_POST["fecha"];
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Enviado";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->idusuarios=$_SESSION["ses_id"];
					 $ni->nombre_usuario=$_SESSION["nombres"];
					 $ni->cargo_usuario=$_SESSION["cargo"];
					 $ni->idalmacenes=$cadena[0];
		             $ni->nombre_almacen=$cadena[1];
					 $ni->terminado="0";
					 $ni->moneda="Bs";
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 $ni->obs=$_POST["obs"];
					 $ni->nuevo();
					 $lastID=notaIngreso::$lastId;
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->ingreso_idingreso=$lastID;
		 $de->insertar();


		 }

	 $de->nuevo();
	 unset($de);
	 $dev2=new devolucionObras();
	 $dev2->updateEstado($_POST["idobras"],"aprobado");
	 $dev2->updateNotaIngreso($_POST["idobras"], $lastID);
	 $c1=$dev2->getId($_POST["idobras"]);

	 if($c1["tipo_devolucion"]=="DEVOLUCION PARCIAL"){
	 $res2=$credito->getPorNumCuenta($c1["num_cuenta"]);
	 $cuota->updateEstado($res2["idcredito"],0,0,1,1);
	 $cuota->updateEstado($res2["idcredito"],1,1,0,1);

	 $listaContratos=$detContrato->getDetalle($res2["contratos_idcontratos"]);
	 $listaDevolucion=$det->getDetalle($c1["iddevolucionObras"]);
      foreach($listaDevolucion as $f1){
       foreach($listaContratos as $f2){

				    if($f1["libros_idlibros"]==$f2["libros_idlibros"]){

						$detContrato->actualizarVista($f2["iddetalle_contrato"],0);

						}
				  }
          }


	}
	  if($c1["tipo_devolucion"]=="DEVOLUCION TOTAL"){
      $res2=$credito->getPorNumCuenta($c1["num_cuenta"]);
	 $cuota->updateEstado($res2["idcredito"],0,0,1,1);

      }
    header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
}

			require_once("view/addIngresoVenta.php");

?>
