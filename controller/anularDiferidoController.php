<?php 
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalleDevolucionObrasModel.php");

require_once("model/kardexVendedorModel.php");
require_once("model/devolucionObrasModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/creditoModel.php");





$c=new Contrato();
$credito=new Credito();
$det=new detalleContrato();
$kv=new kardexVendedor();
$dev=new devolucionObras();
$det2=new detalleDevolucionObras();
$vendedor=new Vendedores();
$cobrador=new Cobrador();

if(isset($_GET["id"])&&!isset($_GET["e"])){
$res=$c->getId($_GET["id"]);
$res3=$det->getDetalle($_GET["id"]);
$cred=$credito->getPorContrato($_GET["id"]);
require_once("view/anularDiferido.php");

}

if(isset($_GET["id"])&& isset($_GET["e"])&& $_GET["e"]=="editar"){
	$c=new Contrato();
	
	$res2=$dev->getId($_GET["id"]);
	$res3=$det->getDetalle($res2["idcontrato"]);
	$res=$c->getId($res2["idcontrato"]);
	require_once("view/anularDiferido.php");
	}
if(isset($_POST["enviarDiferido"]) && $_POST["enviarDiferido"]=="enviarDiferido")
{



    $dev->fecha=$_POST["fecha"];
    $dev->num_cuenta="";
    $dev->num_contrato=$_POST["num_contrato"];
    $dev->cliente=$_POST["cliente"];
    $dev->cobrador=$_POST["cobrador"];
    $dev->vendedor=$_POST["vendedor"];
    $dev->coordinador=$_POST["coordinador"];
    $dev->supervisor=$_POST["supervisor"];
    $dev->gerente=$_POST["gerente"];
    $dev->estado="sin enviar";
    $dev->tipo_devolucion=$_POST["tipo_devolucion"];
    $dev->obs=$_POST["obs"];
    $dev->nombre_usuario=$_SESSION["nombres"];
    $dev->idcontrato=$_POST["idcontrato"];
    $dev->idingreso=0;
    $dev->monto_total=$_POST["preciototal"];
    $dev->cuota_inicial=$_POST["cuotainicial"];
    $dev->saldo=$_POST["saldo"];
    $dev->pago_cuenta=0;
    $dev->procedencia="VENTAS";
    $dev->idvendedor=$_POST["idvendedor"];
    $dev->nuevo();
    $lastID=devolucionObras::$lastId;

     for($i=0; $i<$_POST["num_filas"];$i++){
          if(isset($_POST["elegido"][$i])){

              $pos=$_POST["elegido"][$i];
         $de=new detalleDevolucionObras();
         $de->cantidad=$_POST["cantidad"][$pos];
         $de->codigo=$_POST["codigo"][$pos];
         $de->titulo=$_POST["titulo"][$pos];
         $de->volumen=$_POST["tomo"][$pos];
         $de->precio_unitario=$_POST["precio_unit"][$pos];
         $de->precio_total=$_POST["precio_total"][$pos];
         $de->libros_idlibros=$_POST["idlibro"][$pos];
         $de->idkardex=$_POST["idkardex"][$pos];

         $de->devolucionObras_iddevolucionObras=$lastID;

         $de->insertar();

          }
         $de=new detalleDevolucionObras();
         $de->nuevo();
         unset($de);


         }
         $c->updateEstado($_POST["idcontrato"],"espera");


		header("Location:".config::ruta()."?accion=devolucionVentas");

		 

}


if(isset($_POST["editarDiferido"]) && $_POST["editarDiferido"]=="editarDiferido")
{
	
	
	$dev->fecha=$_POST["fecha"];
	$dev->num_cuenta="";
	$dev->num_contrato=$_POST["num_contrato"];
	$dev->cliente=$_POST["cliente"];
	$dev->cobrador=$_POST["cobrador"];
	$dev->vendedor=$_POST["vendedor"];
	$dev->coordinador=$_POST["coordinador"];
	$dev->supervisor=$_POST["supervisor"];
	$dev->gerente=$_POST["gerente"];
	$dev->estado="sin enviar";
	$dev->tipo_devolucion=$_POST["tipo_devolucion"];
	$dev->obs=$_POST["obs"];
	$dev->nombre_usuario=$_SESSION["nombres"];
	$dev->idcontrato=$_POST["idcontrato"];
	$dev->idingreso=0;
	$dev->monto_total=$_POST["preciototal"];
	$dev->cuota_inicial=$_POST["cuotainicial"];
	$dev->saldo=$_POST["saldo"];
	$dev->pago_cuenta=0;
	$dev->procedencia="VENTAS";
    $dev->actualizar($_POST["iddevolucionObras"]);
	$lastID=$_POST["iddevolucionObras"];
	
	 for($i=0; $i<$_POST["num_filas"];$i++){
		  if(isset($_POST["elegido"][$i])){
			  
			  $pos=$_POST["elegido"][$i];
		 $de=new detalleDevolucionObras();
		 $de->cantidad=$_POST["cantidad"][$pos];
		 $de->codigo=$_POST["codigo"][$pos];
		 $de->titulo=$_POST["titulo"][$pos];
		 $de->volumen=$_POST["elegido"][$pos];
		 $de->precio_unitario=$_POST["precio_unit"][$pos];
		 $de->precio_total=$_POST["precio_total"][$pos];
		 $de->libros_idlibros=$_POST["idlibro"][$pos];
		 $de->idkardex=$_POST["idkardex"][$pos];

		 $de->devolucionObras_iddevolucionObras=$lastID;
		  
		 $de->actualizar($lastID);
		  }
		 

		 }
		 header("Location:".config::ruta()."?accion=devolucionVentas");

}
	


?>