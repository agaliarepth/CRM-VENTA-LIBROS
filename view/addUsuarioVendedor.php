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
  <h1>Usuarios  Vendedores>  Nuevo</h1>
  <br />
  <hr />
   <br />

 
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
			<div class="step-dark-left"><a href="">Registrar Usuario</a></div>
            
			<div class="step-dark-right">&nbsp;</div>
	
			
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	<br />
<?php
if (count($res) == 0) {
   ?>
   <p>No Existen Roles de Usuarios Registrados.. <a href="<?php config::ruta()?>?accion=addPerfil">Ingrese nuevo Rol de Usuario</a>.</p>
   <?php 
} else { ?>
   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addUsuario"  >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Roles de Usuario:</th>
		<td>	
		<select class="styledselect_form_1" name="perfiles_idperfiles">
        <?php foreach($res as $row){?>
			  <option value="<?php echo $row["idperfiles"];?>"> <?php echo $row["descrip"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
     
		
		<tr>
		<div><th valign="top">Nombres Apellidos:</th>
			<td><input type="text" class="inp-form" id="nombres" name="nombres" value="<?php echo "".$user["nombres"]." ".$user["apellidos"]; ?>" readonly />
              </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Username:	</th>
            
			<td><input type="text" class="inp-form" id="username" name="username" value=""/><?php echo @$e[1] ?>
            
            </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Contraseña :</th>
			<td><input type="text" class="inp-form" id="password" name="password" value=""/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Cargo Desempeña:</th>
			<td><input type="text" class="inp-form" id="cargo" name="cargo" value="Vendedor" readonly/>  
            <input type="hidden" name="idvendedores" value="<?php echo $user["idVendedores"]; ?>" />
          </div></td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
			<input type="Limpiar" value="" class="form-reset"  onclick="limpiar();" />
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