<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

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
   var  precio_total=0;
    var array=new Array();
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#codigoLabel").autocomplete({
				source: "ajax/searchProductos.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado1/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + " / " + item.titulo + "</a>" )
    .appendTo( ul );
};
		});
		
		
		
		
		
		function productoSeleccionado1(event, ui)
		{
			
			$( "#libro" ).val( ui.item.titulo );
			$( "#stock" ).val( ui.item.stock_disponible );
			$( "#codigoLabel" ).val( ui.item.codigo );
			$( "#pu" ).val( ui.item.precio );
			
			stock=parseInt(ui.item.stock_disponible);
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();
			return false;
			
		}
		
	
  $(document).ready(function($)
  {
	
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
	//adicionarFila();
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo,obs)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" value="'+obs+'"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#pu").val('');
$("#num_filas").val(nextinput);

var tt=$("#campos tr:last").find("input").eq(0).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);

   }
   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	if(typeof(codigo)=="undefined"){
	alert("ERROR::Este codigo de libro No se Encuentra Registrado En El Catalogo");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	alert("ERROR::El Item Num:"+array[array.indexOf(codigo)]+" esta duplicado o No se Encuentra Registrado En El Catalogo.");
	nextinput++;
	
	}
	else{
$("#campos").append(campo);

array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#codigoLabel").val('');
$("#num_filas").val(nextinput);
$("#cantidad").val("");
$("#pu").val("");

$("#codigoLabel").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });
  function prueva(a){
	  
	  alert(a);
	  }
  function adicionarFila(){
			
	
	  $.ajax({
                              type: "POST",
                              url: "ajax/addDetalleIngreso.php?cant="+$("#cantidad").val()+"&cod="+codigo+"&tit="+$( "#libro" ).val()+"&vol="+tomo+"&pu="+$( "#pu" ).val()+"&idlibro="+id,
                              data: "idingreso="+$("#idingreso").val(),
                              dataType: "json",
							  async:true,
							                               error: function(e){
                                    alert("error petición ajax");
									
                              },
                              success: function(data){
								  
								  if(data==1){
									
	                     //  var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	
	                    //  addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
                               prueva("hola");	  
								  }
								  else{
									  
									  alert("error");
									  }
									                                                
                                  
                                  
                              }
                  });
	
			
			 
			}
  
   function eliminarFila(b ){
	  
	     

	      var tt=$("#"+b.id).parent().parent().find("input").eq(0).val();
	  	  var pt=$("#"+b.id).parent().parent().find("input").eq(5).val();
		   var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);




	  nextinput =nextinput -1;
	  
	  
	  if(nextinput==0){
		  total=0;
		  precio_total=0;
		 $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);
		  
		  }
	
		else{ 
		
	total=total-parseInt(tt);
	 
	  precio_total=precio_total-parseFloat(pt);
	  
	  $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);
		}

$("#"+b.id).parent().parent().remove();
	  }
	  
	  
	  
	    function validarCantidad(){
			 var patron = /^\d*$/;  
		
				if($( "#cantidad" ).val()==""){
				alert("ERROR::Ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               alert("ERROR::La Cantidad no es Correcta");
			   return false;
		   }
				else
				return true;
			
			}
			
			function validarExiste(v){
				var va=v;	
				var b=1;
				$("#campos tr").each(function(index) {
					
					var pk=$(this).find("td").eq(1).find("input").attr("value");
					
                    if(pk==va){
					alert("ya existe");
					return true;
					
					
					}
					else{
					 return false;
					 
					}
                });	
				if(b==1)
				return true;
				else
				
				return false;
					}
					
 function dos_decimales(cadena){
var expresion=/^\d+(\.\d{0,2})?$/;
var resultado=expresion.test(cadena);
return resultado;
}
function verificaPrecio(){
var campo = document.getElementById('pu');
if(dos_decimales(campo.value) !== true){
alert('ERROR::formato no valido en el campo Precio');
return false;
}
else
return true;
}
	 function validarCierre(){
					 var anio=$("#fecha").val().slice(0,4);
					 var mes=$("#fecha").val().slice(5,7);
					 var modulo=1;
					 var sw;
					
					  $.ajax({
					  
                              type: "GET",
                              url: "ajax/validarCierre.php?anio="+anio+"&mes="+mes,
                              data: "modulo="+modulo,
                              dataType: "html",
							  async:false,
							
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								
									if(data==1)
								     sw=false;
									else
									sw=true;
									  
									                                                
                                  
                                  
                              }
                  });	
				 
				   return sw;
					 
					 } 
	 
	  function validarEnviar(){
				if(!validarCierre()){
								
								alert("ERROR:: ESTE MES ESTA CERRADO NO SE PUEDE PROCESAR ESTA NOTA EN ESTE MES.")
								return;
								
								}
		
				if(nextinput==0){
					alert("No existen items para enviar ")
					
					return;
					}
				
				else {
					if($("#nombre_envia").val()==""){
						
						alert("Revise el campo Envia");
						return;
						}
					
					
				}
				if(confirm("Se Registrara La nota de Devolucion ?"))
					
					document.form.submit(); 
				
			
			}
 
  </script> 

