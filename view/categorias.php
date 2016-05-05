<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_catalogo"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
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
      
      <li ><B>REGISTRAR CATEGORIAS</B><a href="<?php echo config::ruta();?>?accion=addCategorias"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  
  <h1>Catalogo > Categorias    </h1>
  <hr />
  </div>
<div class="clear">&nbsp;</div>

  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteCategorias" method="post" target="_blank" id="FormularioExportacion">
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
					<td class="red-left">Se intento eliminar una Categoria en forma Erronea....</td>
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
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class=""></th>
					<th class="">ID </th>
                    	<th class="">Codigo</th>
					
					<th class="">Descripcion</th>
					<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					<td><input  type="checkbox"/></td>
					
					<td><?php echo $v["idcategorias"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                    <td><?php echo $v["descripcion"]?></td>

					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=editCategorias&e=ec&ic=<?php echo $v["idcategorias"];?>" title="Editar" class="icon-1 info-tooltip"></a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=categorias&e=bc&ic=<?php echo $v["idcategorias"];?>');"></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					<th class=""></th>
					<th class="">ID </th>
						<th class="">Codigo</th>
					<th class="">Descripcion</th>
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