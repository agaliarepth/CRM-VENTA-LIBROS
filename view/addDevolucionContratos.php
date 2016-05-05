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
  // var  precio_total=0;
   var array=new Array();
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			var i=$("#id_almacenes").val();
			var i2=$("#id_vendedor").val();
			
		
			$("#codigoLabel").autocomplete({
				source: "ajax/devolucion.php?idalmacen="+i+"&id="+i2,			/* este es el formulario que realiza la busqueda */
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
			$( "#stock" ).val( ui.item.disponible );
			//$( "#pu" ).val( ui.item.precio );
			$( "#codigoLabel" ).val( ui.item.codigo );
			
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
	  echo "addTableRow2($v[cantidad],'".$v["codigo"]."','".$v["titulo"]."','".$v["volumen"]."',$v[libros_idlibros],$v[idkardex]);";
	  
	 
	   
   
	
	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
		if(validarCantidad() && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   function addTableRow2( cantidad, codigo, titulo,tomo,id,idk)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp-form"   id="obs' + nextinput + '"  name="obs[]' + nextinput + '" value="" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idkardex[]' + nextinput + '" value="'+idk+'"  /></td></tr>';
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$( "#codigoLabel" ).val('');
//$("#pu").val('');
$("#num_filas").val(nextinput);

var tt=$("#campos tr:last").find("input").eq(0).attr("value");
//var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
////precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
//$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);

   }
   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp-form" id="obs' + nextinput + '"  name="obs[]"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
	if(typeof(codigo)=="undefined"){
	alert("este codigo de libro no es valido");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	alert("!!!Ya existe este Item en la Lista.");
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
//var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
//precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
//$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });
  
  
  
   function eliminarFila(b ){
	  
	     

	    
	  	
            var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);



	  nextinput =nextinput -1;
	  
	  
	  if(nextinput==0){
		 
		
		 $("#cant_total").val(total);
	 
      $("#num_filas").val(nextinput);
		  
		  }
	
		else{ 
		
	
	 
	  
	  
	  $("#cant_total").val(total);
	
      $("#num_filas").val(nextinput);
		}

$("#"+b.id).parent().parent().remove();
	  }
	  
	  
	  
	    function validarCantidad(){
			 var patron = /^\d*$/;  
		
				if($( "#cantidad" ).val()==""){
				alert("Ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               alert("La Cantidad no es Correcta");
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
alert('formato no valido en el campo Precio');
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
			 alert ("no hay Stock Suficiente");
			 return false;
			 }
			 else{
				 if(parseInt(cant)>parseInt(dis)){
					  alert ("no hay Stock Suficiente");
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

					 function validarContraro(){
					 var route="ajax/validarDevolucionContrato.php";
					 var id=$("#idcontrato").val();
					 $.ajax({
					   url:route,
					   dataType:"json",
					   type:"GET",
					   data:{idcontrato:id},
					   success:function(res){

					    if(res.msg){

					 //
					  mensaje("Este contrato ya  se registro con una nota de Devolucion.</br>Contrato Num:"+res.numcontrato+"</br>Cliente:"+res.nombres+" "+res.apellidopaterno+" "+res.apellidomaterno+"</br>Fecha:"+res.fechacontrato+"</br>Num devolucion:"+res.iddevolucion,"warning");

					    }
					    else
					    {

confirmForm($("#form"),"Se procesara la  devolucion  de venta  en fecha</br> <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.");
					    }

					   }



					 });

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
						
						mensaje("Revise el campo Recibe","error");
						return;
						}
					
					
				}
				
				validarContraro();
				
			
			}
       function validarStock(){
				 
				 if($("#stock").val()==""){
				 mensaje("no selecciono un Libro","warning");
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
  <h1>Nota Devolucion> Nuevo </h1>
  
  
 
  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table" style="padding-bottom:-15px;">
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
	
	<table border="0" style="margin:auto" width="65%" cellpadding="0" cellspacing="0">
	<tr >
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
           <form method="post"   class="contacto"  action="<?php echo config::ruta(); ?>?accion=addDevolucionContratos" name="form"  id="form"  >
     
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" style="background-color:#E1F1F7">
     	<tr>
          <?php if(isset($_GET["e"])&& $_GET["e"]=="gi"){?>
           <td colspan="2" ><b>Vendedor:</b><input  class="inp4-form" type="text" readonly name="nombre_vendedor" value="<?php echo $res2["vendedor"];?>" /></td>
          <?php }else{?>
           <td colspan="2" ><b>Vendedor:</b><input  class="inp4-form" type="text" readonly name="nombre_vendedor" value="<?php echo $res2["vendedor"];?>" /></td>
           <?php }?>
       
        
        
         <?php if(isset($_GET["e"])&& $_GET["e"]=="gi"){?>
          <td colspan="2"><b>Almacen:</b>
           <select name="almacen"class="inp-form" type="text"  >
           <?php foreach($res4 as $v){?>
           <option value="<?php echo $v["idalmacenes"]."||".$v["descripcion"];?>"><?php echo $v["descripcion"];?></option>
           <?php }?>
           </select>
           
           
           </td>
          <?php }else{?>
           <td colspan="2"><b>Almacen:</b>
           <select name="almacen"class="inp-form" type="text"  >
           <?php foreach($res4 as $v){?>
           <option value="<?php echo $v["idalmacenes"]."||".$v["descripcion"];?>"><?php echo $v["descripcion"];?></option>
           <?php }?>
           </select>
           
           
           </td>
          <?php }?>
       
        <td valign="top"><b>Fecha:</b>
            <?php if(isset($_GET["e"])&& $_GET["e"]=="gi"){?>
         <input type="text" class="fechas" id="fecha"  name="fecha" value="<?php echo date("Y-m-d");?>" />
            
          
            </td>
            <?php }else{?>
              <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>" />
			
           
          <?php }?>
            </td>
            <td><b>Observacion:</b>
             <?php if(isset($_GET["e"])&& $_GET["e"]=="gi"){?>
            <input name="obs1" class="inp-form" type="text"  value="" />
          
            </td>
            <?php }else{?>
			<input name="obs1" class="inp-form" type="text"  value="" />
          <?php }?>
            </td>
            
        </tr>       
      </table>
      <table style="display:none;">
          
		
        <tr>
        
        
       <td>
   <label for="codigoLabel" >CODIGO: </label>
   <input id="codigoLabel" size="5" class="inp2-form"  />
   </td>
   
     <td colspan="">
     
     <label for="libro" size="50" readonly="readonly">TITULO DEL LIBRO :</label>
  <input id="libro"   class="inp4-form"/></td>
  <td>
   <label for="libro" >Stock Remitido: </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
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
                    <tr><td><label for="pu" >CANT TOTAL: </label>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
  
   </tr>
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;"  >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>Obs<th>
                            
                             <th ></th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="validarEnviar();"/>
               
                   

                    <?php 
if(isset($_GET["e"])&& $_GET["e"]=="gi"){?>

       <input type="hidden" name="editar" id="editar"  value="editar"/>
       <input type="hidden" name="iddevolucion" id="iddevolucion" value="<?php echo $res4["iddevolucion"] ?>" />
       <input type="hidden" name="id_almacenes" id="id_almacenes" value="<?php echo $res4["idalmacenes"];?>" />
       <input type="hidden" name="id_vendedor" id="id_vendedor" value="<?php echo $res4["vendedores_idVendedores"];?>"/> 

   <input type="hidden" name="num_filas" id="num_filas" />
	   
   <?php  }else{?>
            <input type="hidden" name="enviarDevolucion" id="enviarDevolucion" value="enviarDevolucion" />

            <input type="hidden" name="id_vendedor" id="id_vendedor" value="<?php echo $res2["idvendedor"];?>"/> 
            <input type="hidden" name="iddevolucionObras"  value="<?php echo $res2["iddevolucionObras"];?>"/> 
             <input type="hidden" name="num_filas" id="num_filas" />
    <input type="hidden" name="idcontrato" id="idcontrato" value="<?php echo $res2["idcontrato"];?>"/>







<?php }?>
			
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

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>