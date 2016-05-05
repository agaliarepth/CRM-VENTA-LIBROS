 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
	
   <script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
    <script>
		jQuery(document).ready(function(){
 
		
	
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
    var date;
	
	function validarCarnet(){
	  
              var consulta = $("#ci").val();
			  var sw1=false;
			
                                 
                        $.ajax({
                              type: "POST",
                              url: "ajax/comprobarCarnet.php",
                              data: "b="+consulta,
                              dataType: "html",
							  processData: true,
							  async:false,
                              error: function(){
                                    mensaje("error petición.","error");
                              },
                              success: function(data){
								 
								  if(data=="si"){
									 
									  sw1=true;
									 
									  } 
									  else{
										  sw1=false; 
										 
										  }                                                  
                                  
                              }
                  });
			
				  return sw1;
                           
	  }
	  function validarCliente(){

              var consulta = $("#ci").val();
			  var sw1=false;


                        $.ajax({
                              type: "POST",
                              url: "ajax/validarCliente.php",
                              data: "b="+consulta,
                              dataType: "html",
							  processData: true,
							  async:false,
                              error: function(error){
                                    mensaje("error petición."+error,"error");
                              },
                              success: function(data){

								  if(data=="0"){

									  sw1=true;

									  }
									  else{
										  sw1=false;

										  }

                              }
                  });

				  return sw1;

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
			$( "#idcobrador" ).val( ui.item.idcobradores );
			return false;
				}
				
				
				
		
			$(function()
		{


		});


		function productoSeleccionado1(event, ui)
		{


			var i2=$("#supervisor").val();

			$( "#libro" ).val( ui.item.titulo );
			$( "#codigoLabel" ).val( ui.item.codigo );
			$( "#pu" ).val( ui.item.precio );

			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			idk=parseInt(ui.item.idk);
			codigo=ui.item.codigo;
			$( "#pu" ).focus();
			$("#cantidad").val(1);


			  $.ajax({
                              type: "POST",
                              url: "ajax/buscarPrecio.php",
                              data: "b="+ui.item.id,
                              dataType: "html",
                              error: function(){
                                    mensaje("error petición.","error");
                              },
                              success: function(data){

									  $( "#pu" ).val( data);
									  n();



                              }
                  });

				   $.ajax({

                              type: "POST",
                              url: "ajax/buscarStockRemitidoMes.php?id="+i2+"&fecha="+date,
                              data: "b="+ui.item.codigo,
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
		
	  function validarNumContrato(){
		  var valor=$("#buscarContrato").val();
		var sw2;
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/validarContrato.php",
                              data: {fieldValue:valor},
                              dataType: "json",
							  async:false,
                              error: function(){
                                    mensaje("error petición.","error");
                              },
                              success: function(data){
								  
								  					  
									sw2=data.response;
									
										 }
									 
									                                                
                                  
                                  
                              
                  });
				  return sw2;
		}
	
	
	
  $(document).ready(function($)
  {
	 

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
	
	$("#montocancelado").change(function(){
		
		var saldo=parseFloat($("#monto_total").val()-$(this).val());
		if(saldo<0){
			mensaje("El monto cancelado no puede ser mayor al monto total del contrato.","warning");
			$(this).val("");
			$("#saldocontado").val(0);
			$(this).focus();
			
			}
			else
			$("#saldocontado").val(saldo);
		});
	
	  	$("#cantidad").bind('keypress', function(event)
	{
	if (event.keyCode == '13')
		{
	if(verificaPrecio()&& validarDisponible()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id,idk);
	}
	 return;
		}//fin de code
		
		});
		
		 	$("#pu").bind('keypress', function(event)
	{
	if (event.keyCode == '13')
		{
	if(verificaPrecio()&& validarDisponible()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id,idk);
	}
	 return;
		}//fin de keycode
		if(event.keyCode == 8){
			
			$("#pu").val('');
			}
		return;
		});
	  
	   $('#cuota_inicial').change(function () {
		   
		   if(parseFloat($('#cuota_inicial').val())>parseFloat($("#monto_total").val()) || $("#monto_total").val()==0){
			   
			   mensaje("La cuota inicial no pude ser mayor al monto total del contrato.","warning");
			   $('#cuota_inicial').val("");
			   $('#cuota_inicial').focus();
			   $("#saldo").val(0);
			   
			   }
			   else {
		  
		   sa=parseFloat($("#monto_total").val())-parseFloat($('#cuota_inicial').val());
		    $("#saldo").val(sa.toFixed(2));
			   }
			
			});
			
			  $('#num_pagos').change(function () {
		  
		    mp=parseFloat($("#saldo").val())/parseFloat($('#num_pagos').val());
		  
		    $("#monto_pagos").val(mp.toFixed(2));
			
			
			});
      
      
	 
	  
	  
	  
	  
	 
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarDisponible()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id,idk);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   

   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id,idk)
   {
    campo = '<tr aling ="center"><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" onchange="recalcularPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><input type="hidden"  id="idkardex' + nextinput + '"  name="idkardex[]' + nextinput + '" value="'+idk+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	if(typeof(codigo)=="undefined"){
	mensaje("ERROR::Este codigo de libro No se Encuentra Registrado En El Catalogo","error");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	mensaje("ERROR::El Item Num:"+array[array.indexOf(codigo)]+" esta duplicado o No se Encuentra Registrado En El Catalogo.","error");
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
var tt=$("#campos tr:last").find("input").eq(3).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
precio_total.toFixed(2);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#montototal").val(precio_total);
$("#num_filas").val(nextinput);
 recalcularNota();
//alert(total+"-"+nextinput);
   }
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

	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(4).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 	 recalcularNota();


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
		 var sa=$("#saldo").val(precio_total-parseFloat($("#cuota_inicial").val()));
         $("#monto_pagos").val(parseFloat($("#saldo").val())/parseFloat($("#num_pagos").val()));
         $("#saldocontado").val(precio_total-parseFloat($("#montocancelado").val()));

		   
		   }
  
   function eliminarFila(b ){
	  
	     

	      var tt=$("#"+b.id).parent().parent().find("input").eq(3).val();
	  	  var pt=$("#"+b.id).parent().parent().find("input").eq(5).val();
		   var cod=$("#"+b.id).parent().parent().find("input").eq(0).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);




	  nextinput =nextinput -1;
	  
	  
	  if(nextinput==0){
		  total=0;
		  precio_total=0;
		 $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
	  $("#montototal").val(precio_total);
      $("#num_filas").val(nextinput);
      recalcularNota();
		  
		  }
	
		else{ 
		
	total=total-parseInt(tt);
	 
	  precio_total=precio_total-parseFloat(pt);
	  precio_total.toFixed(2);

	  
	  $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
	  $("#montototal").val(precio_total);
      $("#num_filas").val(nextinput);

		}

$("#"+b.id).parent().parent().remove();
 recalcularNota();
	  }
	  
	    function validarDisponible(){
		var dis=$("#stock").val();
		var cant=$("#cantidad").val();
		if(parseInt(dis)==0)
		 {
			 mensaje("No hay stock suficiente.","warning");
			 return false;
			 }
			 else{
				 if(parseInt(cant)>parseInt(dis)){
					  mensaje("No hay stock suficiente.","warning");
			 return false;
					 
					 }
				 
				 }
           
			return true;		
		  }
	  
	    function validarCantidad(){
			 var patron = /^\d*$/;  
		
				if($( "#cantidad" ).val()==""){
				mensaje("ERROR::Ingrese un cantidad.","error");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               mensaje("ERROR::La cantidad no es correcta.","error");
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
mensaje('ERROR::Formato no valido en el campo Precio',"error");
return false;
}
else
return true;
}

