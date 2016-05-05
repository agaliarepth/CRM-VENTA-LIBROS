<?php

require_once("../helpers/conexion.php");
      $id = $_POST['idvendedor'];
       
      if(!empty($id)) {
            buscar($id);
      }
       
      function buscar($id) {
          global $db;
       
          $sql="SELECT count(idkardexvendedor) as credito from kardexVendedor where (cargo=1 or cargo=0) AND  estado_libro='Remitido' AND vendedores_idVendedores='".$id."'";
			             
          $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				echo  json_encode(($res["credito"]));
             
           
      }    
?>