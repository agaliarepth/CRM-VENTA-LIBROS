<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="<?php echo config::ruta();?>css/jquery.simple-dtpicker.css" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
  <script>
		jQuery(document).ready(function(){
			
			
			
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
			
			
			
				   $("#num_cuenta").change(function(){
	    $.ajax({
                              type: "POST",
                              url: "ajax/comprobarCuenta.php",
                              data: "b="+$("#num_cuenta").val(),
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  if(data=="no"){
									 alert("Este numero de Cuenta ya esta registrado...."); 
									 $("#num_cuenta").val("");
									   $("#num_cuenta").focus();
									  n();
									  } 
								
                              }
                  });
	   
	   });
   
		});
            
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
			$("#nombre_vendedor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado3/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado3(event, ui)
		{
			
			$( "#nombre_vendedor" ).val( ui.item.label );
			
			$( "#id_vendedor" ).val( ui.item.idVendedor);
			
			
		
			
			return false;
			
		}
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
			
			$( "#id_cobrador" ).val( ui.item.idcobradores );
			return false;
				}
	
  
   
   $(document).ready(function($)
  {
	  <?php 
if(isset($_GET["estado"])&& $_GET["estado"]=="editar"){

  foreach($res2 as $v){
	  $pt=$v["cantidad"]*$v["precio_unitario"];
	  echo "addTableRow2($v[cantidad],'".$v["codigo"]."','".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$pt,$v[libros_idlibros]);";
	  
	 
	   
    }
	
	  
	}


?>
	  $('#pago_inicial').change(function () {
		  
		    $("#saldo_inicial").val(parseFloat($("#monto_total1").val())-parseFloat($('#pago_inicial').val()));
			
			
			});
	  
	  
	  $('#numero_cuotas').change(function () {
		  
		    $("#cuotamensual").val(parseFloat($("#saldo_inicial").val())/parseFloat($('#numero_cuotas').val()));
			
			
			});

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
   
   function addTableRow2( cantidad,codigo, titulo, tomo,pu,pt,id)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
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
		 
		 if($( "#id_vendedor" ).val()==""){
			 alert("no ah sellecionado un vendedor");
			 $( "#nombre_vendedor" ).focus();
			 return false;
			 
			 }
			  if($( "#id_cobrador" ).val()==""){
			 alert("no ah sellecionado un Cobrador...");
			 $( "#nombre_cobrador" ).focus();
			 return false;
			 
			 }
			  if($("#cantidad").val()=="0"){
			 alert("No Existem Items ...");
			
			 return false;
			 
			 }
		 }
		 
		   
 
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 <br />

 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Registro de Cuenta</h1>
  <br />
  <hr />
   <br />
  
 
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
	

   <?php if(isset($_GET["estado"])&& $_GET["estado"]=="editar"){?>

		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="wizard"   onsubmit="return validarForm();" >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td colspan="2"> <label for="cliente">Cliente:</label>
		
		<input type="text" class="validate[required]" style="width:400px; height:27px" name="cliente"  value="<?php echo $res["nombre_cliente"]?>"/>
		</td>
         <td colspan="0" >
       <label>Carnet:</label>
        
        
         
		<input  type="text" class="inp2-form"  name="ci_cliente"  value="<?php echo $res["ci_cliente"]?>"/></td>
       
        <td>
       <label> Num Contrato:</label>
        
        
         
		<input  type="text" class="validate[required]" style="width:88px; height:27px" name="num_contrato"  value="<?php echo $res["numcontrato"]?>"/></td>
       <td>
       <label> Numero Cuenta</label>
        
        
         
		<input  type="text" class="fechas"  name="num_cuenta"  id="num_cuenta" value="<?php echo $res["num_cuenta"]?>"/></td>
         <td> <label>Fecha Cuenta: </label>
           
           <input type="text"   name="fecha" id="fecha" class="fechas"  value="<?php echo $res["fecha_creacion"]?>"/>
           
           
          
            </td>
          
       
       
		</tr> 
        <tr> 
        <td> <label for="cliente">Cobrador:</label>
		
		<input type="text" class="inp-form" name="nombre_cobrador"  id="nombre_cobrador" value="<?php echo $res["nombre_cobrador"]?>" />
		</td>
        <td> <label for="cliente">Vendedor:</label>
		
		<input type="text" class="inp-form" name="nombre_vendedor"  id="nombre_vendedor" value="<?php echo $res["nombre_vendedor"]?>"/>
		</td>
       <td> <label for="cliente">Precio de Venta:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="monto_total1"   value="<?php echo $res["monto_total"]?>" id="monto_total1" />
		</td>
        <TD>
        <label for="cliente">Pago Inicial:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="pago_inicial" value="<?php echo $res["pago_inicial"]?>" id="pago_inicial"/>
        
        </TD>
        <td> <label for="cliente">Saldo Inicial:</label>
		
		<input type="text"  style="width:80px; height:27px;" name="saldo" value="<?php echo $res["saldo"]?>" id="saldo_inicial"/></td>
        <td> <label for="cliente">Saldo Actual:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="saldo_actual"   value="<?php echo $res["saldo_actual"]?>" />
		</td>
        <td> <label for="cliente">Num Pagos:</label>
		
		<input type="text"class="validate[required,custom[number]]" style="width:80px; height:27px;" name="numero_cuotas"  value="<?php echo $res["numero_cuotas"]?>" id="numero_cuotas"/>
		</td>
     <td> <label for="cliente">Cu Mensual:</label>
       <input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="cuotamensual" value="<?php echo $res["cuotamensual"]?>" id="cuotamensual" /></td>
         <td> 
		</td>
       
       
       
        </tr>       
     
        
        <tr> 
        <td> <label for="cliente">Zona:</label>
		
		<input type="text" class="inp-form" name="zona" value="<?php echo $res["zona"]?>" />
		</td>
        <td> <label for="cliente">Barrio:</label>
		
		<input type="text" class="inp-form" name="barrio"  value="<?php echo $res["barrio"]?>"/>
		</td>
       <td colspan="2"> <label for="cliente">Direccion:</label>
		
		<input type="text" class="inp-form" name="dir"   value="<?php echo $res["dir"]?>" />
		</td>
        <td> <label for="cliente">Telf:</label>
		
		<input type="text" class="inp2-form" name="telf" value="<?php echo $res["telf"]?>" />
		</td>
       
     <td colspan="2"> <label for="cliente">Lugar Cobranza:</label>
		
		<input type="text" class="inp-form" name="lugar"  value="<?php echo $res["lugar"]?>"/>
		</td>
        <td> <label for="cliente">Dia Cobranza:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="diacobranza"  value="<?php echo $res["diacobranza"]?>" />
		</td>
       
       
        </tr>       
      <tr>
       
     
       <td> <label for="cliente">Verificador:</label>
		
		<input type="text" class="inp-form" name="verificador" value="<?php echo $res["verificador"]?>"  />
		</td>
      <td> <label for="cliente">Transferencia:</label>
		
		<input type="text" class="inp-form" name="transferencia" value=" <?php echo $res["transferencia"]?>"/>
		</td>
        <td colspan="2"> <label for="cliente">Supervisor:</label>
		
		<input type="text" class="inp-form" name="sup" value="<?php echo $res["sup"]?>"  />
		</td>
         <td colspan="2"> <label for="cliente">G.C.:</label>
		
		<input type="text" class="inp-form" name="gc"  value="<?php echo $res["gc"]?>" />
		</td>
        <td>
        <td colspan="2">
        <label for="cliente">Observaciones</label>
        <textarea name="obs" id="obs"><?php echo $res["obs"]?></textarea>
        </td>
        
        </td>
       </tr>
          
           
           </thead>
           </table>
           
<hr />
<p>&nbsp;</p>
<table>
           
        <tr>
        
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
<p>&nbsp;</p>
<table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0">
            
                    <thead>
                    <tr><td><label for="pu" >CANT TOTAL: </label>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
   <td><label for="monto_total" >MONTO TOTAL</label>
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
   </tr>
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
                   
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" />
                 <input type="hidden" name="Editar" id="Editar" value="Editar" />
                 
                   <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="id_vendedor" id="id_vendedor" value="<?php echo $res["id_vendedor"];?>" />
                <input type="hidden" name="id_cobrador" id="id_cobrador" value="<?php echo $res["id_cobrador"];?>" />
                   <input type="hidden" name="idcuentas" value="<?php echo $res["idcuentas"];?>" />
         

               
            </form>
            <?php } else { ?>
            <form method="post"   class="contacto"  action="" name="form" id="wizard"   onsubmit="return validarForm();" >
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td colspan="2"> <label for="cliente">Cliente:</label>
		
		<input type="text" class="validate[required]" style="width:400px; height:27px" name="cliente"  value=""/>
		</td>
         <td colspan="0" >
       <label>Carnet:</label>
        
        
         
		<input  type="text" class="inp2-form"  name="ci_cliente"  value=""/></td>
       
        <td>
       <label> Num Contrato:</label>
        
        
         
		<input  type="text" class="validate[required]" style="width:88px; height:27px" name="num_contrato"  value=""/></td>
       <td>
       <label> Numero Cuenta</label>
        
        
         
		<input  type="text" class="fechas"  name="num_cuenta"  id="num_cuenta" value=""/></td>
         <td> <label>Fecha Cuenta: </label>
           
           <input type="text"   name="fecha" id="fecha" class="fechas"  value="<?php echo date("Y-m-d");?>"/>
           
           
          
            </td>
          
       
       
		</tr> 
        <tr> 
        <td> <label for="cliente">Cobrador:</label>
		
		<input type="text" class="inp-form" name="nombre_cobrador"  id="nombre_cobrador" value="" />
		</td>
        <td> <label for="cliente">Vendedor:</label>
		
		<input type="text" class="inp-form" name="nombre_vendedor"  id="nombre_vendedor" value=""/>
		</td>
       <td> <label for="cliente">Precio de Venta:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="monto_total1"   value="" id="monto_total1" />
		</td>
        <TD>
        <label for="cliente">Pago Inicial:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="pago_inicial" value="" id="pago_inicial"/>
        
        </TD>
        <td> <label for="cliente">Saldo Inicial:</label>
		
		<input type="text"  style="width:80px; height:27px;" name="saldo" value="" id="saldo_inicial"/></td>
        <td> <label for="cliente">Saldo Actual:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="saldo_actual"   value="" />
		</td>
        <td> <label for="cliente">Num Pagos:</label>
		
		<input type="text"class="validate[required,custom[number]]" style="width:80px; height:27px;" name="numero_cuotas"  value="" id="numero_cuotas"/>
		</td>
     <td> <label for="cliente">Cu Mensual:</label>
       <input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="cuotamensual" value="" id="cuotamensual" /></td>
         <td> 
		</td>
       
       
       
        </tr>       
     
        
        <tr> 
        <td> <label for="cliente">Zona:</label>
		
		<input type="text" class="inp-form" name="zona" value="" />
		</td>
        <td> <label for="cliente">Barrio:</label>
		
		<input type="text" class="inp-form" name="barrio"  value=""/>
		</td>
       <td colspan="2"> <label for="cliente">Direccion:</label>
		
		<input type="text" class="inp-form" name="dir"   value="" />
		</td>
        <td> <label for="cliente">Telf:</label>
		
		<input type="text" class="inp2-form" name="telf" value="" />
		</td>
       
     <td colspan="2"> <label for="cliente">Lugar Cobranza:</label>
		
		<input type="text" class="inp-form" name="lugar" />
		</td>
        <td> <label for="cliente">Dia Cobranza:</label>
		
		<input type="text" class="validate[required,custom[number]]" style="width:80px; height:27px;" name="diacobranza"  />
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
<p>&nbsp;</p>
<table>
           
        <tr>
        
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
<p>&nbsp;</p>
<table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0">
            
                    <thead>
                    <tr><td><label for="pu" >CANT TOTAL: </label>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
   <td><label for="monto_total" >MONTO TOTAL</label>
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
   </tr>
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
                   
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" />
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
                 
                   <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="id_vendedor" id="id_vendedor" />
                <input type="hidden" name="id_cobrador" id="id_cobrador" />
         

               
            </form><?php }?>
		</td>
		<td>			<input type="Limpiar" value="" class="form-reset"  onclick="cancelar('<?php config::ruta()?>?accion=cuentas');" />
</td>
	
	</tr>
                </table>		
        <hr />
        <table  style="margin-top:15px;">
        <tr align="center">
		<td valign="center">
			
                  
              


		</td>
		<td>			
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