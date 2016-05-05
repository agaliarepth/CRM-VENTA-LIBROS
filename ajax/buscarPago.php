<?php

require_once("../helpers/conexion.php");
      $id = $_GET['id'];
       $valor=$_GET["v"];
      if(!empty($id)) {
            comprobar($id,$valor);
      }
       
      function comprobar($id,$valor) {
          global $db;
       
            $sql ="SELECT numnpago FROM pagoventascredito , creditoVentas WHERE pagoVentasCredito.creditoVentas_idcreditoVentas=creditoVentas.idcreditoVentas and creditoVentas.idcreditoVentas='".$id."' and pagoVentasCredito.numnpago='".$valor."'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
           if(count($result)>0)
		   echo "1";
		   else
		   echo "0";
             
        
               
         
      }    
?>