 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_administracion"])){?> 
<style type="text/css">
.elegido { background-color:#F00; display:none; }

</style>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
	
   
	
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
    <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});
            
	</script>


 <script type="text/javascript">
		var stock;
	var titulo;
	var tomo;
	var id;
	var idk;
	var codigo;
	var nextinput = 0;
    var total=0;
    var  precio_total=0;
    var array=new Array();
	var numant;
	var cuentaant;
	var i3=<?php echo $supervisor;?>
	
	 
	  function buscarContrato(valor){
		
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/buscarContrato.php",
                              data: "b="+valor,
                              dataType: "html",
							  async:false,
							  global:true,
							  
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								  if(parseInt(data)==0){
									  
									 
										  $("#numcontrato").val(valor);
									  }
								
									else  {
										 mensaje("El contrato Numero:: "+valor+":: ya se encuentra registrado.","warning");
										 $("#numcontrato").val(numant);
										  $("#numcontrato").focus();
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
		}
		
		 function buscarCuenta(valor){
		
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/comprobarCuenta2.php",
                              data: "b="+valor,
                              dataType: "html",
							  async:false,
							  global:true,
							  
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								  if(parseInt(data)==0){
									  
									 
										  $("#numcuenta").val(valor);
									  }
								
									else  {
										 mensaje("El Numero Cuenta:: "+valor+":: ya se encuentra registrado.","warning");
										 $("#numcuenta").val(cuentaant);
										 $("#numcuenta").focus();
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
		}
	
	
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#cobrador").autocomplete({
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
		{	$( "#cobrador" ).val( ui.item.label );
			$( "#ci_cobrador" ).val( ui.item.valor);
			$( "#idcobrador" ).val( ui.item.idcobradores );
			return false;
				}
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			var i2=<?php echo $supervisor;?>
			//alert($("#id_vendedor").val());
			$("#codigoLabel").autocomplete({
				source: "ajax/ventas.php?id="+i2,				/* este es el formulario que realiza la busqueda */
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
			$( "#codigoLabel" ).val( ui.item.codigo );
			$( "#pu" ).val( ui.item.precio );
			
			stock=parseInt(ui.item.stock_disponible);
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			idk=parseInt(ui.item.idk);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();
		
					
			  $.ajax({
                              type: "POST",
                              url: "ajax/buscarPrecio.php",
                              data: "b="+ui.item.id,
                              dataType: "html",
                              error: function(){
                                   alert("error petición ajax");
                             },
                              success: function(data){
								
									  $( "#pu" ).val( data);
									  n();
									                                                
                                  
                                  
                              }
                  });
				 
				    $.ajax({
					  
                              type: "POST",
                              url: "ajax/buscarDisponible.php?id="+i3,
                              data: "b="+ui.item.codigo,
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
	   	    numant=$("#numcontrato").val();
			 cuentaant=$("#numcuenta").val();

	    $('form').keypress(function(e){   
    if(e == 13){
      return false;
    }
  });

  $('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
  });

	 $("#numcontrato").change(function(){
		
         buscarContrato( $("#numcontrato").val())

			});
			
			$("#numcuenta").change(function(){
		
         buscarCuenta( $("#numcuenta").val())

			});
			
			
			
	   $("#tipoventa").change(function(){
		
		if($(this).val()=="CREDITO"){
			
	   $("#tabla-contado").css({ display: "none"});
   	   $("#tabla-credito").css({ display: "block"});


			}
		
		if($(this).val()=="CONTADO"){
		$("#tabla-contado").css({ display: "block"});
   	   $("#tabla-credito").css({ display: "none"});
			}
		
		
		});
		
			$("#cantidad").bind('keypress', function(event)
	{
	if (event.keyCode == '13')
		{
	adicionarFila();
		}//fin de code
		
		});
		
   $("#pu").bind('keypress', function(event)
	{
	if (event.keyCode == '13')
		{
	       adicionarFila();
		}//fin de keycode
		if(event.keyCode == 8){
			
			$("#pu").val('');
			}
		return;
		});
		
		
		
		$("#montocancelado").change(function(){
		
		var saldo=parseFloat($("#monto_total").val()-$(this).val());
		if(saldo<0){
			alert("EL MONTO CANCELADO NO PUEDE SER MAYOR AL MONTO  TOTAL DEL CONTRATO");
			$(this).val("");
			$("#saldocontado").val(0);
			$(this).focus();
			
			}
			else
			$("#saldocontado").val(saldo);
		});
	  
	    $('#cuota_inicial').change(function () {
		   
		   if(parseFloat($('#cuota_inicial').val())>parseFloat($("#monto_total").val()) || $("#monto_total").val()==0){
			   
			   alert("la cuota inicial no puede ser mayor al monto Total del Contrato");
			   $('#cuota_inicial').val("");
			   $('#cuota_inicial').focus();
			   $("#saldo").val(0);
			   
			   }
			   else {
		  
		    $("#saldo").val(parseFloat($("#monto_total").val())-parseFloat($('#cuota_inicial').val()));
			   }
			
			});
			
			  $('#num_pagos').change(function () {
		  
		    $("#monto_pagos").val(parseFloat($("#saldo").val())/parseFloat($('#num_pagos').val()));
			
			
			});
	 
	
	  
	  
	  
	  <?php 


  foreach($res2 as $v){
	 
	  $tot=$v["precio_unitario"]*$v["cantidad"];
	  echo "addTableRow2($v[cantidad],'".$v["codigo"]."','".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$tot,$v[libros_idlibros],$v[idkardex],$v[iddetalle_contrato]);";
	  
	 
	   
    }
	
	if($res["tipoventa"]=="CREDITO"){
		echo "$('#tabla-contado').css({ display: 'none'});";
   	   echo "$('#tabla-credito').css({ display: 'block'});";
	   echo"$('#cuota_inicial').val(".$cred["cuotainicial"].");";
   	   echo"$('#saldo').val(".$cred["saldo"].");";
	   echo"$('#num_pagos').val(".$cred["numcuotas"].");";
	   echo"$('#monto_pagos').val(".$cred["montocuotas"].");";
	   echo"$('#valorcomisionable').val(".$cred["valorcomisionable"].");";
	   echo"$('#cobrador').val('".$cobrador->getNombresCobrador($cred["idcobrador"])."');";
	   echo"$('#idcobrador').val(".$cred["idcobrador"].");";

		
		}
		if($res["tipoventa"]=="CONTADO"){
		echo "$('#tabla-contado').css({ display: 'block'});";
   	   echo "$('#tabla-credito').css({ display: 'none'});";
	    
		
		}
	
	?>
   // trigger event cuando el boton es cliqueado
   

   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarDisponible()&& validarCantidad()){
			
			
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	
	for(i=1;i<=parseInt($( "#cantidad" ).val());i++){
	
	  $.ajax({
                              type: "POST",
                              url: "ajax/addDetalleContrato.php?idc="+$("#idcontrato").val()+"&idchofer="+i3+"&cod="+codigo+"&tit="+$( "#libro" ).val()+"&vol="+tomo+"&pu="+$( "#pu" ).val()+"&idvendedor="+$("#idvendedor").val(),
                              data: "idlibro="+id,
                              dataType: "json",
                              error: function(e){
                                    alert("error petición ajax");
									
                              },
                              success: function(data){
								
	                         addTableRow(data.cantidad,data.titulo,data.volumen,data.precio_unitario,data.precio_unitario,data.libros_idlibros,data.idkardex);
                                								
									  n();
									                                                
                                  
                                  
                              }
                  });
	}//fin de for
	
	//addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id,idk);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   

   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id,idk)
   {
	   //alert(idk);
    campo = '<tr aling ="center"><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" onchange="recalcularPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><input type="hidden"  id="idkardex' + nextinput + '"  name="idkardex[]' + nextinput + '" value="'+idk+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	if(typeof(codigo)=="undefined"){
	alert("ERROR::Este codigo de libro No se Encuentra Registrado En El Catalogo");
	return;
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
var tt=$("#campos tr:last").find("input").eq(3).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#montototal").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
   
   function addTableRow2( cantidad,codigo, titulo, tomo,pu,pt,id,idk,iddetalle_contrato)
   {
    campo = '<tr aling ="center"><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form"  size="10" onchange="recalcularPrecio(this);" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><input type="hidden"  id="idkardex' + nextinput + '"  name="idkardex[]' + nextinput + '" value="'+idk+'"  /><input type="hidden"  id="iddetalle_contrato' + nextinput + '"  name="iddetalle_contrato[]' + nextinput + '" value="'+iddetalle_contrato+'"  /></td></tr>';
	
	
	
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
var tt=$("#campos tr:last").find("input").eq(3).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#montototal").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
  
   }
  });
  
    function recalcularPrecio(c){
	   var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(c.value);
	 if(resultado!=false){
	 var cant=$("#"+c.id).parent().parent().find("input").eq(3).val();
	 var pt=cant*c.value;
	 $("#"+c.id).parent().parent().find("input").eq(5).val(pt);
	 	 recalcularNota();
         recalcularMontos();
	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(4).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 	 recalcularNota();
          recalcularMontos();

		 }
	   }
	   function recalcularNota(){
		   total=0;
		   precio_total=0;
		   var i;
		   $('#campos tr').each(function () {
			   
			   total=total+parseInt($(this).find("input").eq(3).val());
			precio_total= precio_total+parseFloat($(this).find("input").eq(5).val());
			precio_total.toFixed(2);
			   
			   });
		  $("#cant_total").val(total);
         $("#monto_total").val(precio_total);
		   	  $("#montototal").val(precio_total);

		   
		   }
  
  
	  function recalcularMontos(){
		  
		  $("#saldo").val(parseFloat($("#monto_total").val())-parseFloat($("#cuota_inicial").val()));
		  $("#monto_pagos").val(parseFloat($("#saldo").val()/$("#num_pagos").val()).toFixed(2));
		  
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
	  
	    function validarCantidad(){
			 var patron = /^\d*$/;  
		
				if($( "#cantidad" ).val()==""){
				alert("ERROR::Ingrese un cantidad");
				return false;
	             }
				 if(parseInt($( "#cantidad" ).val())>1)
				 return false;
				                      
                                 
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
					
					var pk=$(this).find("td").eq(0).find("input").attr("value");
					
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
	 
	  confirmForm($("#wizard"),"Esta guardando el contrato con los siguientes datos.<br> Contrato N:<b class='resaltar'>"+$("#numcontrato").val()+"</b><br>Tipo Venta:<b class='resaltar'>"+$("#tipoventa").val()+"</b><br>Fecha Contrato:<b class='resaltar'>"+$("#fecha").val()+"</b><br>Cuota inicial:<b class='resaltar'>"+$("#cuota_inicial").val()+"(Bs) </b><br>Fecha Cobro Cuota Inicial:<b class='resaltar'>"+$("#fecha2").val()+"</b><br>Desea continuar?");
	 }

function verRemisiones(){

	window.open('<?php echo config::ruta()?>?accion=verResumenCargos&iv=<?php echo $supervisor;?>',"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=600, height=400");
	
	
	}
 
  </script> 

 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1 > Ventas > Editar Contrato::<?php //echo $supervisor; echo $nombre_supervisor; echo $idvendedor; echo $nombre_vendedor;?></h1>
 
 		
		</div>
  <form action="" method="post"  name="form" id="wizard">
  <table style="background-color:#E1F1F7; margin:auto; border:dashed 1px;" width="70%">
           <tr >
                            
                            
                            <th>VENDEDOR :</th>
                            <th style="color:#F00; font-weight:bold;"><?php echo  $nombre_vendedor;?></th>
               <th><b>CHOFER:</b></th>
                            <td colspan="3" style="color:#F00; font-weight:bold;"> <?php  echo $nombre_supervisor;?><input type="button" value="VER REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
                            <input type="hidden" name="supervisor" id="supervisor" value="<?php echo $supervisor;?>"/> </td>
                                             
                           
                            
                         
                        </tr>
                        
                        
       
        <tr style=" display:none">
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel" readonly    class="inp2-form"/></td>

       
     <td colspan="2">
     
     <label for="libro" size="50" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"   class="inp4-form"/></td>
  <td>
   <label for="libro" >Stock Remitido: </label>
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
    
  <table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0" style="margin:auto">
            
                    
                                
                      
                          
                           <thead>
                        <tr style="background-color:#85DEF8; border:solid 1px; height:12px">      
                           
                            <th>CODIGO</th>
                            <th>TITULO</th>
                            <th >VOLUMEN</th>
                             <th>CANTIDAD</th>
                            <th>P/UNIT<th>
                            <th >P/TOTAL</th>
                          
                            
                            
                          
                        </tr>
                     
                        </thead>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                    <tfoot>
                    <tr>
                    <td colspan="7" width="70%" style="background-color:#3CF; line-height:2px">&nbsp;</td>
                    </tr>
                      <tr>
                      <TD colspan="2"></TD>
                      <td align="right"><B>CANT.TOTAL</B></td>
                      <td>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
    <td align="right"><B>P.TOTAL</B></td>
   <td colspan="2">
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
   <TD ></TD>
   </tr>
                    </tfoot>

       
                </table>	
                
                
                 
                
	

</fieldset>


<fieldset class="fields" style="background-color:#DDE8EE; width:90%; margin:auto "> <legend> DATOS DEL CONTRATO</legend>
<table   border="0" class="detalleContrato" cellpadding="0" cellspacing="0" >
       
        
        <tr>
         <td><label>TIPO CONTRATO<span> * </span></label><select name="tipoventa" id="tipoventa" style="width:120px;height:27px;" class="fechas">
         <option value="CREDITO" <?php if($res["tipoventa"]=="CREDITO"){?> selected="selected"<?PHP }?>>CREDITO</option>
         <option value="CONTADO" <?php if($res["tipoventa"]=="CONTADO"){?> selected="selected"<?PHP }?>>CONTADO</option>
         
         </select> </td>
			
			<td><label >Num  Contrato <span>*</span></label>
            <input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:100px; height:20px" id="numcontrato" name="numcontrato" value="<?php echo $res["numcontrato"]?>"   /> </td>
           
            <td ><label >Fecha Contrato <span> * </span></label><input type="text" class="fechas"  name="fecha_contrato"  id="fecha" value="<?php echo $res["fechacontrato"]?>"/>
           </td>
          <td><label>Localidad del contrato <span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="localidad" name="localidad" value="<?php echo $res["localidad"]?>"/> </td>
           <td><label>Nombres<span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="nombres" name="nombres" value="<?php echo $res["nombres"]?>"/> </td>
            <td><label>Apellido Paterno: <span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="apellidopaterno" name="apellidopaterno" value="<?php echo $res["apellidopaterno"]?>" /> </td>
             <td><label>Apellido Materno</label><input type="text" style="width:150px; height:20px"id="apellidomaterno" name="apellidomaterno" value="<?php echo $res["apellidomaterno"]?>" /> </td>
               <td><label>CARNET<span> * </span></label><input type="text" readonly class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:70px; height:20px"id="carnet" name="carnet"  value="<?php echo $res["ci"]?>" /> </td>
          
            
		</tr>
        </table>
        <table id="tabla-credito" border="0" cellpadding="0" cellspacing="0" class="detalleContrato" >
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
   
        <td colspan="7" ><b>DATOS DEL CREDITO</b></td>
        </tr>
        <tr>
          	 <td ><label>CUOTA INICIAL<span> * </span> </label><input type="text" class="validate[custom[number],required]" style=" width:100px; height:20px" id="cuota_inicial" name="cuota_inicial" value="<?php echo $cred["cuotainicial"]?>"/> </td>
              <td ><label>FECHA  COBRO CI<span> * </span> </label><input type="text" class="fechas" style=" width:100px; height:20px" id="fecha2" name="fechacobranza"  value="<?php echo $cred["fechacobranza"]?>"/></td>
             
                 <td ><label >SALDO <span> * </span></label><input type="text" class="validate[custom[number],required]" style="width:100px;  height:20px" id="saldo" name="saldo"  value="<?php echo $cred["saldo"]?>"/> </td> 
                 
                 
            <td >
            <label>NUM DE PAGOS <span> * </span></label>
            <input type="text" class="validate[custom[integer],required]" style="width:100px;  height:20px;"  id="num_pagos" name="num_pagos" value="<?php echo $cred["numcuotas"]?>"/>
             </td> 
            
            
                  <td width="130s"><label>MONTO X PAGO <span> * </span></label><input type="text" class="validate[custom[number],required]" style="width:100px;  height:20px" id="monto_pagos" name="monto_pagos"   value="<?php echo $cred["montocuotas"]?>"/> </td>
              
             
			
        <td><label >MONTO COMISIONABLE<span> * </span></label><input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:100px; height:20px; " id="valorcomisionable" name="valorcomisionable" value="<?php echo $cred["valorcomisionable"]?>"/> </td>
        
             	  <td ><label><?php if($comisiones["tipocomisioncredito"]=="P") {?> Porcentaje Comision %<?php } else{?>Monto Comision (Bs)<?php }?></label>
                 <input  type="text" size="5"  readonly="readonly" value="<?php echo $comisiones["valorcomisioncredito"]?>"name="comisioncontrato1" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:30px">
                 
                 <input type="hidden"  name="tipocomisioncredito" value="<?php if($comisiones["tipocomisioncredito"]=="P") echo "P";  else echo "M"; ?>"/>
                 
                
                 
                 </td>
            
			</tr>
            <tr>
            <td  colspan="3" style="background-color:#FFC;"><label> NOMBRE DEL COBRADOR</label><input type="text" class="inp4-form" id="cobrador" name="cobrador" value="<?php echo $cobrador->getNombresCobrador($cred["idcobrador"]);?>"/>
            <input  type="hidden" id="idcobrador" name="idcobrador"  value="<?php echo $cred["idcobrador"]?>"  />
            
            </td>
            
            </tr>
            </table>
         
            
            
            <table id="tabla-contado"  class="detalleContrato">
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
        <td colspan="5"><b>DATOS DE CONTADO</b></td>
        </tr>
		
	
        <tr>
          <td >
            <label>MONTO CANCELADO:<span> * </span></label>
            <input type="text" class="validate[custom[number]]" style="width:150px;  height:20px;"  id="montocancelado" name="cuota_inicialContado" value="<?php echo $cred["cuotainicial"]?>"/>
             </td> 
             <td  ><label>SALDO <span> * </span></label><input type="text" class="validate[custom[number]]" style="width:100px;  height:20px" id="saldocontado" name="saldoContado"  readonly="readonly"  value="<?php echo($res["preciototal"]-$cred["cuotainicial"])?>"/>
              </td>
               <td><label >MONTO COMISIONABLE<span> * </span></label><input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:100px; height:20px; " id="valorcomisionable" name="valorcomisionableContado" value="<?php echo $cred["valorcomisionable"];?>"/> </td>
        
             	 <td ><label><?php if($comisiones["tipocomisioncontado"]=="P") {?> Porcentaje Comision %<?php } else{?>Monto Comision (Bs)<?php }?></label>
                 <input  type="text" size="5"  readonly="readonly" value="<?php echo $comisiones["valorcomisioncontado"]?>" name="comisioncontrato" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:30px">
                 
                  <input type="hidden"  name="tipocomisioncontado" value="<?php if($comisiones["tipocomisioncredito"]=="P") echo "P";  else echo "M"; ?>"/>
                 
                 </td>
                </tr>
              
	</table>
    <fieldset><legend>DATOS DEL PAGO</legend>
    <table class="detalleContrato">
   <tr>
   <td><label>NUMCUENTA</label><input name="numcuenta"  id="numcuenta" value="<?php echo $cred['numcuenta'];?>"/></td>
   <td><label>TIPO DOCUMENTO</label>
   
   <select name="tipodoc">
    <option value="FACTURA"  <?php if($cred["tipodoc"]=='FACTURA'){?> selected="selected"<?php }?>>FACTURA</option>
   <option value="RECIBO" <?php if($cred["tipodoc"]=='RECIBO'){?> selected="selected"<?php }?>>RECIBO</option>
  
   </select>
   <td><label>FECHA DOCUMENTO</label><input name="fechadoc"  class="fechas" id="fecha3" value="<?php echo $cred['fechadoc'];?>"/></td>
   <td><label>NUMERO DOCUMENTO</label><input name="numdocumento"  value="<?php echo $cred['numdocumento'];?>"/></td>
   <td><label>MONTO DOCUMENTO</label><input type="number" name="montodoc"  value="<?php echo $cred['montodoc'];?>"/></td>
   <td><label>NUM REPORTE</label><input type="number" name="numreporte"  value="<?php echo $cred['numreporte'];?>"/></td>
   </tr>
   </table>
   </fieldset>
   </fieldset>
  
   
   
   
   
   
        <table style="margin:auto">
        <TR>
		<td >
			<input type="button" id="bEnviar" value="bEnviar" name="bEnviar" class="form-submit" onclick="validarForm();" />
            <input type="hidden" name="editContrato" value="editContrato"/>
            <input type="hidden" name="idvendedor"  id="idvendedor" value="<?php echo $res["idvendedor"]?>"/>
            <input type="hidden" name="idchofer"  id="idchofer" value="<?php echo $res["idchofer"]?>"/>
            <input type="hidden" name="terminado" value="<?php echo $res["terminado"]?>"/>

             <input type="hidden" name="idcontrato" id="idcontrato" value="<?php echo $res["idcontratos"]?>"/>

             <input type="hidden" name="num_filas" id="num_filas" />
             
         
	 <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=ventasAdmin','Desea cancelar la operacion actual?.');" />
		</td>
		
	</tr>
 
       
	
     

  
   
	</table>
    
  
   </fieldset>
     </form>
</div>
</div>

 
<div class="clear"></div>
 
	
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