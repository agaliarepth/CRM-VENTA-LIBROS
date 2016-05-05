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
	  <?php 


  foreach($res3 as $v){
	  
	  $pt=$v["cantidad"]*$v["precio_unitario"];
	  echo "addTableRow2($v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$pt,$v[libros_idlibros],'".$v["codigo"]."');";
    }
?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td></tr>';
	
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
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
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
	 
  function validarForm(){
	  
	  confirmForm($("#wizard"),"Se procesara la  devolucion  de Cobranza  en fecha</br> <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.");
		  
	  
	  }
  </script> 

<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Nota Ingreso > Nuevo  </h1>
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
					<td class="red-left">EL CAMPO NOMBRE DE QUIEN ENVIA ESTAN ERRONEOS</td>
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
	
	<table border="0" width="50%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
<?php
if ( count($res4) == 0) {
   ?>
   <p><h1>No Existen Almacenes Registrados.</h1></p>
   <?php 
} else { ?>
   

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="wizard"   >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="80%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td><label>Recibe Almacen:</label>
		
		<select  class="inp-form" name="almacenes">
        <?php foreach($res4 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
			
		</select>
		</td>
        <TD colspan="2">
        <LABEL>Concepto:</LABEL>
        
		<input  class="inp4-form" type="text" name="tipo" value="DEVOLUCION REGISTRO VENTA" readonly/></td>
         <td><label>Fecha:</label></th>
           
			<input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>"/>
          
            </td>
       
       
		</tr> 
        <tr> 
      			<td><label>Envia:</label>
           
			<input name="nombre_envia"  class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:200px; height:27px" type="text"  id="nombre_envia" value="<?php echo $res2["cliente"];?>" />
         
            </td>
            
            <!--<td><label>Tipo de Cambio</label>
            
			   <select  class="inp2-form" name="moneda">
          <option   value="Bs">Bs</option>
			  <option value="Sus">Dolar</option>
             
               </select>
                <b><?php echo " 1 Sus =". $tc2["valor"]." Bs";?></b>
               </td>
			   -->
			   
			   
                <td><LABEL>Observacion:</laBEL>
            
			<textarea name="obs" cols="25"></textarea>
        
            </td>
			
      
           
            </tr>
            <tr>
           
            </tr>
           </thead>
           </table>
           <table>
           
        <tr style="display:none;">
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"   class="inp2-form"/></td>
  <!--<td>
   <label for="libro" >Stock en Disponible: </label>
   <input id="stock" size="5" readonly class="inp-form"  />
   </td>-->
   
       
     <td colspan="2">
     
     <label for="libro" size="50" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"   class="inp4-form"/></td>
  <!--<td>
   <label for="libro" >Stock en Disponible: </label>
   <input id="stock" size="5" readonly class="inp-form"  />
   </td>-->
  
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
<table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0">
            
                    <thead>
                   
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                             <th ></th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                    <tr><td>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
   <td colspan="3"></td>
   <td><label for="monto_total" >MONTO TOTAL</label></td>
  <td> <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td></tr>
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
	<input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="validarForm();"/>                 <input type="hidden" name="enviar" id="enviar" value="enviar" />


                <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="idcontrato" id="idcontrato" value="<?php echo $res2["idcontrato"];?>" />
                <input type="hidden" name="idobras" id="idobras" value="<?php echo $_GET["id"];?>" />

               <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />

               
            </form>
		</td>
		<td>			
          <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=devolucionObras','Desea cancelar la operacion actual?.');" />
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