<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
    <script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

  <script type="text/javascript">
		
    var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
    var total=0;
    var precio_total=0;
    var array=new Array();
	var saldofin=0;
	var total_filas_cuotas=0;
	
	
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#numcuenta").autocomplete({
				source: "ajax/buscarcuenta.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: cuentaSeleccionada/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.num_cuenta + " ::" + item.nombre_cliente + "</a>" )
    .appendTo( ul );
};
		});



		
		function cuentaSeleccionada(event, ui)
		{	
			$( "#numcuenta" ).val(ui.item.num_cuenta + " ::" + ui.item.nombre_cliente );
			 $("#idcuenta").val(ui.item.idcredito);
			    $.ajax({
					 
                              type: "GET",
                              url: "ajax/buscarDevolucionObra.php",
                              data: {numcuenta:ui.item.num_cuenta},
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								if(data.response){
									mensaje("Esta cuenta ya  tiene una devolucion registrada. No se puede resistrar doble devolucion","error");
                                   $("#idcuenta").val(0);
                               }
                              }
                  });
			return false;
				}
			
		
	
  $(document).ready(function($)
  {  
  
  saldofin=$("#saldofin").val();
	  <?php 


  if(isset($_POST["consulta"]) && $_POST["consulta"]=='consulta'){
  foreach($res3 as $v){
	  
	  $pt=$v["cantidad"]*$v["precio_unitario"];
	  echo "addTableRow2($v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$pt,$v[libros_idlibros],'".$v["codigo"]."');";
    }
}
?>
  
  
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="number" class="inp2-form"   onchange="cambiarPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td> <input onchange="chequeo(this);" type="checkbox" id="elegido' + nextinput + '" name="elegido[]"  value="'+nextinput+'" /><input type="hidden" name="pu_ant[]" id="pu_ant" value="'+pu+'"/></td></tr>';
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#pu").val('');
$("#num_filas").val(nextinput);
   }
});


