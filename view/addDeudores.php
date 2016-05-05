<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_administracion"])){?>  
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php config::ruta()?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Registro de  Deudores</h1>
  <br />
  <hr />
   <br />
   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"> se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=deudores">Volver a la Lista de DEUDORES..</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   
		   }
	   }?>
 
  <table border="0" width="100%" cellspacing="0" id="content-table">
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
	
	<table border="0" width="100%"  cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  start step-holder -->
		 <?php  if(isset($_GET["e"])&&isset($_GET["id"])&&$_GET["e"]=="ed"){?>

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addVendedor" enctype="multipart/form-data" >
        <fieldset>
		<table border="0"  cellspacing="0"  id="id-form">
       
       	
		<tr>
        <td>
		<label>Primer Nombre:<Label>
		<input type="text" class="inp-form" id="nombre1" name="nombre1" value="<?php echo $res["nombre1"];?>" />
          
            </td>
			<td><label>Segundo Nombre:<Label>
		<input type="text" class="inp-form" id="nombre2" name="nombre2" value="<?php echo $res["nombre2"];?>" /></td>
        <td><label>Apellido Paterno:<Label>
		<input type="text" class="inp-form" id="nombre1" name="paterno" value="<?php echo $res["paterno"];?>" /></td>
        <td><label>Apellido Materno :<Label>
		<input type="text" class="inp-form" id="nombre1" name="materno" value="<?php echo $res["materno"];?>" /></td>
        <td><label>apellido Casado(a):<Label>
		<input type="text" class="inp-form" id="ape_casado" name="ape_casado" value="<?php echo $res["ape_casado"];?>" /></td>
		</tr>
        
        <tr>
        <td>
			<label>Num de Documento :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="num_documento" value="<?php echo $res["num_documento"];?>"/>
            
          </td>
			<td>
           <label>Tipo Documento:	</label>
            
             <select name="tipo_documento" class="inp-form" >
            <option value="Carnet">Carnet</option>
            <option value="Pasaporte">Pasaporte</option>
             <option value="DNI">DNI</option>
              <option value="NIT">NIT</option>
                <option value="Otros">Otros</option>
            
            </select>
            </td>
            <td>
			<label>Documento Extendido en :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="lugar_doc" value="<?php echo $res["lugar_doc"];?>"/>
            
          </td>
           <td>
			<label>Razon Social :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="razon_social" value="<?php echo $res["razon_social"];?>"/>
            
          </td>
          <td><label>Fecha Ingreso vencida:<Label>
		<input type="text" class="fechas" id="fecha" name="fecha_ingreso_vencida" value="<?php echo $res["fecha_ingreso_vencida"];?>" /></td>
		</tr>
         <tr>
         
         <td>
           <label>Tipo Operacion:	</label>
            
             <select name="tipo_operacion" class="inp-form" >
            <option value="VENTA">Venta</option>
            <option value="OTROS">Otros</option>
             
            
            </select>
            </td>
            <td>
			<label>Tipo Cambio :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="tipo_cambio" value="<?php echo $res["tipo_cambio"];?>"/>
            
          </td>
        <td>
			<label>Moneda :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="moneda" value="<?php echo $res["moneda"];?>"/>
            
          </td>
			
            <td>
			<label>Monto Original de la Deuda :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="monto_original_deuda" value="<?php echo $res["monto_original_deuda"];?>"/>
            
          </td>
           <td>
			<label>Concepto :	</label>
            
			 
            
             <select name="concepto" class="inp-form" >
            <option value="LIBROS">LIBROS</option>
            <option value="ESTAFA">ESTAFA</option>
             <option value="SERVICIOS">SERVICIOS</option>
             <option value="OTROS">OTROS</option>
             
            
            </select>
            
          </td>
		</tr>
        <tr>
		 <td>
		<label>Tipo Documento Deuda:<Label>
		 <select name="tipo_doc_deuda" class="inp-form" >
            <option value="CONTRATO">CONTRATO</option>
            <option value="LETRA">LETRA</option>
             <option value="OTROS">OTROS</option>
             
            
            </select>
          
            </td>
			<td><label>Numero Documento Deuda:<Label>
		<input type="text" class="inp-form" id="nombre2" name="num_doc_deuda" value="<?php echo $res["num_doc_deuda"];?>" /></td>
        <td><label>Saldo Deuda Vigente:<Label>
		<input type="text" class="inp-form" id="nombre1" name="saldo_deuda_vigente" value="<?php echo $res["saldo_deuda_vigente"];?>" /></td>
        <td><label>Saldo Deuda Vencida :<Label>
		<input type="text" class="inp-form" id="nombre1" name="saldo_deuda_vencida" value="<?php echo $res["saldo_deuda_vencida"];?>" /></td>
        <td><label>Cobrador(a):<Label>
		<input type="text" class="inp-form" id="ape_casado" name="cobrador" value="<?php echo $res["cobrador"];?>" /></td>
        
		</tr>
        
      <tr>
       <td colspan="4"><label>OBSERVACIONES:<Label>
       <textarea name="obs" cols="50"  maxlength="255" wrap="soft"><?php echo $res["obs"];?></textarea>
       
       </td>
       
       </tr>  
         
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="iddeudores" value="<?php echo $res["iddeudores"];?>"/>
			<input type="Limpiar" value="" class="form-reset"  onclick="limpiar();" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>
<?php }else {?>


 <form method="post"   class="contacto"  action="" name="form" id="addVendedor" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
        <td>
		<label>Primer Nombre:<Label>
		<input type="text" class="inp-form" id="nombre1" name="nombre1" value="" />
          
            </td>
			<td><label>Segundo Nombre:<Label>
		<input type="text" class="inp-form" id="nombre2" name="nombre2" value="" /></td>
        <td><label>Apellido Paterno:<Label>
		<input type="text" class="inp-form" id="nombre1" name="paterno" value="" /></td>
        <td><label>Apellido Materno :<Label>
		<input type="text" class="inp-form" id="nombre1" name="materno" value="" /></td>
        <td><label>apellido Casado(a):<Label>
		<input type="text" class="inp-form" id="ape_casado" name="ape_casado" value="" /></td>
		</tr>
        
        <tr>
        <td>
			<label>Num de Documento :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="num_documento" value=""/>
            
          </td>
			<td>
           <label>Tipo Documento:	</label>
            
             <select name="tipo_documento" class="inp-form" >
            <option value="Carnet">Carnet</option>
            <option value="Pasaporte">Pasaporte</option>
             <option value="DNI">DNI</option>
              <option value="NIT">NIT</option>
                <option value="Otros">Otros</option>
            
            </select>
            </td>
            <td>
			<label>Documento Extendido en :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="lugar_doc" value=""/>
            
          </td>
           <td>
			<label>Razon Social :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="razon_social" value=""/>
            
          </td>
          <td><label>Fecha Ingreso vencida:<Label>
		<input type="text" class="fechas" id="fecha" name="fecha_ingreso_vencida" value="" /></td>
		</tr>
         <tr>
         
         <td>
           <label>Tipo Operacion:	</label>
            
             <select name="tipo_operacion" class="inp-form" >
            <option value="VENTA">Venta</option>
            <option value="OTROS">Otros</option>
             
            
            </select>
            </td>
            <td>
			<label>Tipo Cambio :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="tipo_cambio" value=""/>
            
          </td>
        <td>
			<label>Moneda :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="moneda" value=""/>
            
          </td>
			
            <td>
			<label>Monto Original de la Deuda :	</label>
            
			<input type="text" class="inp-form" id="carnet" name="monto_original_deuda" value=""/>
            
          </td>
           <td>
			<label>Concepto :	</label>
            
			 
            
             <select name="concepto" class="inp-form" >
            <option value="LIBROS">LIBROS</option>
            <option value="ESTAFA">ESTAFA</option>
             <option value="SERVICIOS">SERVICIOS</option>
             <option value="OTROS">OTROS</option>
             
            
            </select>
            
          </td>
		</tr>
        <tr>
		 <td>
		<label>Tipo Documento Deuda:<Label>
		 <select name="tipo_doc_deuda" class="inp-form" >
            <option value="CONTRATO">CONTRATO</option>
            <option value="LETRA">LETRA</option>
             <option value="OTROS">OTROS</option>
             
            
            </select>
          
            </td>
			<td><label>Numero Documento Deuda:<Label>
		<input type="text" class="inp-form" id="nombre2" name="num_doc_deuda" value="" /></td>
        <td><label>Saldo Deuda Vigente:<Label>
		<input type="text" class="inp-form" id="nombre1" name="saldo_deuda_vigente" value="" /></td>
        <td><label>Saldo Deuda Vencida :<Label>
		<input type="text" class="inp-form" id="nombre1" name="saldo_deuda_vencida" value="" /></td>
        <td><label>Cobrador(a):<Label>
		<input type="text" class="inp-form" id="ape_casado" name="cobrador" value="" /></td>
        
		</tr>
       <tr>
       <td colspan="4"><label>OBSERVACIONES:<Label>
       <textarea name="obs" cols="50"  maxlength="255" wrap="soft"></textarea>
       
       </td>
       
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