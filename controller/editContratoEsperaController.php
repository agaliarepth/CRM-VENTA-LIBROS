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
$de=new detalleContrato();
$c=new Contrato();
$credito=new Credito();

$cobrador=new cobrador();



$res=$c->getId($_GET["id"]);

if($res["tipocontrato"]!='espera'){
	header("Location:".config::ruta()."?accion=error&m=3");

	
	}

$res2=$de->getDetalle($_GET["id"]);

$nombre_vendedor=$ve->getNombresVendedor($res["idvendedor"]);
$nombre_supervisor=$ve->getNombresVendedor($res["idchofer"]);

$idvendedor=$res["idvendedor"];
$supervisor=$res["idchofer"];

$cred=$credito->getPorContrato($_GET["id"]);

$comisiones=$ve->getComisiones($res["idvendedor"]);



if(isset($_POST["editContrato"])&&$_POST["editContrato"]=="editContrato" ){
	
	$c->numcontrato=$_POST["numcontrato"];
	$c->tipocontrato="DIFERIDO";
	$c->terminado=1;
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
	
	$c->actualizar($_POST["idcontrato"]);
	$lastID=$_POST["idcontrato"];
	$nombres=strtoupper($_POST["nombres"]." ".$_POST["apellidopaterno"]." ".$_POST["apellidomaterno"]);
	$kv1->actualizarDatosContrato($_POST["idcontrato"],$_POST["numcontrato"],$nombres,$_POST["idchofer"],"Diferido");
	$kv1->actualizarDatosContrato2($_POST["numcontrato"],$nombres);
	
	
	$cred=$credito->getPorContrato($_POST["idcontrato"]);
	
	
		
	  $credito->cuotainicial=$_POST["cuota_inicial"]; 	
	  $credito->numcuotas=$_POST["num_pagos"]; 	
	  $credito->montocuotas=$_POST["monto_pagos"]; 	
	  if($_POST["tipocomisioncredito"]=="P"){
	  $credito->montocomision=($_POST["comisioncontrato1"]*$_POST["valorcomisionableContado"])/100;	
	  $credito->porcentajecomision=$_POST["comisioncontrato1"];
	  }
	  if($_POST["tipocomisioncredito"]=="M"){
	  $credito->montocomision=($_POST["comisioncontrato1"]);	
	  $credito->porcentajecomision=($_POST["comisioncontrato1"]/$_POST["valorcomisionableContado"])*100;
	  }
	  $credito->saldo=$_POST["saldo"]; 	
	  $credito->saldocuota=$_POST["cuota_inicial"]; 	
	  $credito->idcobrador=$_POST["idcobrador"];
	  $credito->numreporte=""; 	
	  $credito->valorcomisionable=$_POST["valorcomisionable"];
  	  $credito->fechacobranza=$_POST["fechacobranza"];
	  $credito->contratos_idcontratos= $lastID; 

	  $credito->actualizar($cred["idcredito"]);
	  
	  for($i=0; $i<$_POST["num_filas"];$i++){
		 
        if($_POST["sw"][$i]==0){
			
			
		 
			 
	     $de->cantidad=1;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->idkardex=$_POST["idkardex"][$i];
		 $de->contratos_idcontratos=$lastID;
            $de->sw=1;
		 $de->actualizar($_POST["iddetalle"][$i]);

		 //$kv1->updateReservado($v["idkardexvendedor"],1);
			
			 
		}
	
		if($_POST["sw"][$i]==1){
		
			 
	     $de->cantidad=1;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->idkardex=$_POST["idkardex"][$i];
            $de->sw=1;
		 $de->contratos_idcontratos=$lastID;
		 $de->nuevo(); 
		 
		 if($_POST["idchofer"]!=$_POST["idvendedor"]){
		  
			$res3=$kv1->getId($_POST["idkardex"][$i]);
			$kv1->fecha_remision=$res3["fecha_remision"];
			$kv1->num_remision=$res3["num_remision"];
			$kv1->fecha_devolucion="";
			$kv1->num_devolucion="";
			$kv1->cod_libro=$res3["cod_libro"];
			$kv1->titulo_libro=$res3["titulo_libro"];
			$kv1->estado_libro="Diferido";
			$kv1->num_contrato=$_POST["numcontrato"];
			$kv1->reg_ventas="";
			$kv1->nombres_cliente=$nombres;
			$kv1->vendedores_idVendedores=$_POST["idvendedor"];
			$kv1->idlibro=$res3["idlibro"];
			$kv1->idalmacenes=$res3["idalmacenes"];
			$kv1->tomo_libro=$res3["tomo_libro"];
			$kv1->idcontrato=$lastID;
			$kv1->cargo=0;
			$Kv1->traspaso=0;
			$kv1->insertar();
	        $kv1->actualizarEstadoDiferidoTraspaso($_POST["idchofer"],$_POST["idkardex"][$i],$res3["cod_libro"],$_POST["numcontrato"],$nombres, $lastID);
             
             $kv1->nuevo();
		 }
			 
			 
			else
			 $kv1->actualizarEstadoDiferido($_POST["idkardex"][$i],$_POST["codigo"][$i],$_POST["numcontrato"],$nombres,  $lastID);
			
		  
	}
	  
		
		}// fin for
	
		
	

header("Location:".config::ruta()."?accion=contratos");
}




require_once("view/editContratoEspera.php");




?>