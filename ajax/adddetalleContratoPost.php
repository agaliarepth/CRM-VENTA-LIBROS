<?php
/*
require_once("../helpers/conexion.php");
       $idk = $_POST['idk'];
       $idcontrato=$_GET["idc"];
	   $idchofer=$_GET["idchofer"];
	   $idvendedor=$_GET["idvendedor"];
	   $numcontrato=$_GET["numcontrato"];
	    $idlibro=$_GET["idlibro"];
    
         $estadolibro="traspaso";
              global $db;
     		   
		
			$sql="insert into detalle_contrato (cantidad,codigo,titulo,volumen,libros_idlibros,precio_unitario,idkardex,contratos_idcontratos) VALUES ('1','".$_GET["cod"]."','".$_GET["tit"]."','".$_GET["vol"]."','".$idlibro."','".$_GET["pu"]."','".$idk."','".$idcontrato."')";
			 
			 	$res2=$db->query($sql);
				if($res2){
			  if($idchofer==$idvendedor){
				  
				  $sql="UPDATE kardexVendedor SET estado_libro='Diferido',idcontrato='".$idcontrato."',reservado=1 ,num_contrato='".$numcontrato."' WHERE idkardexvendedor=".$idk;
			 
			 	$res2=$db->query($sql);
				  
				  }
				  else{
					  
					   $sql2="UPDATE kardexVendedor SET idcontrato='".$idcontrato."',estado_libro='Traspaso', cargo=10,traspaso=1,reservado=1,num_contrato='".$numcontrato."' WHERE idkardexvendedor=".$idk;
			 
			 	$db->query($sql2);
				
				$sql="SELECT fecha_remision,num_remision,cod_libro,titulo_libro,tomo_libro,idlibro,idalmacenes FROM kardexVendedor WHERE idkardexvendedor='".$idk."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				
		$sql="INSERT INTO kardexVendedor VALUES (NULL,'".$res["fecha_remision"]."','".$res["num_remision"]."','', NULL ,  '".$res["cod_libro"]."','".$res["titulo_libro"]."','Diferido','".$numcontrato."', NULL ,  '',  '".$idvendedor."',  '".$res["tomo_libro"]."','".$res["idlibro"]."','".$res["idalmacenes"]."','".$idcontrato."','0', '0','0');";
					  
					  $res=$db->query($sql);
					  }
			 echo "1";
				}
				
		else{
			
			echo "0";
			}
			 
			*/		
			
			
		   
		   
?>