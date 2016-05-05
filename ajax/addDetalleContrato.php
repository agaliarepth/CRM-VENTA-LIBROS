<?php

/*require_once("../helpers/conexion.php");
      $idlibro = $_POST['idlibro'];
       $idcontrato=$_GET["idc"];
	   $idchofer=$_GET["idchofer"];
	   $idvendedor=$_GET["idvendedor"];
    
         
       
      function getRemitidos($idlibro,$idchofer) {
       global $db;
$sql="SELECT idkardexvendedor  FROM kardexvendedor WHERE idlibro='".$idlibro."'  AND vendedores_idVendedores='".$idchofer."'  AND estado_libro='Remitido' AND traspaso=0 AND (cargo=1 or cargo=0) AND reservado=0 order by fecha_remision asc LIMIT  1";
				
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
             return $res;
	  }
           $res=getRemitidos($idlibro,$idchofer);
		   
		   
		
			$sql="insert into detalle_contrato (cantidad,codigo,titulo,volumen,libros_idlibros,precio_unitario,idkardex,contratos_idcontratos) VALUES ('1','".$_GET["cod"]."','".$_GET["tit"]."','".$_GET["vol"]."','".$idlibro."','".$_GET["pu"]."','".$res["idkardexvendedor"]."','".$_GET["idc"]."')";
			 
			 	$res2=$db->query($sql);
			 
			
			
			$sql="select iddetalle_contrato,cantidad,codigo,titulo,volumen,libros_idlibros,precio_unitario,idkardex,contratos_idcontratos FROM  detalle_contrato  where contratos_idcontratos=".$idcontrato;
			   $fila=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			 
			   $sql="UPDATE  kardexvendedor SET reservado=1 WHERE idkardexvendedor=".$fila["idkardex"];
			   $db->query($sql);
			 
					echo json_encode($fila);
			
			
		   
		   */
?>