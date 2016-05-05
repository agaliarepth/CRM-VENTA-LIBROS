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
  <h1>Roles de Usuario  > Nuevo</h1>
  <br />
  <hr />
   <br />
   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">Este Rol de Usuario se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=roles">Volver...</a></td>
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
			<div class="step-dark-left"><a href="">Rol de Usuario</a></div>
			<div class="step-dark-right">&nbsp;</div>
	
			
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	
		<!-- start id-form -->
        <form method="post"  action="" name="form" id="addPerfil" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <th valign="top">Descipcion :</th>
			<td><input type="text" class="inp-form" id="descrip" name="descrip" value=""/></td></tr>
		<tr>
			<fieldset  ><legend align="center">
            Modulo Catalogo</legend>
          <input type="checkbox" name="modulo_catalogo" value="1"  ><b > modulo Catalogo</b>
            </fieldset>
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Almacenes</legend>
             <input type="checkbox" name="modulo_almacenes" value="1"><b > modulo Almacenes</b>
            </fieldset>
			
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Vendedores</legend>
             <input type="checkbox" name="modulo_vendedores" value="1" ><b > modulo Vendedores</b>
            </fieldset>
			
		</tr>
        <fieldset  ><legend align="center">
            Modulo Pagina de Vendedor</legend>
             <input type="checkbox" name="modulo_yovendedor" value="1"><b > modulo Pagina de Vendedor</b>
            </fieldset>
			
		</tr>
        </tr>
        <fieldset  ><legend align="center">
            Modulo Administracion</legend>
             <input type="checkbox" name="modulo_administracion" value="1"><b > modulo Administracion</b>
            </fieldset>
			
		</tr>
		
         </tr>
        <fieldset  ><legend align="center">
            Modulo Ventas</legend>
             <input type="checkbox" name="modulo_ventas" value="1"><b > modulo Ventas</b>
            </fieldset>
			
		</tr>
         </tr>
        <fieldset  ><legend align="center">
            Modulo Cobranzas</legend>
             <input type="checkbox" name="modulo_cobranzas" value="1"><b > modulo Cobranzas</b>
            </fieldset>
			
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
	<!-- end id-form  -->
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