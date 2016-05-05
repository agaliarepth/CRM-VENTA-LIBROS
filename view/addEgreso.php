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
   var  precio_total=0;
   var array=new Array();
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			var i=$("#id_almacenes").val();
			$("#codigoLabel").autocomplete({
				source: "ajax/searchProductos2.php?id="+i,			/* este es el formulario que realiza la busqueda */
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
			var i2=$("#id_almacenes").val();
			$( "#libro" ).val( ui.item.titulo );
			//$( "#stock" ).val( ui.item.stock );
			$( "#pu" ).val( ui.item.precio );
			$( "#codigoLabel" ).val( ui.item.codigo );
			
			stock=parseInt(ui.item.stock);
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
                                    mensaje("error petición.","error");
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
	  	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="s"){

  foreach($res3 as $v){
	  echo "addTableRow2($v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$v[precio_total],$v[libros_idlibros],'".$v["codigo"]."','".$v["obs"]."');";
	  
	 
	   
    }
	
	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
		if(verificaPrecio()&& validarCantidad() && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
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
$( "#codigoLabel" ).val('');
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
    campo = '<tr><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
	if(typeof(codigo)=="undefined"){
	mensaje("Este codigo de libro no es valido","error");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	mensaje("!!!Ya existe este Item en la Lista.","error");
	nextinput++;
	
	}
	else{
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$( "#codigoLabel" ).val('');
$("#stock").val('');

$("#num_filas").val(nextinput);
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
				mensaje("Ingrese un cantidad.","warning");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               mensaje("La Cantidad no es Correcta.","warning");
			   return false;
		   }
				else
				return true;
			
			}
			
					
 function dos_decimales(cadena){
var expresion=/^\d+(\.\d{0,2})?$/;
var resultado=expresion.test(cadena);
return resultado;
}
function verificaPrecio(){
var campo = document.getElementById('pu');
if(dos_decimales(campo.value) !== true){
mensaje('Formato no valido en el campo Precio',"warning");
return false;
}
else
return true;
}
	  function validarDisponible(){
		var dis=$("#stock").val();
		var cant=$("#cantidad").val();
		if(parseInt(dis)==0)
		 {
			 mensaje("No hay Stock Suficiente.","warning");
			 return false;
			 }
			 else{
				 if(parseInt(cant)>parseInt(dis)){
					 mensaje ("no hay Stock Suficiente","warning");
			 return false;
					 
					 }
				 
				 }
           
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
                                   mensaje("error petición.","error");
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
								
								mensaje("ERROR:: ESTE MES ESTA CERRADO NO SE PUEDE PROCESAR ESTA NOTA EN ESTE MES.","error")
								return;
								
								}
				if(nextinput==0){
					mensaje("No existen items para enviar. ","error")
					
					return;
					}
				
				else {
					if($("#nombre_envia").val()==""){
						
						mensaje("Revise el campo Recibe","warning");
						return;
						}
					
					
				}
				
				confirmForm($("#addLibros"),"Se Guardara  la nota de egreso en fecha <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.");
			
			}
       function validarStock(){
				 
				 if($("#stock").val()==""){
				 alert("no selecciono un Libro");
				 return;
				 }
				 else return true;
				 
				 }
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Nota Egreso > Nuevo </h1>
  <hr />
   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">El Requerimiento de Mercaderia se Ha Registrado Exitosamente.<?php echo $_GET["l"];?>.... <a href="<?php config::ruta(); ?>?accion=notasIngreso">Volver a la Lista .</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   
		    case '2':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">EL CAMPO NOMBRE DE QUIEN RECIBE ESTAN ERRONEOS</td>
					<td class="green-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
				
				   case '3':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">NO EXISTEN ITEMS EN LA NOTA</td>
					<td class="green-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   }
	   }?>
 
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
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<!--  start step-holder -->
		
		<!--  end step-holder -->
	<br />
