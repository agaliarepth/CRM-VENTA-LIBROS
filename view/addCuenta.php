<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="<?php echo config::ruta();?>css/jquery.simple-dtpicker.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>

  <script type="text/javascript">
  	 var total_filas_cuotas =0;

	$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre_cobrador").autocomplete({
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
		{	$( "#nombre_cobrador" ).val( ui.item.label );
			$( "#idcobrador" ).val( ui.item.idcobradores );
			return false;
				}
  
  $(document).ready(function($)
  
  {  	
  
  
  verPlanPagos();
  
	  
	 
  function verPlanPagos(){
	
	  	total_filas_cuotas=0;
	
	 
	      var f='';
	    fv=$("#fechaFacturado").val();
		nc=$("#numero_cuotas").val();
		dp= parseInt($("#numero_cuotas").val()*30);
		mt=$("#saldo_actual").val();
		dg=0;
		
				
		
	 
	  $.ajax({
					 
                              type: "GET",
                              url: "ajax/planPagos.php?gracia="+dg+"&monto="+mt+"&cuotas="+nc+"&fecha="+fv+"&dias="+dp,
                              data: "1",
                              dataType: "json",
                              error: function(){
                                   // alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								  										
										for(i=0;i<=data.length;i++){
										
										
										//alert(data[i].numcuota);
										addRowCuotas(data[i].numcuota,data[i].fecha,data[i].monto);
																													
											}
											
                                      
									
										
										
									
									  n();
									                                                
                                  
                                  
                              }
                  });
	 }
   
     function addRowCuotas(cuota,fecha,monto){
	  
f="<tr><td><input type='text' size=5 name='numcuota[]' value='"+cuota+"'></td><td><input type='text' size=10 name='fechacuota[]' value='"+fecha+"'></td><td><input type='text' size=8 name='montocuota[]'  readonly id='montocuota' value='"+monto+"'></td></tr>";
	
		  
	 $("#campoCuotas").append(f);
	total_filas_cuotas++;
	$("#numfilascuotas").val(total_filas_cuotas);
	  
	  }
   
   
   
  });
  
  


 
  </script> 

<!--  start nav-outer-repeat................................................... END -->

 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Registro de Cuenta </h1>
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
			<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="wizard"  onsubmit="return validarForm();" >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td colspan="2"> <label for="cliente">Cliente:</label>
		
		<input type="text" class="inp4-form" name="cliente"  readonly="readonly" value="<?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?>"/>
		</td>
         <td colspan="0" >
       <label>Carnet:</label>
        
        
         
		<input  type="text" class="inp2-form" readonly name="ci_cliente"  value="<?php echo $res["ci"];?>"/></td>
       
        <td>
       <label> Num Contrato:</label>
        
        
         
		<input  type="text" class="inp2-form" readonly name="num_contrato"  value="<?php echo $res["numcontrato"];?>"/></td>
       <td>
       <label> Cod Cliente</label>
        
        
         
		<input  type="text" class="inp2-form" readonly name="num_cuenta"  value="<?php echo $res["numcuenta"];?>"/></td>
         <td> <label>Fecha Contrato: </label>
           
           <input type="text"   name="fecha" class="fechas" readonly   value="<?php echo $res["fechacontrato"];?>"/>
           <input type="hidden"   name="fechaContrato"   value="<?php echo $res["fechacontrato"];?>"/>
           
          
            </td>
          
       
       <td> <label>Fecha Facturacion: </label>
           
           <input type="text"   name="fechaFacturado" id="fechaFacturado" class="fechas" readonly   value="<?php echo $cred["fechadoc"];?>"/>
           
          
            </td>
          
       
		</tr> 
        <tr> 
        <td style="background-color:#85BEE0"> <label for="cliente">Cobrador:</label>
		
		<input type="text" class="inp-form" name="nombre_cobrador" id="nombre_cobrador" value="<?php echo $cobrador->getNombresCobrador($res["idcobrador"]);?>" />
		</td>
        <td> <label for="cliente">Vendedor:</label>
		
		<input type="text" class="inp-form" name="nombre_vendedor"  readonly="readonly" value="<?php echo $vendedor->getNombresVendedor($res["idvendedor"]);?>"/>
		</td>
       <td> <label for="cliente">Monto Cuenta:</label>
		
		<input type="text" class="inp2-form" name="monto_total"  readonly="readonly"  value="<?php echo $res["preciototal"];?>" />
		</td>
        <td> <label for="cliente">Saldo Inicial:</label>
		
		<input type="text" class="inp2-form" name="saldo" id="saldo" readonly value="<?php echo $cred["saldo"];?>" />
		</td>
          <td> <label for="cliente">Saldo_actual:</label>
		
		<input type="text" class="inp2-form" name="saldo_actual"  id="saldo_actual"  value="<?php echo $cred["saldo"];?>" readonly />
		</td>
        <td> <label for="cliente">Num Pagos:</label>
		
		<input type="text" class="inp2-form" name="numero_cuotas" id="numero_cuotas" readonly value="<?php echo $res["numcuotas"];?>" />
		</td>
     <td> <label for="cliente">Cu Mensual:</label>
		
		<input type="text" class="inp2-form" name="cuotamensual" value="<?php echo $res["montocuotas"];?>"/>
		</td>
        
        
       
       
        </tr>
        <tr> 
        <td> <label for="cliente">Zona:</label>
		
		<input type="text" class="inp-form" name="zona" value="<?php echo $referencia["zona"];?>"  />
		</td>
        <td> <label for="cliente">Barrio:</label>
		
		<input type="text" class="inp-form" name="barrio"  value="<?php echo $referencia["barrio"];?>"/>
		</td>
       <td colspan="2"> <label for="cliente">Direccion:</label>
		
		<input type="text" class="inp-form" name="dir"   value="<?php echo $referencia["direccion"];?>" />
		</td>
        <td> <label for="cliente">Telf:</label>
		
		<input type="text" class="inp2-form" name="telf" value="<?php echo $referencia["telf"];?>" />
		</td>
       
     <td colspan="2"> <label for="cliente">Lugar Cobranza:</label>
		
		<input type="text" class="inp-form" name="lugar" value="<?php echo $referencia["lugarcobranza"];?>"/>
		</td>
        <td> <label for="cliente">Dia Cobranza:</label>
		
		<input type="text" class="inp2-form" name="diacobranza"  value="<?php echo $referencia["diacobrar"];?>" />
		</td>
       
       
        </tr>              
      <tr>
       
     
       <td> <label for="cliente">Verificador:</label>
		
		<input type="text" class="inp-form" name="verificador"  />
		</td>
      <td> <label for="cliente">Transferencia:</label>
		
		<input type="text" class="inp-form" name="transferencia"  />
		</td>
        <td colspan="2"> <label for="cliente">Supervisor:</label>
		
		<input type="text" class="inp-form" name="sup"  />
		</td>
         <td colspan="2"> <label for="cliente">G.C.:</label>
		
		<input type="text" class="inp-form" name="gc"  />
		</td>
         <td colspan="2">
        <label for="cliente">Observaciones</label>
        <textarea name="obs" id="obs"></textarea>
        </td>
       </tr>
          
           
           </thead>
           </table>
           
