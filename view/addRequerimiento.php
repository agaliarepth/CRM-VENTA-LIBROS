<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
  
  <script type="text/javascript">

  
    var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
   var array=new Array();
   var sumRemitidos;
 
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
		
		
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre_vendedor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: vendedorSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		
		
		
		
		function vendedorSeleccionado(event, ui)
		{
			
			
			
			getCredito(ui.item.idVendedor,ui.item.credito);
			$( "#nombre_vendedor" ).val( ui.item.label );
			$( "#ci_vendedor" ).val( ui.item.valor);
			$( "#id_vendedor" ).val( ui.item.idVendedor);
			
			
			return false;
			
		}
		
		
		 function getCredito(id,credito){
			
			 
			 $.ajax({
					  
                              type: "POST",
                              url: "ajax/getCreditoVendedor.php",
                              data: "idvendedor="+id,
                              dataType: "json",
                              error: function(){
                                     mensaje("ERROR:: petición ","error");
                              },
                              success: function(data){
								
							data= parseInt(data);
							sumRemitidos=data;
							 $( "#credito").val(parseInt(credito)-sumRemitidos-actualizarCredito());
								
									  n();
									                                                
                                  
                                  
                              }
                  });
				
			 }
			 
			  function getVendedor(id){
			
			 
			 $.ajax({
					  
                              type: "POST",
                              url: "ajax/getVendedor.php",
                              data: "idvendedor="+id,
                              dataType: "json",
                              error: function(){
                                    mensaje("ERROR:: petición ","error");
                              },
                              success: function(data){
								
							$("#sumremi").val(data.credito);
								//alert($("#sumremi").val());
									  n();
									                                                
                                  
                                  
                              }
                  });
				
			 }
		
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			var i=$("#id_almacenes").val();
			
			$("#codigoLabel").autocomplete({
				source: "ajax/searchProductos2.php?id="+i, 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
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
			var i2=$("#id_almacenes").val();
			$( "#libro" ).val( ui.item.titulo );
			//$( "#stock" ).val( ui.item.stock );
			$( "#codigoLabel" ).val( ui.item.codigo);
			
			//stock=parseInt(ui.item.stock);
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();
			
			$.ajax({
					  
                              type: "POST",
                              url: "ajax/getStockDisponible.php?idalmacen="+i2,
                              data: "idlibro="+ui.item.id,
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								
									 $( "#stock" ).val(data);
									  n();
									                                                
                                  
                                  
                              }
                  });
			return false;
			
		}
		


  $(document).ready(function($)
  {
	 
	 
	   $("#cantidad").bind('keypress', function(event)
	{
	if (event.keyCode == '13')
		{
	if(validarCantidad()&&validarStock()&& validarVendedor())
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, id);
	
		}//fin de code
	
	});
	
	  
	  	  	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="s"){

  foreach($res3 as $v){
	  echo "addTableRow2($v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[libros_idlibros],'".$v["codigo"]."');";
	  
	 
	   
    }
	
	echo ' getCredito($( "#id_vendedor" ).val(),'.$vendedor["credito"].');';
	

	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
 
	
	if(validarCantidad()&&validarStock()&& validarVendedor())
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, id);
	
    
   });
   
     function addTableRow2( cantidad, titulo, tomo,id,codigo)
   {
    campo = '<tr ><td>'+parseInt(nextinput+1)+'</td><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;

$("#libro").val('');
$("#stock").val('');
$("#num_filas").val(nextinput);
$("#codigoLabel").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
total=total+parseInt(tt);
$("#cant_total").val(total);
$("#cantidadTotal").val(total);

$("#num_filas").val(nextinput);
$("#codigoLabel").val("");
$("#cantidad").val("");

   }
   
   
   function addTableRow( cantidad, titulo, tomo,id)
   {
    campo = '<tr ><td>'+parseInt(nextinput+1)+'</td><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	mensaje("!!!Ya existe este Item en la Lista.","error");
	
	
	}
	else{
		if(parseInt( $("#credito").val())<cantidad){
			mensaje("No tiene suficiente credito!!!","warning");
			
			}
			else{
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;

$("#libro").val('');
$("#stock").val('');
$("#num_filas").val(nextinput);
$("#codigoLabel").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
total=total+parseInt(tt);
$("#cant_total").val(total);
$("#cantidadTotal").val(total);

$("#num_filas").val(nextinput);
$("#codigoLabel").val("");
$("#cantidad").val("");

 $("#credito").val(parseInt( $("#credito").val())-cantidad);

   }
   
	}
   }

  });
  
  
  
   function eliminarFila(b ){
	  
	 
	   var tt=$("#"+b.id).parent().parent().find("input").eq(0).val();
	   var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);
	  	
	 
	  nextinput =nextinput -1;
	 if(nextinput===0)
	  total =0;
	  else
	  total=parseInt(total)-parseInt(tt);
	   $("#credito").val(parseInt( $("#credito").val())+parseInt(tt));
