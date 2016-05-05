[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])&& isset($_GET["id"]) && isset($_GET["idalmacen"])){
	$return_arr = array();
$criterio = strtoupper($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT cod_libro, idlibro,titulo_libro,tomo_libro, count(cod_libro) as disponible FROM kardexvendedor WHERE cod_libro LIKE '%$criterio%'  AND vendedores_idVendedores='".$_GET["id"]."' AND idalmacenes='".$_GET["idalmacen"]."' AND estado_libro='Remitido'";
	    $result=$db->query($sql)->fetchAll();
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres[$r["cod_libro"]]=$r["titulo_libro"]."||".$r["tomo_libro"]."||".$r["disponible"]."||".$r["idlibro"];
			}
	   $contador=0;
	   $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
	
	$c = explode("||", $valor);

	$f.= "{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\", \"disponible\" : \"$c[2]\" , \"id\" : \"$c[3]\"},";
	
} // siguiente producto*/
echo  substr($f,0,-1);

//echo json_encode($result);
}

?>]