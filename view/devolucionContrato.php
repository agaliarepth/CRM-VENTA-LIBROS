  <?php require_once("head.php");?>
  <?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php config::ruta()?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Registro Devolucion Contrato </h1>
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
		
		<!--  end step-holder -->
	<br />


		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addUsuario"  >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
		<tr>
		<div><th valign="top">Nombres Apellidos Cliente:</th>
			<td><input type="text" class="inp-form" id="nombres_cliente" name="nombres_cliente" value="" /><?php echo @$e[1] ?>
              </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Num contrato:	</th>
            
			<td><input type="text" class="inp-form" id="num_contrato" name="num_contrato" value=""/><?php echo @$e[2] ?>
            
            </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Reg Ventas:</th>
			<td><input type="text" class="inp-form" id="reg_ventas" name="reg_ventas" value=""/>
          
            </td>
			<td></td>
		</tr>
       
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="form.submit();"/>
           <input type="hidden" name="enviar" value="enviar"/>
            <input type="hidden" name="id" value="<?php echo $_GET["id"];?>"/>
             <input type="hidden" name="il" value="<?php echo $_GET["il"];?>"/>
              <input type="hidden" name="ia" value="<?php echo $_GET["ia"];?>"/>
			<input type="Limpiar" value="" class="form-reset"  onclick="limpiar();" />
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


</div>
<!--  end content -->

</div>
<!--  end content-outer -->

 


    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>