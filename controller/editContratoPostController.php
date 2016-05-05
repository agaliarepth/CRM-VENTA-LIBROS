<?php 
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/comisionesContratoModel.php");
require_once("model/cobradoresModel.php");
require_once("model/creditoModel.php");

$cc=new comisionesContrato();

$res3=$cc->listarTodos();
$ve=new Vendedores();
$kv1=new kardexVendedor();
$li=new Libros();
$la=new librosAlmacenes();
$det=new detalleContrato();
$c=new Contrato();
$credito=new Credito();

$cobrador=new cobrador();



$res=$c->getId($_GET["id"]);


$res2=$det->getDetalle($_GET["id"]);

$nombre_vendedor=$ve->getNombresVendedor($res["idvendedor"]);
$nombre_supervisor=$ve->getNombresVendedor($res["idchofer"]);

$idvendedor=$res["idvendedor"];
$supervisor=$res["idchofer"];

$cred=$credito->getPorContrato($_GET["id"]);

$res=$c->getId($_GET["id"]);
$comisiones=$ve-> getComisiones($res["idvendedor"]);


if($res["terminado"]==0||$res["tipocontrato"]=='Espera'||$res["tipocontrato"]=='VENTA'){
	header("Location:".config::ruta()."?accion=error&m=3");

	}

if(isset($_POST["editContrato"])&&$_POST["editContrato"]=="editContrato" ){
	
	$c->numcontrato=$_POST["numcontrato"];
	$c->tipocontrato="DIFERIDO";
	$c->fechacontrato=$_POST["fecha_contrato"];
	$c->localidad=strtoupper($_POST["localidad"]);
	$c->preciototal=$_POST["monto_total"];
	$c->tipoventa=$_POST["tipoventa"];
	$c->idvendedor=$_POST["idvendedor"];
	$c->idchofer=$_POST["idchofer"];
	$c->nombres=strtoupper($_POST["nombres"]);
	$c->apellidopaterno=strtoupper($_POST["apellidopaterno"]);
	$c->apellidomaterno=strtoupper($_POST["apellidomaterno"]);
	$c->ci=$_POST["carnet"];
	$c->terminado=$_POST["terminado"];
	$c->actualizar($_POST["idcontrato"]);
	$lastID=$_POST["idcontrato"];
	
	
	$cred=$credito->getPorContrato($_POST["idcontrato"]);
	
	
	if($_POST["tipoventa"]=='CONTADO'){
		
		$credito->cuotainicial=$_POST["cuota_inicialContado"];
		$credito->saldo=$_POST["saldoContado"];
	    $credito->valorcomisionable=$_POST["valorcomisionableContado"];
	   if($_POST["tipocomisioncontado"]=="P"){
	  $credito->montocomision=($_POST["comisioncontrato"]*$_POST["valorcomisionable"])/100;	
	  $credito->porcentajecomision=$_POST["comisioncontrato"];
	  }
	  if($_POST["tipocomisioncontado"]=="M"){
	  $credito->montocomision=$_POST["comisioncontrato"];	
	  $credito->porcentajecomision=($_POST["comisioncontrato"]/$_POST["valorcomisionable"])*100;
	  }
	  $credito->numcuotas=1;	
	  $credito->montocuotas=$credito->cuotainicial;
        $credito->cuentacomision=$_POST["cuentacomision"];



    }
	if($_POST["tipoventa"]=='CREDITO'){
		$credito->cuotainicial=$_POST["cuota_inicial"];
		$credito->saldo=$_POST["saldo"];
	    $credito->valorcomisionable=$_POST["valorcomisionable"];
			 if($_POST["tipocomisioncredito"]=="P"){
	  $credito->montocomision=($_POST["comisioncontrato1"]*$_POST["valorcomisionableContado"])/100;	
	  $credito->porcentajecomision=$_POST["comisioncontrato1"];
	  }
	  if($_POST["tipocomisioncredito"]=="M"){
	  $credito->montocomision=($_POST["comisioncontrato1"]);	
	  $credito->porcentajecomision=($_POST["comisioncontrato1"]/$_POST["valorcomisionableContado"])*100;
	  }
	  $credito->numcuotas=$_POST["num_pagos"]; 	
	  $credito->montocuotas=$_POST["monto_pagos"]; 	
		$credito->fechacobranza=$_POST["fechacobranza"];
        $credito->cuentacomision=$_POST["cuentacomision1"];




    }
	
	
		
	 
	   	
	  $credito->saldocuota=$credito->cuotainicial; 	
	  $credito->idcobrador=$_POST["idcobrador"];
	  $credito->numreporte=""; 	
	  $credito->contratos_idcontratos= $lastID; 

	  $credito->actualizar($cred["idcredito"]);
		
		
		
		
		

	
	 $de=new detalleContrato();
		
		
			
			for($i=0; $i<$_POST["num_filas"];$i++){

   
        	 
	     $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->idkardex=0;
		 $de->sw=1;
		 $de->contratos_idcontratos=$lastID;
		 $de->actualizar($_POST["iddetalle_contrato"][$i]); 

}
			
		
	   
		
	

header("Location:".config::ruta()."?accion=contratos");
}




require_once("view/editContratoPost.php");




?>