<hr />
<table width="80%" >
<tr>
<td>
<table cellpadding="5" cellspacing="5"  id="detalle" border="0"  width="95%" >
            
                   
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cant</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Vol</th>
                           
                            
                            
                          
                        </tr>
                        
                        <?php foreach($res2 as $v){?>
                        <tr>
                        <td align="center"><?php echo $v["cantidad"];?></td>
                        <td align="center" style="font-weight:bold"><?php echo $v["codigo"];?></td>
                        <td><?php echo $v["titulo"];?></td>
                        <td align="center"><?php echo $v["volumen"];?></td>
                        </tr>
                   <?php }?>
                                   
                  

      
                </table>	
                </td>
               
                <td>
        <table border="1" cellpadding="0" cellspacing="0" >
                <tr style="background-color:#333; color:#CCC" >
                <th colspan="3" >PLAN DE  PAGOS</th>
                </tr>
                
                <TR>
                <th>NUN CUOTA</th>
                
                <TH>FECHA <BR />VENCIMIENTO</TH>
                <TH>MONTO (Bs)</TH>
                </TR>
                <tbody id="campoCuotas"></tbody>
                
                </table>	
                </td>
                </tr>
                </table>
        
        <table  style="margin-top:15px;">
        <tr align="center">
		<td valign="center">
			

                  
                  <input type="submit" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" />
                 <input type="hidden" name="enviarCuenta" id="enviarCuenta" value="enviarCuenta" />
               
                <input type="hidden" name="idcontrato" value="<?php echo $res["idcontratos"];?>" />
                  <input type="hidden" name="idvendedor" value="<?php echo $res["idvendedor"];?>" />
                    <input type="hidden" name="idcobrador" id="idcobrador" value="<?php echo $res["idcobrador"];?>" />
             <input type="hidden" name="cuotainicial" value="<?php echo $cred["cuotainicial"];?>" />

                
                 
                  <input type="hidden" name="num_filas" id="num_filas" />
                  <input type="hidden" name="numfilascuotas" id="numfilascuotas" value="" />

               
            </form>
		</td>
		<td>			
       
        <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=contratosFacturados','Desea cancelar la operacion actual?.');" />
</td>
	
	</tr>
                </table>
                
                
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
</tr>
</table>

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

 	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});
            
	</script>

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>