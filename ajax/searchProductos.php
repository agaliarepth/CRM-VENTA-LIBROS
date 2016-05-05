[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtoupper($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT codigo,titulo,tomo,stock_disponible,idlibros,precio_base FROM libros WHERE codigo LIKE '%$criterio%' OR titulo LIKE '%$criterio%'" ;
	    
		$result=$db->query($sql);
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres[$r["codigo"]]=$r["titulo"]."||".$r["tomo"]."||".$r["stock_disponible"]."||".$r["idlibros"]."||".$r["precio_base"];
			}
	   $contador=0;
	   $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
		
	$c = explode("||", $valor);

	$f.="{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\", \"stock_disponible\" : \"$c[2]\" , \"id\" : \"$c[3]\", \"precio\" : \"$c[4]\"},";
	
} // siguiente producto*/
echo  substr($f,0,-1);
//echo json_encode($result);
}

?>]