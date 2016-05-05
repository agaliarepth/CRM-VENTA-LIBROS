<?php
session_start();
require_once("helpers/conexion.php");
class config{
	
	
	public function  comillas_inteligentes($valor){
		if(get_magic_quotes_gpc()){
			$valor=stripcslashes($valor);
			
		}
		if(is_numeric($valor)){
			$valor="'".mysql_real_escape_string($valor)."'";
			
			}
			return $valor;
	}
	 static function ruta(){
		 
		 return "http://200.87.64.133/";
		 }
	}

 ?>