$("#"+b.id).parent().parent().remove();

$("#cant_total").val(total);
$("#cantidadTotal").val(total);
$("#num_filas").val(nextinput);


	  return false;
	  }
	    function validarCantidad(){
			 var patron = /^\d*$/;  
			if(parseInt($( "#stock" ).val())<parseInt($( "#cantidad" ).val())){
				mensaje("No hay suficiente stock o no hay registro de cantidad.","warning");
				return false;
				
				
				}
				if($( "#cantidad" ).val()==""){
				mensaje("ingrese un cantidad","warning");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               mensaje("cantidad es incorrecta","warning");
			   return false;
		   }
				else
				return true;
			
			}
			
					
             function validarStock(){
				 
				 if($("#stock").val()==""){
				 mensaje("No selecciono un libro.","warning");
				 return;
				 }
				 else return true;
				 
				 }
				 
				 function validarVendedor(){
					if( $("#id_vendedor").val()!='')
					return true;
					else{
						
					mensaje("Seleccione un vendedor","warning");
					$("#nombre_vendedor").focus();
					return false;
					}
					 }
					 
					 function actualizarCredito(){
				
		   total=0;
		   
		   $('#campos tr').each(function () {
			   
			 
			total=total+parseInt($(this).find("input").eq(0).val());
			
			   
			   });
		  
		 	   return(total);

		   
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
                                    mensaje("error petición ajax","error");
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
								
								mensaje("ERROR:: ESTE MES ESTA CERRADO NO SE PUEDE PROCESAR ESTA NOTA EN ESTE MES.","error");
								return;
								
								}
		
			
				if(nextinput==0){
					
			mensaje("No existen items para enviar.","error");
			
					
					return;
					}
				
				else {
					if($("#nombre_vendedor").val()==""){
						
						mensaje("Revise el campo Vendedor","warning");
						return;
						}
						
							if(parseInt($("#credito").val())<0){
							mensaje("NO TIENE SUFICIENTE CREDITO","warning");
							return;
							
							}
							
							
					
					
				}
				
			
				confirmForm($("#addLibros"),"Se hara efectiva la nota de requerimiento en fecha <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.");
					
				
			
			}
  
	  
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading" >
  <h1>Requerimiento de Mercaderia  > Nuevo</h1>
 
  <hr />
  
  
 
  <table border="0" width="70%" cellpadding="0" cellspacing="0" id="content-table">
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
	<div id="content-table-inner" >
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" >
	<tr valign="top" >
	<td>
	
	<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        
	 <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){   $res5=$ve->listarTodos();?>
	 
     <tr>
        
         
	<th  ><label>Nombre Vendedor :</label></th>
			<td colspan="2">
            <input type="text"  class="inp4-form" id="nombre_vendedor" name="nombre_vendedor"  value="<?php echo $res4["nombre_vendedor"]; ?>">
           
            </td>
           
             <td colspan="2">
            <label>Credito Actual:</label>
            <input class="inp2-form" type="text" id="credito" readonly />
            
            </td>
			<td colspan="3"><label>Fecha:</label>
            <input type="text"   name="fechaRemision"  id="fecha" class="fechas" value="<?php echo $res4["fecha"];?>"/>
          
		 </td>
			
			<td></td>
		</tr>
     
	 <?php } else {  $res3=$ve->listarTodos();?>
		
		<tr>
        
         
		<th  ><label>Nombre Vendedor :</label></th>
			<td colspan="2">
            <input type="text"  class="inp4-form" id="nombre_vendedor" name="nombre_vendedor" >
           
            </td>
           
            <td colspan="2">
            <label>Credito Actual:</label>
            <input class="inp2-form" type="text" id="credito" readonly />
            
            </td>
			<td colspan="3" ><label>Fecha:</label>
            <input type="text"     id="fecha"  name="fechaRemision" class="fechas"  value="<?php
            echo date("Y-m-d");?>"/>
          
          
		 </td>
			
			<td></td>
		</tr>
        <?php }?>
        <tr>
        
        <td>
     
     <label for="libro" size="50" >Codigo: </label>
  <input   class="inp2-form" id="codigoLabel" /></td>
       
     <td colspan="3">
     
     <label for="libro" size="50" readonly="readonly">Titulo del  Libro  o  Codigo: </label>
  <input id="libro"   class="inp4-form"/></td>
    
  <td>
   <label for="stock" >Stock Disponible: </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
   </td>
   <td>
   <label for="libro" >Cantidad: </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
   
   <td>
   <img src="<?php config::ruta(); ?>images/iconos/add.png" width="40" height="40" id="adicionar" style="cursor:pointer;"/>
 
	</td>
    </tr>
	</table>