<?php
if ( count($res2) == 0) {
   ?>
   <p><h1>No Existen Almacenes Registrados.</h1></p>
   <?php 
} else { ?>
   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addLibros"  >
    
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form"  width="50%">
        
	
		
		 <tr>
		
         <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
		<td>
        <label>ENVIA ALMACEN</label>
        <input id=""   class="inp-form"  readonly="readonly" name="nombre_almacen" value="<?php echo $res4["nombre_almacen"] ?>"/></td><?php } else{?>
        
        
        <td>
        <label>ENVIA ALMACEN</label>
        <input id=""   class="inp-form"  readonly="readonly" name="nombre_almacen" value="<?php $c=explode("/",$_POST["almacenes"]); echo $c[1]; ?>"/></td><?php } ?>
          
        
         <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
		<td>
        <label>DESTINO</label>
        <select  class="inp-form" name="destino">
        
			  <option <?php if ($res4["destino"]=="BAJA DE MERCADERIA"){?>selected="selected"<?php }?> value="BAJA DE MERCADERIA">BAJA DE MERCADERIA</option>
               <option <?php if ($res4["destino"]=="CAMBIO OBRA"){?>selected="selected"<?php }?> value="CAMBIO OBRA">CAMBIO OBRA</option>
                <option <?php if ($res4["destino"]=="DEVOLUCION EN COMPRA"){?>selected="selected"<?php }?> value="DEVOLUCION EN COMPRA">DEVOLUCION EN COMPRA</option>
                 <option <?php if ($res4["destino"]=="OBSEQUIO"){?>selected="selected"<?php }?>  value="OBSEQUIO">OBSEQUIO</option>
                  <option  <?php if ($res4["destino"]=="NINGUNO"){?>selected="selected"<?php }?> value="NINGUNO">NINGUNO</option>
                   <option <?php if ($res4["destino"]=="VENTA DE MERCADERIA"){?>selected="selected"<?php }?> value="VENTA DE MERCADERIA">VENTA DE MERCADERIA</option>
                    <option  <?php if ($res4["destino"]=="TRASPASO SUCURSAL"){?>selected="selected"<?php }?>value="TRASPASO SUCURSAL">TRASPASO SUCURSAL</option>
                                        <option  <?php if ($res4["destino"]=="REGULARIZACION DE INVENTARIO"){?>selected="selected"<?php }?>value="REGULARIZACION DE INVENTARIO">REGULARIZACION DE INVENTARIOL</option>

                     
			
		</select></td>
        <?php } else{?>
        <td>
         <label>DESTINO</label>
        <select  class="inp-form" name="destino">
        <option value="DEVOLUCION EN COMPRA">DEVOLUCION EN COMPRA</option>
			  <option value="BAJA DE MERCADERIA">BAJA DE MERCADERIA</option>
               <option value="CAMBIO OBRA">CAMBIO OBRA</option>
                
                 <option value="OBSEQUIO">OBSEQUIO</option>
                  <option value="NINGUNO">NINGUNO</option>
                   <option value="VENTA DE MERCADERIA">VENTA DE MERCADERIA</option>
                    <option value="TRASPASO SUCURSAL">TRASPASO SUCURSAL</option>
                    <option value="REGULARIZACION DE INVENTARIO">REGULARIZACION DE INVENTARIO</option>
                     
			
		</select></td><?php  }?>
        
            <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
            <td>
            <label>FECHA</label>
            <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo $res4["fecha"];  ?>"/>
          
          
            </td>
            <?php }else{?>
			<td><label>FECHA</label>
            <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>" />
            
          <?php }?>
            </td>
        
     
       
		</tr> 
          
        <tr>
			
             <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
			<td>
            <label>RECIBE</label>
            <input name="nombre_envia" type="text" class="inp-form" id="nombre_envia" value="<?php echo $res4["recibe"];?>" /> </td>
          <?php }else {?><td>  <label>RECIBE</label><input name="nombre_envia" type="text" class="inp-form" id="nombre_envia" value="" /> </td><?php }?>
           
			
              <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
            <td colspan="">
            
            <label>TIPO CAMBIO</label>
            <select  class="inp2-form" name="moneda">
        
			 
               <option <?php if ($res4["moneda"]=="Bs"){?>selected="selected"<?php }?>   value="Bs">Bs</option>
                <option <?php if ($res4["moneda"]=="Sus"){?>selected="selected"<?php }?> value="Sus">Dolar</option>
               </select>
               </td>
               <?php } else {?>
			   <td colspan=""><label>TIPO CAMBIO</label><select  class="inp2-form" name="moneda">
          <option   value="Bs">Bs</option>
			  <option value="Sus">Dolar</option>
             
               </select>
               <b> <?php echo " 1 Sus =". $tc2["valor"]." Bs";?></b>
               </td>
                 <?php }?>
             <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
            <td>
            <label>OBSERVACIONES</label>
             <textarea  name="obs1" cols="35" rows="2" maxlength="150"   ><?php echo $res4["obs"];?></textarea>
           
          
            </td>
            <?php }else{?>
			<td>
            <label>OBSERVACIONES</label>
          <textarea  name="obs1" cols="35" rows="2" maxlength="150"   ></textarea>
          <?php }?>
            </td>
             <tr>
			
           
            </tr>
            <tr> 
			   
			   
               </tr>
        </table>
        <table>
        <tr>
        
        
       <td>
   <label for="codigoLabel" >CODIGO: </label>
   <input id="codigoLabel" size="5" class="inp2-form"  />
   </td>
     <td colspan="2">
     
     <label for="libro" size="50" readonly="readonly">TITULO DEL LIBRO :</label>
  <input id="libro"   class="inp4-form"/></td>
  <td>
   <label for="libro" >Stock Disponible: </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
   </td>
  
   <td>
   <label for="pu" >P / UNITARIO: </label>
   <input id="pu" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
   
   
   <td>
  <img src="<?php config::ruta(); ?>images/iconos/add.png" width="40" height="40" id="adicionar" style="cursor:pointer;"/>
	</td>
    </tr>
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
                   
                    	
                     
                    </tbody>
                 <tr><td colspan="3">
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /><label for="pu" >CANT TOTAL: </label></td>
   <td  colspan="2"></td>
   
   <td></td>
   <td colspan="2">
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /><label for="monto_total" >MONTO TOTAL</label></td>
   </tr>
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="validarEnviar();"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
                       <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />

                    <?php 
if(isset($_GET["e"])&& $_GET["e"]=="s"){?>

       <input type="hidden" name="editar" id="editar"  value="editar"/>
       <input type="hidden" name="idegreso" id="idegreso" value="<?php echo $_GET["id"] ?>" />
             <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />


	   
   <?php  }?>
                <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="id_vendedor" id="id_vendedor" />
                      <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
                <input type="hidden" name="id_almacenes" id="id_almacenes" value="<?php echo $res4["idalmacenes"];?>" />
<?php } else {?>  <input type="hidden" name="id_almacenes" id="id_almacenes" value="<?php echo $c[0];?>" /><?php }?>
			
            </form>
		</td>
		<td>
      
        <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=notasEgreso','Desea cancelar la operacion actual?.');" />
        </td>
	</tr>
                </table>	
	</td>
	<td>
<?php } ?>
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