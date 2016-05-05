<?php

require_once("../helpers/conexion.php");
      $numcuenta = $_GET['numcuenta'];
       
    echo comprobar($numcuenta);

      function comprobar($numcuenta) {
          global $db;
          $response=array();
            $sql ="SELECT count(iddevolucionObras) as dispo FROM devolucionobras WHERE num_cuenta='".$numcuenta."' ";
			  $result=$db->query($sql)->fetchColumn();
        if($result>0)
          $response=["response"=>true];
        else

             $response=["response"=>false];

           return json_encode($response);
                        
        
         
      }    
?>