<hr />
<table cellpadding="0" cellspacing="0" width="100%" id="detalle" border="0">
            
                    <thead>
                    
                          <tr  style="background-color:#50BBDA; color:#333F;" >
                            <th>No</th>
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th >Volumen</th>
                            
                            
                          
                        </tr>
                    </thead>
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>Total</th>
		<td valign="top">
			<input type="text"  class="inp2-form" id="cantidadTotal"/>
           
		</td>
        <td></td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        
        
		<td align="center">
         <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
        <input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onClick="validarEnviar();"/>
                       <input type="hidden" name="editar" id="editar"  value="editar"/>
                 <input type="hidden" name="idnota_pedido"  value="<?php echo $res4["idnota_pedido"];?>" />
                <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="cant_total" id="cant_total" />
                
				  <input type="hidden" name="id_vendedor" id="id_vendedor" value="<?php echo $res4["vendedores_idVendedores"];?>" />			 
                   
				<input type="hidden" name="id_almacenes" id="id_almacenes"  value="<?php echo $res4["idalmacenes"];?>"/>
			
              
                <input type="hidden" name="desc_almacen" id="desc_almacen"  value="<?php echo $res4["desc_almacen"];?>"/>
                  <input type="hidden" name="sumremi" id="sumremi"  value=""/>


				<input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=notasRequerimiento','Desea cancelar la operacion actual?.');" />
			
            <?php } else{?>
			
			<input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onClick="validarEnviar();"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
                <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="cant_total" id="cant_total" />
                
				  <input type="hidden" name="id_vendedor" id="id_vendedor" value="" />			 
                   
						
               
                <input type="hidden" name="id_almacenes" id="id_almacenes"  value="<?php echo $idalmacen;?>"/>
                <input type="hidden" name="desc_almacen" id="desc_almacen"  value="<?php echo $nom;?>"/>


			<input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=notasRequerimiento','Desea cancelar la operacion actual?.');" />
			
			
			<?php }?>
            </td>
	</tr>
                </table>	
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