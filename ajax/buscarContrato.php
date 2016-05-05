<?php

require_once("../helpers/conexion.php");
      $numcontrato = $_GET['b'];
       
      if(!empty($numcontrato)) {
            comprobar($numcontrato);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT count(idcontratos) as dispo FROM contratos WHERE numcontrato='".$b."' and tipocontrato!='BAJA'";
			  $result=$db->query($sql)->fetch();
             
                        
        
                  echo $result["dispo"];
         
      }    
?>