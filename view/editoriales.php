<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_catalogo"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php config::ruta()?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(function() {
	$("input.file_1").filestyle({ 
	image: "images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
});
</script>
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
      <li ><a href="<?php echo config::ruta();?>?accion=addEditoriales"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  
  <h1>Catalogo > Editoriales    </h1>
 
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>
 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteEditoriales" method="post" target="_blank" id="FormularioExportacion">
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
					<th class="">Logo</th>
					<th class="">Nombre</th>
                    <th class="">Direccion</th>
                    <th class="">Telefono</th>
                    <th class="">Email</th>
                    <th class="">Opccines</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					<td><input  type="checkbox"/></td>
					<td><?php echo $v["ideditoriales"];?></td>
                    <td><img src="<?php echo $v["logo"]?>" title="<?php echo $v["nombre"]; ?>"</></td>
                    <td><?php echo $v["nombre"]?></td>
                    <td><?php echo $v["direccion"]?></td>
                    <td><?php echo $v["telefono"]?></td>
                    <td><?php echo $v["email"]?></td>
					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=editEditoriales&e=ee&ie=<?php echo $v["ideditoriales"];?>" title="Editar" class="icon-1 info-tooltip"></a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=editoriales&e=be&ie=<?php echo $v["ideditoriales"];?>');"></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					<th class=""></th>
					<th class="">ID </th>
					<th class="">Logo</th>
					<th class="">Nombre</th>
                    <th class="">Direccion</th>
                    <th class="">Telefono</th>
                    <th class="">Email</th>
                    <th class="">Acciones</th>
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