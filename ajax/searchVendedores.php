[<?php
require_once("../helpers/conexion.php");
if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	    global $db;
	        $sql="SELECT nombres, apellidos, carnet, idVendedores,credito FROM vendedores WHERE carnet LIKE '%$criterio%' OR apellidos LIKE '%$criterio%' OR nombres LIKE '%$criterio%'"  ;

	   	     $result=$db->query($sql);
		     $nombres =array();
	        foreach($result as $r){
			
			$nombres[$r["nombres"]." ".$r["apellidos"]]=$r["carnet"]."||".$r["idVendedores"]."||".$r["credito"];
			}
	   $contador=0;
	   $f='';
		foreach ($nombres as $descripcion => $valor) 
{
	
	
	$c = explode("||", $valor);
	$f.= "{ \"label\" : \"$descripcion\", \"valor\" : \"$c[0]\", \"idVendedor\" : \"$c[1]\", \"credito\" : \"$c[2]\" },";
	
} // siguiente producto*/

echo  substr($f,0,-1);
}

?>]