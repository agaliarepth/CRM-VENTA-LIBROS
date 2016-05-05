<?php
require_once("../helpers/conexion.php");

	    global $db;
	     
    $validateValue=$_REQUEST['fieldValue'];
	
	  $sql="SELECT numcontrato FROM contratos WHERE numcontrato='". $validateValue."' AND tipocontrato!='BAJA'" ;
	   	    $res=$db->query($sql)->fetchColumn();
 
    $arrayToJs = array();
    if($res>0)
    {    // validate??
        $arrayToJs["response"] = true;    // RETURN TRUE
        echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
    }
    else
    {
        $arrayToJs["response"] = false;
        echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR    
    }
?>