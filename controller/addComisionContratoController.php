<?php

require_once("model/comisionesContratoModel.php");
	 $c=new comisionesContrato();
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){

	 $c->meses=strtoupper($_POST["meses"]);
	 $c->porcentaje=strtoupper($_POST["porcentaje"]);
	 $c->nuevo();
	header("Location:".config::ruta()."?accion=comisionContratos");

	 
 }

require_once("view/addComisionContratos.php");

?>