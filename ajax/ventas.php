[<?php
require_once("../helpers/conexion.php");


if (isset($_GET["id"]) ){
	$return_arr = array();
    $criterio = strtolower($_GET["term"]);
    $f=date_parse($_GET["fecha"]);
    $mes=$f["month"];
    $anio=$f["year"];
	
	    global $db;
	    
	    $sql="SELECT idkardexvendedor,cod_libro, idlibro,titulo_libro,tomo_libro  FROM kardexvendedor WHERE cod_libro LIKE '%$criterio%'  AND vendedores_idVendedores='".$_GET["id"]."'  AND estado_libro='Remitido' AND traspaso=0 AND (cargo=1 or cargo=0)   AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio." order by cod_libro desc ";
	    $result=$db->query($sql);
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres[$r["cod_libro"]]=$r["titulo_libro"]."||".$r["tomo_libro"]."||".$r["idlibro"]."||".$r["idkardexvendedor"];
			}
	   $contador=0;
	   $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
	
	$c = explode("||", $valor);

	$f.="{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\",\"id\" : \"$c[2]\", \"idk\" : \"$c[3]\"},";
	
} // siguiente producto*/
echo  substr($f,0,-1);

//echo json_encode($result);
}

?>]