function verRemisiones(){

	window.open('<?php echo config::ruta()?>?accion=verResumenCargos&iv=<?php echo $supervisor;?>',"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=600, height=400");
	
	
	}

	function verRemisionesMes(){
	var date=$("#fecha").val();

	window.open('<?php echo config::ruta()?>?accion=verResumenCargosMes&iv=<?php echo $supervisor;?>&fecha='+date,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=600, height=400");


	}
	
	function validarContrato(){
         
   if( validarNumContrato())
          {
mensaje("El contrato Num:: "+$("#buscarContrato").val()+":: ya se encuentra registrado.","error");
          }

    else{
    	   if(validarCarnet())
		   {


		    if($("#fecha").val()=="")
		    mensaje("Ingrese una fecha valida","warning");

		    else{

               $("#tabla-validacion").fadeOut(500);
			   $("#wizard").fadeIn(1000);
			   $("#numcontrato").val($("#buscarContrato").val());
			   $("#carnet").val($("#ci").val());
			   $("#fecha_contrato").val($("#fecha").val());
			    date=$("#fecha").val();
			    var i2=$("#supervisor").val();

			$("#codigoLabel").autocomplete({
				source: "ajax/ventas.php?id="+i2+"&fecha="+date,				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado1/* esta es la rutina que extrae la informacion del registro seleccionado */

			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + " /<b> " + item.titulo + "</b></a>" )
    .appendTo( ul );
};

			    }//finelse
			   }
  else{


			   mensaje("Cliente con deudas. No se pude procesar el contrato.","warning");
				   
               }


    }      
          	}

function validarForm(){
	if(($("#idcobrador").val()==0||$("#idcobrador").val()=='')&&$("#tipoventa").val()=='CREDITO'){
				mensaje("No  se asigno un cobrador a este contrato.","error");
			return;
				
				}
	var ret=true;
	$("#campos tr").each(function(index) {
					
					var pk=$(this).find("td").eq(7).find("input").attr("value");
					$.ajax({
					  
                              type: "POST",
                              url: "ajax/validarDisponibleContrato.php",
                              data: "idkardex="+pk,
                              dataType: "json",
							  async:false,
                              error: function(){
                                    alert("error petición ajax");
                              },

                              success: function(data){
								  
								  if(data==0){
									  
									
										
										ret=false;
										 
										 
										
										 }
									                                                
                                  
                                  
                              }
                  });
              
                });	
			
if(ret)
  confirmForm($("#wizard"),"Esta guardando el contrato con los siguientes datos.<br> Contrato N:<b class='resaltar'>"+$("#numcontrato").val()+"</b><br>Tipo Venta:<b class='resaltar'>"+$("#tipoventa").val()+"</b><br>Fecha Contrato:<b class='resaltar'>"+$("#fecha").val()+"</b><br>Cuota inicial:<b class='resaltar'>"+$("#cuota_inicial").val()+"(Bs) </b><br>Fecha Cobro Cuota Inicial:<b class='resaltar'>"+$("#fecha2").val()+"</b><br>Desea continuar?");
else{
	
	mensaje("Hay items Que se encuentran reservados porfavor  recargue la pagina o cancele la operacion","warning");
return false;}
       
	}

  </script> 

<!--  start nav-outer-repeat................................................... END -->


<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">

<table id="tabla-validacion" class="detalleContrato" style="margin:auto; border:dashed 1px; ">
<tr  style="background-color:#FFC;">
<td>
  <label>NUM DE CONTRATO</label><input    class="fechas"type="text" id="buscarContrato"  /></td>


   <td ><label> CARNET DE CLIENTE </label><input type="text" class="fechas" id="ci" name="ci" value=""/></td>
   <td ><label> FECHA CONTRATO </label><input type="text" class="fechas" id="fecha" name="fecha" value=""/><input type="button" value="VALIDAR CONTRATO" onclick="validarContrato();" style="background:#DC0E2D; font-weight:bold; font-size:11px; height:35px; color:#FFF; " /></td>


   </tr>
   </table>

 		
		</div>
  <form action="" method="post"  name="form" id="wizard" style="display:none;" class="FormContrato"   >
  <table style="background-color:#E1F1F7; margin:auto; border:dashed 1px; #CCC; animation-delay:10000" width="70%" border="0">
           <tr >
                            
                            
                            <th>VENDEDOR :</th>
                            <th style="color:#F00; font-weight:bold;"><?php echo  $nombre_vendedor;?></th>
               <th><b>CHOFER:</b></th>
                            <td colspan="5" style="color:#F00; font-weight:bold;"> <?php  echo $nombre_supervisor;?></td>
                            <td><input type="button" value="VER TODAS REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; margin-left:10px; font-size:12px; font-family:calibri; height:35px;"/>
                            <input type="button" value="VER REMISONES DEL MES" onclick="verRemisionesMes();" style=" background-color:#CF0; color:#000; margin-left:5px; font-size:12px; font-family:calibri; height:35px;"/>
                            <input type="hidden" name="supervisor" id="supervisor" value="<?php echo $supervisor;?>"/> </td>
                                         
                           
                            
                         
                        </tr>
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"   class="inp2-form"/></td>

       
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
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  value="0" /></td>
    <td align="right"><B>P.TOTAL</B></td>
   <td colspan="2">
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total"  value="0"/></td>
   <TD ></TD>
   </tr>
                    </tfoot>

       
                </table>	
                
                
                 
                
	

</fieldset>


<fieldset class="fields" style="background-color:#DDE8EE; width:90%; margin:auto "> <legend> DATOS DEL CONTRATO</legend>
<table   border="0" class="detalleContrato" cellpadding="0" cellspacing="0" >
       
        
        <tr>
         <td><label>TIPO CONTRATO<span> * </span></label><select name="tipoventa" id="tipoventa" style="width:120px;height:27px;" class="fechas">
         <option value="CREDITO">CREDITO</option>
         <option value="CONTADO">CONTADO</option>
         
         </select> </td>
			
			<td><label >Num  Contrato <span>*</span></label>
            <input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:100px; height:20px" id="numcontrato" name="numcontrato" value="" readonly  /> </td>
           
            <td ><label >Fecha Contrato <span> * </span></label><input type="text" class="fechas"  name="fecha_contrato"  id="fecha_contrato" readonly/>
           </td>
          <td><label>Localidad del contrato <span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="localidad" name="localidad" value="<?php echo CIUDAD;?>"/> </td>
           <td><label>Nombres<span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="nombres" name="nombres"/> </td>
            <td><label>Apellido Paterno: <span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px"id="apellidopaterno" name="apellidopaterno" /> </td>
             <td><label>Apellido Materno</label><input type="text" style="width:150px; height:20px"id="apellidomaterno" name="apellidomaterno" /> </td>
               <td><label>CARNET<span> * </span></label><input type="text" readonly class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:70px; height:20px"id="carnet" name="carnet" /> </td>
          
            
		</tr>
        </table>
        <table id="tabla-credito" border="0" cellpadding="0" cellspacing="0" class="detalleContrato" >
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
        <td colspan="7" ><b>DATOS DEL CREDITO</b></td>
        </tr>
        <tr>
          	 <td ><label>CUOTA INICIAL<span> * </span> </label><input type="text" class="validate[custom[number],required]" style=" width:100px; height:20px" id="cuota_inicial" name="cuota_inicial" value=""/></td>
              <td ><label>FECHA  COBRO CI<span> * </span> </label><input type="text" class="fechas" style=" width:100px; height:20px" id="fecha2" name="fechacobranza" value="<?php echo date("Y-m-d")?>"/></td>
                 <td ><label >SALDO <span> * </span></label><input type="text" class="validate[custom[number],required]" style="width:100px;  height:20px" id="saldo" name="saldo"  value=""/> </td> 
                 
                 
            <td width="20"  >
            <label>NUM DE PAGOS <span> * </span></label>
            <input type="text" class="validate[custom[integer],required]" style="width:100px;  height:20px;"  id="num_pagos" name="num_pagos" value=""/>
             </td> 
            
            
        <td ><label>MONTO X PAGO <span> * </span></label><input type="text" class="validate[custom[number],required]" style="width:100px;  height:20px" id="monto_pagos" name="monto_pagos"   value=""/> </td>

        <td>
        <label style="font-size:9px">MONTO COMISIONABLE  <span> * </span></label>
        <input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:100px; height:20px; " id="valorcomisionable" name="valorcomisionable1" />
         </td>
         <td>
        <label >A CUENTA COMISION</label>
        <input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:120px; height:20px; " id="cuentacomision" name="cuentacomision1"  value="0"/>
         </td>
        
             	 <td ><label><?php if($comisiones["tipocomisioncredito"]=="P") {?> Porcentaje Comision %<?php } else{?>Monto Comision (Bs)<?php }?></label>
                 <input  type="text" size="5"  readonly="readonly" value="<?php echo $comisiones["valorcomisioncredito"]?>"name="comisioncontrato1" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px">
                 
                 <input type="hidden"  name="tipocomisioncredito" value="<?php if($comisiones["tipocomisioncredito"]=="P") echo "P";  else echo "M"; ?>"/>
                 
                
                 
                 </td>
                
              <td  colspan="3" style="background-color:#FFC;" ><label> NOMBRE DEL COBRADOR</label><input style="width:150px; height:20px; " type="text"  id="cobrador" name="cobrador" value=""/>
            <input  type="hidden" id="idcobrador" name="idcobrador"/>
            
            </td>
			</tr>
           
            </table>
            
            
            <table id="tabla-contado" style="display:none" class="detalleContrato">
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
        <td colspan="5"><b>DATOS DE CONTADO</b></td>
        </tr>
		
	
        <tr>
          <td >
            <label>MONTO CANCELADO<span> * </span></label>
            <input type="text" class="validate[custom[number]]" style="width:150px;  height:20px;"  id="montocancelado" name="montocancelado" value=""/>
             </td> 
            
            
                  <td  ><label>SALDO <span> * </span></label><input type="text" class="validate[custom[number]]" style="width:100px;  height:20px" id="saldocontado" name="saldocontado"  readonly="readonly"  value="0"/> </td>
              

			 <td><label >MONTO COMISIONABLE<span> * </span></label><input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:150px; height:20px; " id="valorcomisionable" name="valorcomisionable" value=""/> </td>
          <td>
        <label >A CUENTA COMISION</label>
        <input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" style="width:120px; height:20px; " id="cuentacomision" name="cuentacomision"  value="0"/>
         </td>
             	 <td ><label><?php if($comisiones["tipocomisioncontado"]=="P") {?> Porcentaje Comision %<?php } else{?>Monto Comision (Bs)<?php }?></label>
                 <input  type="text" size="5"  readonly="readonly" value="<?php echo $comisiones["valorcomisioncontado"]?>"name="comisioncontrato" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:30px">
                 
                  <input type="hidden"  name="tipocomisioncontado" value="<?php if($comisiones["tipocomisioncredito"]=="P") echo "P";  else echo "M"; ?>"/>
                 
                 </td>
      

           
             
        
        </tr>
       
       
	</table>
   </fieldset>
    
		
        <table style="margin:auto">
        <TR>
        
		<td >
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="validarForm();"  />
            <input type="hidden" name="nuevoContrato" value="nuevoContrato"/>
            <input type="hidden" name="idvendedor" id="idvendedor" value="<?php echo  $idvendedor;?>"/>
            <input type="hidden" name="num_filas" id="num_filas" />
             <input type="hidden" name="idchofer" value="<?php echo $supervisor;?>" />
               
         
			 <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=contratos','Desea cancelar la operacion actual?.');" />
        </td>
		
	</tr>
   </tfoot>
       
	
     

  
   
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