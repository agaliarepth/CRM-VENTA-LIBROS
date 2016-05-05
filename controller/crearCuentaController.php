<?php 
require_once("model/cuentasModel.php");
require_once("model/contratosModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/detalleCuentaModel.php");
$det=new detalleContrato();
$c=new Contrato();
$cu=new Cuenta();
$det2=new detalleCuenta();

if(isset($_POST["Editar"])&& $_POST["Editar"]=="Editar"){
	
	
	 $det2->borrarCuenta($_POST["idcuentas"]);
	
	$cu->num_cuenta=$_POST["num_cuenta"];
	$cu->nombre_cliente=$_POST["cliente"];
	$cu->monto_total=$_POST["monto_total1"];
	$cu->pago_inicial=$_POST["pago_inicial"];
	$cu->saldo=$_POST["saldo"];
	$cu->numero_cuotas=$_POST["numero_cuotas"];
	$cu->nombre_cobrador=$_POST["nombre_cobrador"];
	$cu->idcobrador=$_POST["id_cobrador"];
	$cu->nombre_vendedor=$_POST["nombre_vendedor"];
	$cu->idvendedor=$_POST["id_vendedor"];
	$cu->fecha_contrato="";
	$cu->idcontrato=0;
	$cu->numcontrato=$_POST["num_contrato"];
	$cu->estado="Sin Enviar";
	$cu->fecha_creacion=$_POST["fecha"];
	$cu->ci_cliente=$_POST["ci_cliente"];
	$cu->verificador=$_POST["verificador"];
	$cu->transferencia=$_POST["transferencia"];
	$cu->gc=$_POST["gc"];
	$cu->sup=$_POST["sup"];
	$cu->saldo_actual=$_POST["saldo_actual"];
	$cu->porcentaje=0;
	$cu->zona=$_POST["zona"];
	$cu->barrio=$_POST["barrio"];
	$cu->dir=$_POST["dir"];
	$cu->telf=$_POST["telf"];
	$cu->lugar=$_POST["lugar"];
    $cu->diacobranza=$_POST["diacobranza"];
	$cu->cuotamensual=$_POST["cuotamensual"];
	$cu->obs=$_POST["obs"];
	$cu->actualizar($_POST["idcuentas"]);
	
	
	for($i=0; $i<$_POST["num_filas"];$i++){
		 
         $de=new detalleCuenta();
		 
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->cuentas_idcuentas=$_POST["idcuentas"];
		 $de->nuevo();
		
		 unset($de);
		  }
	
	
	header("location:".config::ruta()."?accion=cuentasNuevas");
	
}

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	
	$cu->num_cuenta=$_POST["num_cuenta"];
	$cu->nombre_cliente=$_POST["cliente"];
	$cu->monto_total=$_POST["monto_total1"];
	$cu->pago_inicial=$_POST["pago_inicial"];
	$cu->saldo=$_POST["saldo"];
	$cu->numero_cuotas=$_POST["numero_cuotas"];
	$cu->nombre_cobrador=$_POST["nombre_cobrador"];
	$cu->idcobrador=$_POST["id_cobrador"];
	$cu->nombre_vendedor=$_POST["nombre_vendedor"];
	$cu->idvendedor=$_POST["id_vendedor"];
	$cu->fecha_contrato="";
	$cu->idcontrato=0;
	$cu->numcontrato=$_POST["num_contrato"];
	$cu->estado="Sin Enviar";
	$cu->fecha_creacion=$_POST["fecha"];
	$cu->ci_cliente=$_POST["ci_cliente"];
	$cu->verificador=$_POST["verificador"];
	$cu->transferencia=$_POST["transferencia"];
	$cu->gc=$_POST["gc"];
	$cu->sup=$_POST["sup"];
	$cu->saldo_actual=$_POST["saldo_actual"];
	$cu->porcentaje=0;
	$cu->zona=$_POST["zona"];
	$cu->barrio=$_POST["barrio"];
	$cu->dir=$_POST["dir"];
	$cu->telf=$_POST["telf"];
	$cu->lugar=$_POST["lugar"];
    $cu->diacobranza=$_POST["diacobranza"];
	$cu->cuotamensual=$_POST["cuotamensual"];
	$cu->obs=$_POST["obs"];
	$cu->nuevo();
	$last=Cuenta::$lastId;
	
	for($i=0; $i<$_POST["num_filas"];$i++){
		 
         $de=new detalleCuenta();
		 
		 $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->cuentas_idcuentas=$last;
		 $de->nuevo();
		
		 unset($de);
		  }
	
	
	header("location:".config::ruta()."?accion=verTarjetaCobranza&id=".$last."&acc=volver");
	
}
if(isset($_GET["estado"])&& $_GET["estado"]=="editar"){
	
	$res=$cu->getId($_GET["id"]);
	 $de=new detalleCuenta();
	$res2=$de->getDetalle($_GET["id"]);
	
	
	
	}
	require_once("view/crearCuenta.php");