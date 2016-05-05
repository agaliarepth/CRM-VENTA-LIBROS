[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])&&$_GET["id"]){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT libros.codigo,libros.titulo,libros.tomo,libros.idlibros, libros.precio_base FROM  libros WHERE   libros.codigo LIKE '%$criterio%' OR libros.titulo  LIKE '%$criterio%'" ;
	    $result=$db->query($sql);
		
		$nombres =array();
		
	   foreach($result as $r){
			
			$nombres[$r["codigo"]]=$r["titulo"]."||".$r["tomo"]."||".$r["idlibros"]."||".$r["precio_base"];
			}
	   $contador=0;
	      $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
	
	$c = explode("||", $valor);

	$f.= "{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\" , \"id\" : \"$c[2]\", \"precio\" : \"$c[3]\" },";
	
} // siguiente producto*/
echo  substr($f,0,-1);

//echo json_encode($result);
}

?>]