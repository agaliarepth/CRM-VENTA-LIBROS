<?php
/*require_once("../helpers/conexion.php");

if (isset($_POST['id'])){
	
	
	global $db;
	
	if($_GET['idvendedor']==$_GET["idchofer"]){
       
          $sql="UPDATE  kardexVendedor  set reservado=0,estado_libro='Remitido',num_contrato='',nombres_cliente='',reg_ventas='',traspaso=0 WHERE vendedores_idVendedores='".$_GET['idchofer']."' AND idcontrato='".$_GET["idcontratos"]."' AND cod_libro='".$_GET["codlibro"]."' limit 1";
			 $result=$db->query($sql);
	}
	else{
		
		
		  $sql="UPDATE  kardexVendedor SET reservado=0, estado_libro='Remitido',num_contrato='',nombres_cliente='',reg_ventas='',traspaso=0 WHERE  vendedores_idVendedores='".$_GET['idchofer']."' AND idcontrato='".$_GET["idcontratos"]."' AND cod_libro='".$_GET["codlibro"]."' limit 1";
			 $result=$db->query($sql);
			 
			 
		 $sql="DELETE FROM kardexVendedor WHERE vendedores_idVendedores='".$_GET['idvendedor']."' AND idcontrato='".$_GET["idcontratos"]."' AND cod_libro='".$_GET["codlibro"]."' limit 1";
			 $result=$db->query($sql);
		
		}
			  
			$sql="DELETE FROM detalle_contrato where iddetalle_contrato='".$_GET["iddetalle"]."'"; 
             $result=$db->query($sql);
			 if($result)
			 echo "1";
			 else
			 echo "0";
             
	
}
*/
?>