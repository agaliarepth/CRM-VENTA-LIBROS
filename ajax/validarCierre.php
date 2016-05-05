<?php
require_once("../helpers/conexion.php");

	    global $db;
if(isset($_GET)){
	
	
		  $sql="SELECT count(idcierres)  FROM cierres WHERE mes='". $_GET["mes"]."' AND   anio='".$_GET["anio"]."' AND modulo='".$_GET["modulo"]."' AND llave=0" ;
	   	    $res=$db->query($sql)->fetchColumn();
   
    if($res>0)
    {    
       echo "1";
    }
    else
    {
        echo "0";  
    }
	
	
	
	}
	

?>