<?php

require_once("../helpers/conexion.php");
      $id = $_POST['idvendedor'];
       
      if(!empty($id)) {
            buscar($id);
      }
       
      function buscar($id) {
          global $db;
       
          $sql="SELECT credito,nombres,apellidos,idVendedores from vendedores where idVendedores='".$id."'";
			             
          $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				echo  json_encode(($res));
             
           
      }    
?>