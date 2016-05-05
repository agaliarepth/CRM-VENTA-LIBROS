<?php

require_once("../helpers/conexion.php");
      $id= $_POST['idcuenta'];
    
      if(!empty($id)) {
            buscar($id);
      }
       
      function buscar($id) {
          global $db;
     $sql="SELECT sum(monto)as monto FROM pagos WHERE cuentas_idcuentas='".$id."'";
				$res=$db->query($sql)->fetchColumn();
			  		
         if(!isset($res))
		 
		 echo "0";
		 else
		 
                  echo $res;
         
      }    
?>