[<?php
require_once("../helpers/conexion.php");
if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	    global $db;
	        $sql="SELECT idcontratos, numcontrato, nombres,apellidopaterno,apellidomaterno,idcredito FROM view_contrato_credito WHERE  numcontrato LIKE '%$criterio%' OR nombres LIKE '%$criterio%' OR apellidopaterno LIKE '%$criterio%'"  ;
	   	       $result=$db->query($sql);
		     $nombres =array();
	        foreach($result as $r){
			
			$nombres[$r["idcontratos"]]=$r["numcontrato"]."||".$r["nombres"]."||".$r["apellidopaterno"]."||".$r["apellidomaterno"]."||".$r["idcredito"];
			}
	   $contador=0;
	     $f='';
		foreach ($nombres as $descripcion => $valor) 
{
	
		
	$c = explode("||", $valor);
	$f.="{ \"idcontratos\" : \"$descripcion\", \"numcontrato\" : \"$c[0]\", \"nombres\" : \"$c[1]\", \"apellidopaterno\" : \"$c[2]\", \"apellidomaterno\" : \"$c[3]\", \"idcredito\" : \"$c[4]\" },";
	
} // siguiente producto*/

echo  substr($f,0,-1);
}

?>]