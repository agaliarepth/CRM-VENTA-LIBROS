[<?php
require_once("../helpers/conexion.php");
if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	    global $db;
	         $sql="SELECT idcredito,numcuenta,saldo,idcobrador,nombres,apellidopaterno,apellidomaterno  FROM view_contrato_credito  WHERE numcuenta LIKE '%$criterio%' OR  ci LIKE '%$criterio%' AND estadocredito='C' ";
	   	       $result=$db->query($sql);
		     $nombres =array();
	        foreach($result as $r){
			
		$nombres[$r["idcredito"]]=$r["numcuenta"]."||".$r["saldo"]."||".$r["idcobrador"]."||".$r["nombres"]." ".$r["apellidopaterno"]." ".$r["apellidomaterno"];
			}
	   $contador=0;
	     $f='';
		foreach ($nombres as $descripcion => $valor) 
{
	
		
	$c = explode("||", $valor);
	$f.="{ \"idcredito\" : \"$descripcion\", \"num_cuenta\" : \"$c[0]\", \"saldo\" : \"$c[1]\", \"idcobrador\" : \"$c[2]\", \"nombre_cliente\" : \"$c[3]\"},";
	
} // siguiente producto*/

echo  substr($f,0,-1);
}

?>]