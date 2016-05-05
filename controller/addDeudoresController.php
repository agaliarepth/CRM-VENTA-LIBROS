<?php
require_once("model/deudoresModel.php");



	 $c=new Deudor();
	
	if(isset($_GET["e"])&&isset($_GET["id"])&&$_GET["e"]=="ed"){
		
		$res=$c->getId($_GET["id"]);
		require_once("view/addDeudores.php");
		
		}
		
	if(isset($_POST["editar"])&&isset($_POST["iddeudores"])&&$_POST["editar"]=="editar"){
		
		$c->nombre1=$_POST["nombre1"];
	 $c->nombre2=$_POST["nombre2"];
	 $c->paterno=$_POST["paterno"];
	 $c->materno=$_POST["materno"];
	 $c->tipo_documento=$_POST["tipo_documento"];
	 $c->razon_social=$_POST["razon_social"];
	 $c->num_documento=$_POST["num_documento"];
	 $c->lugar_doc=$_POST["lugar_doc"];
	 $c->ape_casado=$_POST["ape_casado"];
	 $c->tipo_operacion=$_POST["tipo_operacion"];
	 $c->tipo_cambio=$_POST["tipo_cambio"];
	 $c->moneda=$_POST["moneda"];
    $c->monto_original_deuda=$_POST["monto_original_deuda"];
     $c->concepto=$_POST["concepto"];
	 $c->tipo_doc_deuda=$_POST["tipo_doc_deuda"];
	 $c->num_doc_deuda=$_POST["num_doc_deuda"];
	 $c->saldo_deuda_vigente=$_POST["saldo_deuda_vigente"];
     $c->saldo_deuda_vencida=$_POST["saldo_deuda_vencida"];
     $c->cobrador=$_POST["cobrador"];
	 $c->fecha_ingreso_vencida=$_POST["fecha_ingreso_vencida"];
	  $c->obs=$_POST["obs"];
	 $c->actualizar($_POST["iddeudores"]);
		header("Location:".config::ruta()."?accion=deudores");
	}
		
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
	
	
	 $c->nombre1=$_POST["nombre1"];
	 $c->nombre2=$_POST["nombre2"];
	 $c->paterno=$_POST["paterno"];
	 $c->materno=$_POST["materno"];
	 $c->tipo_documento=$_POST["tipo_documento"];
	 $c->razon_social=$_POST["razon_social"];
	 $c->num_documento=$_POST["num_documento"];
	 $c->lugar_doc=$_POST["lugar_doc"];
	 $c->ape_casado=$_POST["ape_casado"];
	 $c->tipo_operacion=$_POST["tipo_operacion"];
	 $c->tipo_cambio=$_POST["tipo_cambio"];
	 $c->moneda=$_POST["moneda"];
    $c->monto_original_deuda=$_POST["monto_original_deuda"];
     $c->concepto=$_POST["concepto"];
	 $c->tipo_doc_deuda=$_POST["tipo_doc_deuda"];
	 $c->num_doc_deuda=$_POST["num_doc_deuda"];
	 $c->saldo_deuda_vigente=$_POST["saldo_deuda_vigente"];
     $c->saldo_deuda_vencida=$_POST["saldo_deuda_vencida"];
     $c->cobrador=$_POST["cobrador"];
	 $c->fecha_ingreso_vencida=$_POST["fecha_ingreso_vencida"];
	  $c->obs=$_POST["obs"];
	 
	  $c->nuevo();	
	header("Location:".config::ruta()."?accion=addDeudores&m=1");

		

	 
 }

require_once("view/addDeudores.php");

?>