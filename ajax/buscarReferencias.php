<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT *  FROM referencias WHERE credito_idcredito='".$id."'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0 && isset($result))
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>