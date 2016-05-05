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
  <h1>Registro cobrador &gt; Nuevo</h1>
  <hr />
   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">El Cobrador se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=cobradores">Volver a la Lista de Cobradores.</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   
		   }
	   }?>
 
  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">

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
        <form method="post"   class="contacto"  action="" name="form" id="addVendedor" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
		<div><th valign="top">Nombres :</th>
			<td>  <input type="text" class="inp-form" id="nombres" name="nombres" value="" />
            <?php echo @$e[1] ?></div>
            </td>
			<td></td>
		</tr>
        <tr>
		<div><th valign="top">Apellidos :</th>
			<td><input type="text" class="inp-form" id="apellidos" name="apellidos" value="" />
              <?php echo @$e[2] ?></div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Num de Documento :	</th>
            
			<td><input type="text" class="inp-form" id="carnet" name="carnet" value=""/>
            
            <?php echo @$e[3] ?></div></td>
			<td>
            <th valign="top">Tipo Documento:</th>
            <td>
             <select name="tipo_documento" class="styledselect_form_1" >
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
			<td>  <input type="text" class="inp-form" id="nacionalidad" name="nacionalidad" value="Boliviano" />
            
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Telefono :</th>
			<td><input type="text" class="inp-form" id="telefono" name="telefono" value=""/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Email :</th>
			<td><input type="text" class="inp-form" id="email" name="email" value=""/>
           
           <?php //echo $e[3] ?> </div></td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Direccion :</th>
			<td><input type="text" class="inp-form" id="direccion" name="direccion" value=""/>
             
            </td>
			<td></td>
		</tr>
			<tr>
			<th valign="top">Estado:</th>
			<td><select id="estatus" name="estatus">

    <option value="ACTIVO">ACTIVO</option>
    <option value="PASIVO">PASIVO</option>
    <option value="RETIRADO">RETIRADO</option>


            </select>

            </td>
			<td></td>
		</tr>
         
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
    <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=cobradores','Desea cancelar la operacion actual?.');" />		</td>
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