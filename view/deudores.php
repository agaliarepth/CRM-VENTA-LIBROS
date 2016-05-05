<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_administracion"])){?>  

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="miMenu" >
    <ul >
      <li ></li>
      <li ><a href="<?php echo config::ruta();?>?accion=addDeudores"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  
  <h1>Deudores> Listar    </h1>
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">
<?php 
if(isset($_GET["m"])){
	
	switch($_GET["m"]){
		case '1': break;
		case '1': break;
		case '3':{ ?>
        <div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Se intento eliminar un Venmdedor  en forma Erronea....</td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		}
	
	}


?>			
				<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				<!--  end message-yellow -->
				
				<!--  start message-red -->
				
				<!--  end message-red -->
				
				<!--  start message-blue -->
				<div id="message-blue">
				
				</div>
				<!--  end message-blue -->
			
				<!--  start message-green -->
				<div id="message-green">
				
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table" style="font-size:8px;">
                <thead style="font-size:8px;">
				<tr>
					<th>Acciones</th>
					<th class="">Tipo</br>Docu</th>
                    <th class="">Num</br>Docu</th>
                    <th class="">Ext</th>
                    <th class="">Razon Social</th>
                    <th class="">Primer Nom</th>
                     <th class="">Segundo Nombre</th>
                    <th class="">Apellido</br>Paterno</th>
                    <th class="">Apellido</br>Materno</th>
                    <th class="">Apellido</br>Casado(a)</th>
                    <th class="">Tipo</br>Operacion</th>
                   	<th class="">Tipo Cambio</th>
                   	<th class="">Moneda</th>
                    <th class="">Monto </br>Original</br>Deuda</th>
                    <th class="">Concepto</th>
                   	<th class="">Tipo Documento</th>
                   	<th class="">Num Documento</th>
                    <th class="">Saldo </br>Deuda</br>Vigente</th>
                    <th class="">Saldo </br>Deuda</br>Vencida</th>
                    <th class="">Cobrador</th>
                    <th class="">Fecha</br>Ingre</br>Vencida</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					<td >
					<a href="<?php echo config::ruta();?>?accion=addDeudores&e=ed&id=<?php echo $v["iddeudores"];?>" title="Editar" class="icon-1 info-tooltip"></a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=deudores&e=bd&id=<?php echo $v["iddeudores"];?>');"></a>
				
					</td>
					<td><?php echo $v["tipo_documento"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["num_documento"];?></td>
                   
                    <td><?php echo $v["lugar_doc"];?></td>
                    <td><?php echo $v["razon_social"]?></td>
                     <td><?php echo $v["nombre1"]?></td>
                      <td><?php echo $v["nombre2"]?></td>
                    <td><?php echo $v["paterno"]?></td>
                    <td><?php echo $v["materno"]?></td>
                    <td><?php echo $v["ape_casado"]?></td>
                    <td><?php echo $v["tipo_operacion"]?></td>
                      <td><?php echo $v["tipo_cambio"]?></td>
                    <td><?php echo $v["moneda"]?></td>
                    <td><?php echo $v["monto_original_deuda"]?></td>
                    <td><?php echo $v["concepto"]?></td>
                   <td><?php echo $v["tipo_doc_deuda"]?></td>
                      <td><?php echo $v["num_doc_deuda"]?></td>
                    <td><?php echo $v["saldo_deuda_vigente"]?></td>
                    <td><?php echo $v["saldo_deuda_vencida"]?></td>
                    <td><?php echo $v["cobrador"]?></td>
                     <td><?php echo $v["fecha_ingreso_vencida"]?></td>
                      

					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
                <th>Acciones</th>
						<th class="">Tipo</br>Docu</th>
                    <th class="">Num</br>Docu</th>
                    <th class="">Ext</th>
                    <th class="">Razon Social</th>
                    <th class="">Primer Nom</th>
                     <th class="">Segundo Nombre</th>
                    <th class="">Apellido</br>Paterno</th>
                    <th class="">Apellido</br>Materno</th>
                    <th class="">Apellido</br>Casado(a)</th>
                    <th class="">Tipo</br>Operacion</th>
                   	<th class="">Tipo Cambio</th>
                   	<th class="">Moneda</th>
                    <th class="">Monto </br>Original</br>Deuda</th>
                    <th class="">Concepto</th>
                   	<th class="">Tipo Documento</th>
                   	<th class="">Num Documento</th>
                    <th class="">Saldo </br>Deuda</br>Vigente</th>
                    <th class="">Saldo </br>Deuda</br>Vencida</th>
                    <th class="">Cobrador</th>
                    <th class="">Fecha</br>Ingre</br>Vencida</th>
				</tr>
				</tfoot>
                <tbody>
				</table>
				<!--  end product-table................................... --> 
				
			</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>