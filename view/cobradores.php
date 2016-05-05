<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_vendedores"])){?>  

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="miMenu" >
    <ul >
      <li ></li>
      <li ><a href="<?php echo config::ruta();?>?accion=addCobradores"><img src="<?php echo config::ruta();?>images/iconos/add.png"/></a></li>
    </ul>
  </div>
  
  <h1>Cobradores > Listar</h1>
<br />
  <hr />
  </div>

 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteCobradores" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
</form>
</div>
<div id="table-content">
	
				<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				
				<div id="message-blue">
				
				</div>
				<!--  end message-blue -->
			
				<!--  start message-green -->
				<div id="message-green">
				
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">ID </th>
                    <th class="">Codigo</th>
                    <th class="">Nombres</th>
                    <th class="">Num Documento</th>
                    <th class="">Tipo Documento</th>
                     <th class="">Nacionalidad</th>
                    <th class="">Telefono</th>
                    <th class="">Email</th>
                    <th class="">Direccion</th>
                    <th class="">Estatus</th>
                   	<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idcobradores"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                   
                    <td><?php echo $v["nombres"]." ".$v["apellidos"]?></td>
                    <td><?php echo $v["carnet"]?></td>
                     <td><?php echo $v["tipo_documento"]?></td>
                      <td><?php echo $v["nacionalidad"]?></td>
                    <td><?php echo $v["telefono"]?></td>
                    <td><?php echo $v["email"]?></td>
                    <td><?php echo $v["direccion"]?></td>
                    <td style=" <?php if ($v["estatus"]=="Activo") echo "color:green;";?> "><?php echo $v["estatus"]?></td>
                      

					<td >
					<a href="<?php echo config::ruta();?>?accion=editCobradores&e=ec&ic=<?php echo $v["idcobradores"];?>" title="Editar" class="icon-1 info-tooltip"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" /></a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="enviarRuta('<?php echo config::ruta();?>?accion=cobradores&e=bc&ic=<?php echo $v["idcobradores"];?>','Realmente desea eliminar este registro?');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="20" height="20" /></a>
                    	<!--<a href="#" title="Ver Cuentas"  onclick="eliminar('<?php echo config::ruta();?>?accion=cobradores&e=bc&ic=<?php echo $v["idcobradores"];?>');"><img src="../images/contrato.png" width="20" height="20" /></a>-->
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					<th class="">ID </th>
                    <th class="">Codigo</th>
                    <th class="">Nombres</th>
                    <th class="">Num Documento</th>
                    <th class="">Tipo Documento</th>
                    <th class="">Nacionalidad</th>
                    <th class="">Telefono</th>
                    <th class="">Email</th>
                    <th class="">Direccion</th>
                    <th class="">Estatus</th>
                   	<th class="">Opciones</th>
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