<!--  start nav-outer-repeat................................................... END -->

 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>ALMACEN > REGISTRO DE NOTA DE INGRESO / NOTA  EGRESO  </h1>
  <hr />
  
 
  <table border="0" width="65%" cellpadding="0" cellspacing="0" id="content-table">
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
	
<?php
if ( count($res2) == 0) {
   ?>
   <p><h1>No Existen Almacenes Registrados.</h1></p>
   <?php 
} else { ?>
   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="wizard"  >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" >
        
		<thead>
        <tr style="background-color:#333; color:#FFF; text-align:center">
        <td colspan="8"> NOTA DE INGRESO</td>
        
        </tr>
        </thead>
		 <tr>
		
		<td>	
        <label>RECIBE ALMACEN</label>
		<select  class="inp-form" name="almacenesIngreso">
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
			
		</select>
		</td>
       
        
		<td>
                <label>CONCEPTO</label> 

        <select  class="inp-form" name="tipoIngreso">
         
			  <option  selected="selected" value="CAMBIO OBRA">CAMBIO OBRA</option>
               
                     
			
		</select></td>
        
            
			<td>
              <label>FECHA</label>
            <input type="text" class="fechas"  name="fechaIngreso" id="fecha" value="<?php echo date("Y-m-d");?>"/>
          
          
            </td>
       
       
		</tr> 
         
        <tr>
			
			<td>
              <label>ENVIA</label>
            <input name="nombre_enviaIngreso"  class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:27px" type="text"  id="nombre_enviaIngreso" value="cobranzas" />
       
            </td>
           
			<td>
             <label>OBSERVACIONES</label>
                      <textarea   name="obsIngreso" cols="35" rows="2" maxlength="150"   ></textarea>

            
         
            </td>
			
      
           
            </tr>
          
           
           </table>
           
<table cellpadding="0" cellspacing="0" width="100%" id="detalle" border="0">
            
                   
                        <tr  style="background-color:#50BBDA; color:#333F;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th  >P/Total</th>
                             <th >Observacion</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   <?PHP 
				   $sumcant1=0;$sumTotal=0; $numfilasIngreso=0;
				   foreach($listaIngreso as  $row){
					   
					   $libro=$l->getId($row["idlibro"]);
					   $numfilasIngreso++;
					   ?>
                   
                   
                    	<tr>
                        <td><input  type="text"  size="1"name="cantidadIngreso[]" value="<?php  $sumcant1+=$row["cant"];echo $row["cant"]?>"/></td>
                        <td><input  type="text" size="5" name="codigoIngreso[]" value="<?php echo $libro["codigo"]?>"/></td>
                        <td><input  type="text" size="70" name="tituloIngreso[]" value="<?php echo $libro["titulo"]?>"/></td>
                        <td><input  type="text"  size="1"name="tomoIngreso[]" value="<?php echo $libro["tomo"]?>"/></td>
                        <td><input  type="text"  size="3"name="precio_unitIngreso[]" value="<?php echo $row["precio_unit"]?>"/></td>
                        <td colspan="2"><input  type="text" size="3" name="precio_totalIngreso[]" value="<?php $pt=$row["cant"]*$row["precio_unit"]; $sumTotal+=$pt; echo($pt);?>"/></td>
                        <td><input  type="text" name="obs_Ingreso[]" value=""/>
                             <input  type="hidden" name="idlibroIngreso[]" value="<?php echo $row["idlibro"];?>"/>
                             
                        </td>
                        
                        </tr>
                     <?php }?>
                    
                    </tbody>
                   <tr>
                   <td colspan="3">
   <input  size="5"  readonly="readonly" name="cant_totalIngreso" class="inp2-form" id="cant_total" value="<?php echo $sumcant1;?>"  /><label for="pu" >CANT TOTAL </label></td>
   <td  colspan="2"></td>
   
   <td></td>
   <td colspan="2">
   <input name="monto_totalIngreso" size="5"  class="inp2-form" readonly  id="monto_total" value="<?php echo $sumTotal;?>" /><label for="monto_total" >MONTO TOTAL</label></td>
   </tr>
                     
                </table>
              <BR />
                <BR />
                <BR />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form"  width="100%">
        
	<thead>
        <tr style="background-color:#333; color:#FFF; text-align:center">
        <td colspan="8"> NOTA DE EGRESO</td>
        
        </tr>
        </thead>
		
		 <tr>
		
              
        <td>
        <select  class="inp-form" name="almacenesEgreso">
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
			
		</select>
        <td>
         <label>DESTINO</label>
        <select  class="inp-form" name="destino">
       
               <option value="CAMBIO OBRA">CAMBIO OBRA</option>
                            
			
		</select></td>
        
          
			<td><label>FECHA</label>
            <input type="text" class="fechas"  name="fechaEgreso" id="fecha2" value="<?php echo date("Y-m-d");?>" />
            
         
            </td>
        
     
       
		</tr> 
          
        <tr>
			
        <td>  <label>RECIBE</label><input name="recibeEgreso" type="text" class="inp-form" id="recibeEgreso" value="cobranzas" /> </td>
           
			
             
			 
			<td>
            <label>OBSERVACIONES</label>
          <textarea  name="obsEgreso" cols="35" rows="2" maxlength="150"   ></textarea>
          
            </td>
            
        </table>
       
<hr />
<table cellpadding="0" cellspacing="0" width="100%" id="detalle">
            
                    <thead>
                    
                     </thead>
                          <tr  style="background-color:#50BBDA; color:#333F;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                             <th >Observacion</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	<?PHP 
				   $sumcant1=0;$sumTotal=0; $numfilasEgreso=0;
				   foreach($listaEgreso as  $row){
					   
					   $libro=$l->getId($row["idlibro"]);
					   $numfilasEgreso++;
					   ?>
                   
                   
                    	<tr>
                        <td><input  type="text"  size="1"name="cantidadEgreso[]" value="<?php  $sumcant1+=$row["cant"];echo $row["cant"]?>"/></td>
                        <td><input  type="text" size="5"name="codigoEgreso[]" value="<?php echo $libro["codigo"]?>"/></td>
                        <td><input  type="text" size="70" name="tituloEgreso[]" value="<?php echo $libro["titulo"]?>"/></td>
                        <td><input  type="text"  size="1"name="tomoEgreso[]" value="<?php echo $libro["tomo"]?>"/></td>
                        <td><input  type="text"  size="3"name="precio_unitEgreso[]" value="<?php echo $row["precio_unit"]?>"/></td>
                        <td colspan="2"><input  type="text" size="3" name="precio_totalEgreso[]" value="<?php $pt=$row["cant"]*$row["precio_unit"]; $sumTotal+=$pt; echo($pt);?>"/></td>
                        <td><input  type="text" name="obs_Egreso[]" value=""/>
                             <input  type="hidden" name="idlibroEgreso[]" value="<?php echo $row["idlibro"];?>"/>
                        </td>
                        
                        </tr>
                     <?php }?>
                     
                    </tbody>
                 <tr>
                 <td colspan="3">
   <input  size="5" value="<?php echo $sumcant1;?>" readonly="readonly" name="cant_totalEgreso" class="inp2-form" id="cant_total"  /><label for="pu" >CANT TOTAL: </label></td>
   <td  colspan="2"></td>
   
   <td></td>
   <td colspan="2">
   <input name="monto_totalEgreso" size="5"  value="<?php echo $sumTotal;?>" class="inp2-form" readonly  id="monto_totalEgreso" /><label for="monto_total" >MONTO TOTAL</label></td>
   </tr>
                     </table>
                     <table style="margin:auto">
                     <tr>
                     <td><input type="submit" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" /></td>
                     <td><input type="Limpiar" value="" class="form-reset"   onclick="cancelar('<?php config::ruta()?>?accion=cambioObrasAlmacen');" /></td>
                     
                     
                     
                     </table>
                     
                     <input  type="hidden" name="guardar" id="guardar" value="guardar"/>
                     <input  type="hidden" name="numfilasIngreso" value="<?php echo $numfilasIngreso?>"/>
                     <input  type="hidden" name="numfilasEgreso" value="<?php echo $numfilasEgreso?>"/>
                     <input  type="hidden" name="idcambioObra" value="<?php echo $_GET["id"];?>"/>
                     <input  type="hidden" name="idcuentas" value="<?php echo $result["credito_idcredito"];?>"/>

                     </form>

<?php } ?>
	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			
			<!-- end related-act-inner -->
		
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