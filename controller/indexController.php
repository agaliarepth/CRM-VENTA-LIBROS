<?php 

if(isset($_SESSION["ses_id"])){
	
	header("Location:".config::ruta()."?accion=home");
	}
require_once("model/administracionModel.php");
require_once("model/usuariosModel.php");
$admin=new Administracion();
$user=new Usuario();
if(isset($_POST["grabar"]) && $_POST["grabar"]=="si"){
	
	
	if(!$admin->logeo());
	$user->logeo();
	}



require_once("view/index.php");

?>