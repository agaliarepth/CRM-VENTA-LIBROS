<?php

require_once("../helpers/conexion.php");
       $idingreso = $_POST['idingreso'];
       $cantidad=$_GET["cant"];
	   $codigo=$_GET["cod"];
	   $titulo=$_GET["tit"];
	   $tomo=$_GET["vol"];
	   $idlibro=$_GET["idlibro"];
	   $pu=$_GET["pu"];
	   $pt=$cantidad*$pu;
    
       global $db;
     		   
		
			$sql="INSERT INTO  detalleingreso(cantidad,codigo,titulo,volumen,precio_unitario,precio_total,libros_idlibros,ingreso_idingreso) VALUES ('".$cantidad."','".$codigo."','".$titulo."','".$tomo."','".$pu."','".$pt."','".$idlibro."','".$idingreso."')";
			 
			 	$res2=$db->query($sql);
				
			   if($res2)
				{
					echo "1";
					
					
					}
				
		else{
			
			echo "0";
			}
			 
					
			
			
		   
		   
?>