<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_catalogo"])){?>     
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Catalogo > Libros > Nuevo</h1>
  <br />
  <hr />
   <br />
   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">El Libro se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=libros">Volver a la Lista de Libros.</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   
		   }
	   }?>
 
  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no">1</div>
			<div class="step-dark-left"><a href="">Adicionar Libros</a></div>
            
			<div class="step-dark-right">&nbsp;</div>
	
			
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	<br />
<?php
if (count($res) == 0 || count($res2) == 0) {
   ?>
   <p>No Existen Categorias o Editoriales  Registradas.. <a href="<?php config::ruta()?>?accion=addCategorias">Ingrese nueva Categoria</a>.</p><p><a href="<?php config::ruta()?>?accion=addEditoriales">Ingrese nueva Editorial</a></p>
   <?php 
} else { ?>
   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Categoria :</th>
		<td>	
		<select  class="styledselect_form_1" name="categorias">
        <?php foreach($res as $row){?>
			  <option value="<?php echo $row["idcategorias"];?>"> <?php echo "[".$row["codigo"]."]-".$row["descripcion"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
         <tr>
		<th valign="top">Editoriales:</th>
		<td>	
		<select  class="styledselect_form_1" name="editoriales">
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["ideditoriales"]."/".$row["nombre"];?>"> <?php echo $row["nombre"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
        <tr>
	<th>Foto :</th>
	<td><input type="file" class="file_1" name="logo" id="logo" /></td>
	<td>
	<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 5MB maximo por imagen</div>
	<div class="bubble-right"></div>
	</td>
	</tr>
		
		<tr>
		<div><th valign="top">Codigo :</th>
			<td><input type="text" class="inp-form" id="codigo" name="codigo" value="" />
              <?php echo @$e[1] ?></div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Titulo :	</th>
            
			<td><input type="text" class="inp-form" id="titulo" name="titulo" value=""/>
            
            <?php echo @$e[2] ?></div></td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Numero Tomo :</th>
			<td><input type="text" class="inp-form" id="tomo" name="tomo" value=""/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Precio Base:</th>
			<td><input type="text" class="inp-form" id="precio_base" name="precio_base" value=""/>
           
           <?php //echo $e[3] ?> </div></td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio Final:</th>
			<td><input type="text" class="inp-form" id="precio_final" name="precio_final" value=""/>
              <div id="mensaje1" class="errores"> Ingrese una Descripcion</div>
            </td>
			<td></td>
		</tr>
        <!-- <tr>
			<th valign="top">Sotck :</th>
			<td><input type="text" class="inp-form" id="stock" name="stock" value=""/>
           
            </td>
			<td></td>
		</tr>-->
         <tr>
			<th valign="top">Sotck Minimo :</th>
			<td><input type="text" class="inp-form" id="stock_minimo" name="stock_minimo" value=""/>
           
            </td>
			<td></td>
		</tr>
        <tr>
		<th valign="top">Observaciones :</th>
		<td><textarea rows="" cols="" class="form-textarea" name="observaciones"></textarea></td>
		<td></td>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
			<input type="Limpiar" value="" class="form-reset"  onclick="cancelar('<?php config::ruta()?>?accion=libros');" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>
<?php }?>
	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
  </div>
<div class="clear">&nbsp;</div>

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