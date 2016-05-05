<?php

require_once("../helpers/conexion.php");


     global $db;
   
  function comprobar($idkardex) {
          global $db;
       
            $sql ="SELECT count(cod_libro) as disponible FROM kardexVendedor WHERE idkardexvendedor='".$idkardex."' AND estado_libro ='Remitido'  AND (cargo=1 OR cargo=0)  AND traspaso=0";
			  $result=$db->query($sql)->fetch();
             
         
             
            if($result["disponible"]>0){
            
                  return true;
            }else{
                  return false;
            }
      }    
   
     
    

 
	
   
    if( comprobar($_POST["idkardex"]))
    	echo "1";
    else
   echo "0";
	?>