<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_cobranzas"])){?>  
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php config::ruta()?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Cobradores &gt; Editar</h1>

  <hr />

   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">El Vendedor  se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=vendedores">Volver a la Lista de Vendedores.</a></td>
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
	

		</div>
		<!--  end step-holder -->
	<br />

   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="editVendedor"  >
   
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
		<div><th valign="top">Nombres :</th>
			<td>  <input type="text" class="inp-form" id="nombres" name="nombres" value="<?php echo $res["nombres"];?>" />
            <?php echo @$e[1] ?></div>
            </td>
			<td></td>
		</tr>
        <tr>
		<div><th valign="top">Apellidos :</th>
			<td><input type="text" class="inp-form" id="apellidos" name="apellidos" value="<?php echo $res["apellidos"];?>" />
              <?php echo @$e[2] ?></div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Num de Documento :	</th>
            
			<td><input type="text" class="inp-form" id="carnet" name="carnet" value="<?php echo $res["carnet"];?>"/>
            
            <?php echo @$e[3] ?></div></td>
			<td>
            
             <label>Tipo de Documento</label>
             <select name="tipo_documento" >
            <option value="Carnet">Carnet</option>
            <option value="Pasaporte">Pasaporte</option>
             <option value="DNI">DNI</option>
              <option value="NIT">NIT</option>
                <option value="Otros">Otros</option>
            
            </select>
            </td>
            </td>
		</tr>
          <tr>
		<th valign="top">Nacionalidad:</th>
			<td>  <input type="text" class="inp-form" id="nacionalidad" name="nacionalidad" value="<?php echo $res["nacionalidad"];?>" />
            
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Telefono :</th>
			<td><input type="text" class="inp-form" id="telefono" name="telefono" value="<?php echo $res["telefono"];?>"/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Email :</th>
			<td><input type="text" class="inp-form" id="email" name="email" value="<?php echo $res["email"];?>"/>
           
           <?php //echo $e[3] ?> </div></td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Direccion :</th>
			<td><input type="text" class="inp-form" id="direccion" name="direccion" value="<?php echo $res["direccion"];?>"/>
             
            </td>
			<td></td>
		</tr>
         	<tr>
			<th valign="top">Estado:</th>
			<td><select id="estatus" name="estatus">

    <option value="ACTIVO" <?php if($res["estatus"]=='ACTIVO'){ ?> selected="selected" <?php }?>>ACTIVO</option>
    <option value="PASIVO"  <?php if($res["estatus"]=='PASIVO'){ ?> selected="selected" <?php }?>>PASIVO</option>
    <option value="RETIRADO"  <?php if($res["estatus"]=='RETIRADO'){ ?> selected="selected" <?php }?>>RETIRADO</option>


            </select>

            </td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="idValor" value="<?php echo $res["idcobradores"]; ?>"/>
            <input type="hidden" name="id" value="enviar"/>
    <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=cobradores','Desea cancelar la operacion actual?.');" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>

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