function cambiarPrecio (precio) {
  	var p=$("#"+precio.id).val();
  	var p_ant=$("#"+precio.id).parent().parent().find('input').eq(8).val();
	var pt=$("#"+precio.id).parent().parent().find('input').eq(5); 
    var ck=$("#"+precio.id).parent().parent().find('input').eq(7);
   
         if($("#"+ck[0].id).is(':checked')){
            if(parseFloat($("#saldofin").val()-p)<0)
            	alert("mal");

          $("#"+pt[0].id).val(p);



         }
         else{
         	$("#"+precio.id).val(p_ant);
         }
   }
   
  
  	 function validarForm(){
		// alert($("#numfilascuotas").val());
		 
		if(parseFloat(precio_total)<=0){
			
		mensaje("Debe seleccionar al menos 1 item.","error");
			   return false;
			   
			 
			}
			else{
				
					confirmForm($("#wizard"),"Se guardara la nota de devolucion  <br>en fecha <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.");
					
			}
			
			
				  }
		
		 
		 function chequeo(v){
		 	var pt=$("#"+v.id).parent().parent().find('input').eq(5); 
		 	var pu=$("#"+v.id).parent().parent().find('input').eq(4); 
		 
			  if($("#"+v.id).is(':checked')){
				  
				   var pt=$("#"+v.id).parent().parent().find("input").eq(5).val();
	     			precio_total= parseFloat(precio_total)+parseFloat(pt);
		        	 saldofin= parseFloat(saldofin)-parseFloat(pt);
					 $("#saldofin").val(saldofin);
			 
			  if(parseFloat($("#saldo").val())<precio_total){
				 $("#"+v.id).parent().parent().find('input').eq(5).val(parseFloat(saldofin)+parseFloat(pt));
				   $("#"+pu[0].id).val( parseFloat(saldofin)+parseFloat(pt));
				 precio_total+=parseFloat(saldofin);
				 //  $("#"+pt[0].id).val( parseFloat(saldofin)+parseFloat(pt));
				  
				 // mensaje("El monto devuelto no puede ser mayor al saldo restante","warning");
				 // precio_total= parseFloat(precio_total)+parseFloat(pt);
			       //saldofin= parseFloat(saldofin)-parseFloat(pt);
					 $("#saldofin").val(0);
					
			       //$("#"+v.id).attr('checked',false);
				  }
				   
			
			$("#totaldevo").val(precio_total);
			verPlanPagos();
			   return false;
			  } 
			  else{
				  verPlanPagos();
			 
			   var pt=$("#"+v.id).parent().parent().find("input").eq(5).val();
			   precio_total= parseFloat(precio_total)-parseFloat(pt);
			$("#totaldevo").val(precio_total);
			 saldofin= parseFloat(saldofin)+parseFloat(pt);
					 $("#saldofin").val(saldofin);
			   return false;
				  }
			 }
			 
			  function verPlanPagos(){
		 
			total_filas_cuotas=0;
	 $("#campoCuotas tr").remove();
	 
	      var f='';
	    fv=$("#fecha2").val();
		nc=$("#numero_cuotas").val();
		dp= $("#dias_pago").val();
		mt=$("#saldofin").val();
		dg=$("#dias_gracia").val();
		
				
		
	 
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
 
  </script> 

<!--  start nav-outer-repeat................................................... END -->

 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 <table style="width:100% ">
 <tr  style="background-color:#CCEBF4;">
 <td  >
  <h1>Cobranzas > Devolucion Cuenta </h1>
  </td>
 <td>
 <form name="form"   method="post"  action=""  >
      
      
       
        <label for="nombre_vendedor" > <b>CARNET CLIENTE / NUMCUENTA:</b> </label>
        <input type="text" class="inp4-form" id="numcuenta" name="numcuenta" >
          
             
                       
       <input type="hidden" name="idcuenta" id="idcuenta" />

             

        <input type="hidden" name="consulta" value="consulta" />

        
                <input type="submit"  value="BUSCAR CUENTA" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
        </form>
 
 </td>

  </tr>
  </table>
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
	
	<table border="0" width="70%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
<?php
    if(isset($_POST["consulta"]) && $_POST["consulta"]=='consulta'){?>

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="wizard"  >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td colspan="2"> <label for="cliente">Cliente:</label>
		
		<input type="text" class="inp4-form" name="cliente"  readonly="readonly" value="<?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"]?>"/>
		</td>
        <td>
       <label> Num Contrato:</label>
        
        
         
		<input  type="text" class="inp2-form" readonly name="num_contrato"  value="<?php echo $res["numcontrato"];?>"/></td>
       
         <td> <label>Fecha:</label>
           
           <input type="text"   name="fecha" class="fechas" id="fecha" value="<?php echo date("Y-m-d");?>"/>
           
          
            </td>
          
       
       
		</tr> 
        <tr> 
        <td> <label for="cliente">Cobrador:</label>
		
		<input type="text" class="inp-form" name="cobrador" readonly value="<?php echo $cobra->getNombresCobrador($res["idcobrador"]);?>" />
		</td>
        <td> <label for="cliente">Vendedor:</label>
		
		<input type="text" class="inp-form" name="vendedor"  readonly="readonly" value="<?php echo $vendedor->getNombresVendedor($res["idvendedor"]);?>"/>
		</td>
       <td> <label for="cliente">Coordinador:</label>
		
		<input type="text" class="inp2-form" name="coordinador" />
		</td>
        <td> <label for="cliente">Supervisor:</label>
		
		<input type="text" class="inp2-form" name="supervisor" />
		</td>
       
       <td> <label for="cliente">Gerente:</label>
		
		<input type="text" class="inp-form" name="gerente"  />
		</td>
       
       
        </tr>       
      <tr>
       
     
       <td> <label for="cliente">Monto Total Contrato:</label>
		
		<input type="text" class="inp-form" name="preciototal" readonly value="<?php echo $res["preciototal"];?>" />
		</td>
      <td> <label for="cliente">Cuota inicial:</label>
		
		<input type="text" class="inp-form" name="cuotainicial" readonly value="<?php echo $res["cuotainicial"];?>" />
		</td>
        <td colspan="2"> <label for="cliente">Saldo Actual:</label>
		
		<input type="text" class="inp-form"  id="saldo"  name="saldo" readonly value="<?php echo $res["saldo"]-$sumPagos;?>" />
		</td>
    <!--    <td>
        <label for="cliente">Tipo Devolucion:</label>
        <input type="text" class="inp-form"  id="tipo_devolucion" name="tipo_devolucion" readonly  /></td>-->
       </tr>
           <tr>
           <!-- <td colspan="2"><label></label>
           
             <input type="radio" name="tipo_devolucion" value="DEVOLUCION PARCIAL" checked><b> DEVOLUCION PARCIAL </b>     
              <input type="radio" name="tipo_devolucion" value="DEVOLUCION TOTAL" ><b>DEVOLUCION TOTAL</b>       
             
                </td>-->
           <td colspan="4">
           <label>Observacion</label>
           <input type="text" class="inp4-form" name="obs"  />
           </td>
           
           </tr>
           
           </thead>
           </table>
           
<hr />
<table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0">
            
                  
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                            <th colspan="5" align="center" style=" font-weight:bold;" >Seleccionar<br />Devueltos</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                    <tr>
                    <TD colspan="3"></TD>
                    <td colspan="2"><strong>TOTAL DEVOLUCION</strong></td>
                    <TD><input  style="font-weight:bold"type="text" id="totaldevo" class="inp2-form" name="totaldevo" value="0"/></TD>
                    
                    </tr>
                    
                    <tr>
                    <TD colspan="3"></TD>
                    <td colspan="2"><strong>SALDO  ACTUAL</strong></td>
                    <TD><input  style="font-weight:bold"type="text" id="saldofin" class="inp2-form" name="saldofin" value="<?php echo $res["saldo"]-$sumPagos;?>"/></TD>
                    
                    </tr>
                   
                  

      
                </table>	
                <fieldset><legend>REPROGRAMAR PLAN DE PAGOS</legend>
                <table>
                <tr>
                <td><label>Num Pagos</label><input type="text" class="inp2-form" value="1"  id="numero_cuotas" /></td>
                <td><label>Dias de Pago</label><input type="text" class="inp2-form"  value="30" id="dias_pago" /></td>
                <td><label>Dias Gracia</label><input type="text" class="inp2-form" value="0"  id="dias_gracia" /></td>
                <td><label>Fecha Inicio</label><input type="text"  id="fecha2" class="fechas" value="<?php echo date("Y-m-d")?>"/></td>
                <td><label>&nbsp;</label><input type="button" value="CALCULAR" onclick="verPlanPagos();"/></td>
                </tr>
               
                </table>
                <HR />
                <table border="1" cellpadding="0" cellspacing="0" id="tabla-planpagos">
                <thead>
                <th>NumPago</th>
                <th>Fecha<br />Vencimiento</th>
                 <th>MontoPago</th>
                </thead>
                <tbody id="campoCuotas"></tbody>
                
                
                </table>
                </fieldset>
        <table >
        <tr align="center">
		<td valign="center">
		                 
                <input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="validarForm();"  />
                <input type="hidden" name="enviarCuenta" id="enviarCuenta" value="enviarCuenta" />
                <input type="hidden" name="idcontrato" value="<?php echo $res["idcontratos"];?>" />
                <input type="hidden" name="idvendedor" value="<?php echo $res["idvendedor"];?>" />
                <input type="hidden" name="idcobrador" value="<?php echo $res["idcobrador"];?>" />
                <input type="hidden" name="numcuenta" value="<?php echo $res["numcuenta"];?>" />
                <input type="hidden" name="idcredito" value="<?php echo $res["idcredito"];?>" />
                <input type="hidden" id="numfilascuotas" name="numfilascuotas"/>
                <input type="hidden" name="num_filas" id="num_filas" />
               
       
           
		</td>
		<td>			<input type="Limpiar" value="" class="form-reset"  onclick="cancelar('<?php config::ruta()?>?accion=cuentas');" />
</td>
	
	</tr>
                </table>	
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