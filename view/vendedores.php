<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_vendedores"])){?>  

		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
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
      <li ><B>REGISTRAR VENDEDORES</B><a href="<?php echo config::ruta();?>?accion=addVendedores"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  
  <h1>Vendedores > Listar    </h1>

  <hr />
  </div>

 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteVendedores" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
</form>
</div>
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
                    <th>Supervisor</th>
                    <th class="">Credito</th>
                   	<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idVendedores"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                   
                    <td><?php echo $v["nombres"]." ".$v["apellidos"]?></td>
                    <td><?php echo $v["carnet"]?></td>
                     <td><?php echo $v["tipo_documento"]?></td>
                      <td><?php echo $v["nacionalidad"]?></td>
                    <td><?php echo $v["telefono"]?></td>
                    <td><?php echo $v["email"]?></td>
                    <td><?php echo $v["direccion"]?></td>
                    <td style=" <?php if ($v["estatus"]=="Activo") echo "color:green;";?> "><?php echo $v["estatus"]?></td>
                    <td ><?php  echo $c->getNombresVendedor($v["supervisor"]);?></td>
                     <td><?php echo $v["credito"]?></td> 

					<td >
					<a href="<?php echo config::ruta();?>?accion=editVendedores&e=ev&iv=<?php echo $v["idVendedores"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="30" height="30" /></a>
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=vendedores&e=bv&iv=<?php echo $v["idVendedores"];?>');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" /></a>
				
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
                        <th>Supervisor</th>
                     <th class="">Credito</th>
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