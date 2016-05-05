<?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_ventas"])){?>  
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
	
    <script type="text/javascript" src="<?php echo config::ruta();?>js/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="<?php echo config::ruta();?>css/jquery.simple-dtpicker.css" rel="stylesheet" />
	
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

 <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
		
			jQuery("#wizard").validationEngine();
			
				   $("#numcuenta").change(function(){
	    $.ajax({
                              type: "POST",
                              url: "ajax/comprobarCuenta.php",
                              data: "b="+$("#numcuenta").val(),
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  if(data=="no"){
									 alert("Este numero de Cuenta ya esta registrado...."); 
									 $("#numcuenta").val("");
									   $("#numcuenta").focus();
									  n();
									  } 
								
                              }
                  });
	   
	   });
   
		});
            
	</script>
<script language="javascript" type="text/javascript">

	$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombrecobrador").autocomplete({
				source: "ajax/searchCobradores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{	$( "#nombrecobrador" ).val( ui.item.label );
			$( "#cicobrador" ).val( ui.item.valor);
			$( "#idcobrador" ).val( ui.item.idcobradores );
			return false;
				}

	
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Registrar Contrato de Venta > <span style="color:#F33; "> Contrato No:<?php echo $res["numcontrato"];?>  </span></h1>
  <br />
  <hr />
  
  
 
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
	
        <form method="post"   class="contacto"  action="" name="form" id="wizard" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
		<td style="background:#FFC;"><label>Nombres Cobrador :</label>
			  <input type="text" class="inp-form" id="nombrecobrador" name="nombrecobrador" value="<?php echo $res["nombrecobrador"];?>" />
          
            </td>
			
		
		<td><label>Carnet Cobrador :</label></th>
			<input type="text"  readonly="readonly" class="inp-form" id="cicobrador" name="cicobrador" value="<?php echo $res["carnetcobrador"];?>" />
             
            </td>
            <td><label>Nombre Vendedor :</label></th>
			<input type="text" class="inp-form" id="cicobrador" name="cicobrador" value="<?php echo $res["nombrevendedor"];?>" />
             
            </td>
            
            <td  colspan="2"><label>Nombre Cliente :</label></th>
			<input type="text" class="inp4-form" id="cicobrador" name="nombre_cliente" value="<?php  $nombreCompleto="".strtoupper($res["nombres"])." ".strtoupper($res["apellidopaterno"])." ".strtoupper($res["apellidomaterno"]);echo $nombreCompleto;?>"  readonly="readonly"/>
             
            </td>
            
            </tr>
            <tr>
			
		
			<td><label>Numero de Cuenta:</label>
            
			<input type="text"  disabled="disabled" class="validate[required]" style="width:170px; height:27px" id="numcuenta" name="numcuenta" value=""/>
            
           </td>
			
           
		
		<td><label>Numero de Recibo:</label>
            
			<input type="text" class="validate[required]" style="width:170px; height:27px" id="numrecibo" name="numrecibo" value=""/>
            
           </td>
			
            </td>
		
			<td><label>Monto Recibo:</label>
            
			<input type="text" class="validate[required]" style="width:170px; height:27px" id="montorecibo" name="montorecibo" value=""/>
            
           </td>
			
           
       
			<td><label>Fecha Recibo:</label>
			<input type="text" class="fechas" id="fecha" name="fecharecibo" value="<?php echo date("Y-m-d");?>"/>
         
            </td>
			
		
		<td><label>Numero de Reporte:</label>
			  <input type="text" class="inp2-form" id="numreporte" name="numreporte" />
            
            </td>
			<td></td>
		</tr>
        <tr>
        
       
         
        
	<tr>
		<th colspan="2">&nbsp;</th>
		<td valign="top">
			<input type="submit" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" />
            <input type="hidden" name="id" value="enviar"/>
             <input type="hidden" name="regVenta" value="regVenta"/>
             <input type="hidden" name="idcobrador" value="<?php echo $res["idcobrador"];?>"/>
              <input type="hidden" name="idcontrato" value="<?php echo $res["idcontrato"];?>"/>
			<input type="Limpiar" value="" class="form-reset"   onclick="cancelar('<?php config::ruta()?>?accion=contratos');" />
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