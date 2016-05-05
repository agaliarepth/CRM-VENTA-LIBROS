<?php
require_once("../helpers/conexion.php");



	
	
	global $db;
       
          $sql="SELECT numcuentacontrato,idcontrato FROM `contratos` WHERE tipocontrato='Venta' order by numcuentacontrato asc";
			 $result=$db->query($sql);
			  $c=459;
			foreach($result as $v){
				$sql="update `contratos` set numcuentacontrato=".$c;
				 $res=$db->query($sql);
				$c++;
				}
            
             


?>