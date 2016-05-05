 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
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
    var saldo=0;
    var array=new Array();
    var idalmacen;
    var saldofin=0;
	var total_filas_cuotas=0;
	var total_filas=0;
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
			 $("#idcuenta").val(ui.item.num_cuenta);

			return false;
				}
	  function abrirPop(){
				 var id=$( "#idcuentas" ).val();
				 
				 window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;
				 
				 }
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
			
			$( "#libro" ).val( ui.item.titulo );
			
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
                              url: "ajax/getStockDisponible.php?idalmacen="+idalmacen,
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
  $(document).ready(function($)
  {
	    contarFilas();
		idalmacen=$("#listaAlmacenes").val();
	  $("#saldofin").val($("#saldo_act").val());
	  saldo=$("#saldo_act").val();
	  sumarTotal();
	  verPlanPagos();
	
   //alert($("#listaAlmacenes").val());
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

    
   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr ><td><input type="text"  readonly ="readonly" size="1" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td ><input  style="text-align:center" type="text"  readonly ="readonly" size="5" id="codigo' + nextinput + '"  name="codigo[]"       value="'+codigo+'"  /></td><td><input type="text"  readonly ="readonly"  size="70" id="titulo ' + nextinput + '"  name="titulo[]" value="'+titulo+'"  /></td><td><input style="text-align:center" type="text"   readonly ="readonly" size="1" id="tomo' + nextinput + '"  name="tomo[]" value="'+tomo+'" /></td><td><input  style="text-align:center" type="text"  readonly ="readonly" size="5" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]" value="'+id+'"  /><input type="hidden"  id="tipo" name="tipo[]" value="1"  /></td></tr>';
	
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

$("#codigoLabel").focus();
var prt=parseFloat($("#campos tr:last").find("input").eq(4).attr("value"));
saldo=parseFloat(saldo)+parseFloat(prt);
precio_total=parseFloat(precio_total)+parseFloat(prt);
$("#saldofin").val(saldo);
$("#totaldevo").val(precio_total);
total_filas++;
$("#num_filas").val(total_filas);
verPlanPagos();
   }
   }
  });
  
  
  
   function eliminarFila(b ){
	      
	     

	      var tt=$("#"+b.id).parent().parent().find("input").eq(0).val();
	  	  var pt=parseFloat($("#"+b.id).parent().parent().find("input").eq(4).val());
          var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	      var idx=array.indexOf(cod);
	      if(idx!=-1) array.splice(idx, 1);

             nextinput =nextinput -1;
	  
	  
	  if(nextinput==0){
		  total=0;
		  precio_total=0;
		 $("#cant_total").val(total);
	     $("#totaldevo").val(precio_total);
    		total_filas=total_filas-1;  
		  }
	
		else{ 
		
	total=total-parseInt(tt);
	 
	  precio_total=precio_total-parseFloat(pt);
	  
	  $("#cant_total").val(total);
	  $("#totaldevo").val(precio_total);
	
      total_filas=total_filas-1;

		}

$("#"+b.id).parent().parent().remove();
saldo=parseFloat(saldo)-parseFloat(pt);
$("#saldofin").val(saldo);
sumarTotal();
verPlanPagos();
  $("#num_filas").val(total_filas);
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
		  
		   
       function validarStock(){
				 
				 if($("#stock").val()==""){
				 alert("no selecciono un Libro");
				 return;
				 }
				 else return true;
				 
				 }
				 function sumarTotal(){
					 
					 $("#campos tr").each(function(index, element) {
                     
					num=parseFloat($(this).find("input").eq(4).val());
					//precio_total=precio_total+   
					precio_total=precio_total+num;   
                    });
					 $("#totaldevo").val(precio_total);
					 }
  </script> 

<script type="text/javascript">
	
		
		
		
	
				 
				   function abrirPop2(id){
				
				 
				 window.open('<?php echo config::ruta()?>?accion=verContrato&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;
				 
				 }
				 
				 
	function cambiarFila(fila){
	num=parseFloat($(fila).find("input").eq(4).val());
	
	precio_total=precio_total-num;
	saldo-=num;
	$("#saldofin").val(saldo);
	$("#totaldevo").val(precio_total);
	
	
	$("#Cambios").append(fila);	
	$(fila).find("input").eq(8).val(2);
	$(fila).find("#btn_quitar").css("display","block");

	$(fila).find("#btn_cambiar").css("display","none");

	verPlanPagos();
	
	
					 }
					 
					 
	function QuitarFila(fila){
	num=parseFloat($(fila).find("input").eq(4).val());
	
	precio_total=precio_total+num;
	saldo+=num;
	$("#saldofin").val(saldo);
	$("#totaldevo").val(precio_total);
	
	
	$("#campos").append(fila);	
	$(fila).find("input").eq(8).val(0);
	$(fila).find("#btn_quitar").css("display","none");

	$(fila).find("#btn_cambiar").css("display","block");
	
	verPlanPagos();
	
					 }
					 
					 
					 
					 
					  function contarFilas(){
						  var numfilas=0;
						  $("#campos tr").each(function(index, element) {
                            numfilas++;
                        });
						  total_filas=numfilas;
						  $("#num_filas").val(total_filas);
						  						  }
					 
					 function validarform(){
						 
						 if(confirm("ESTA SEGURO DE GUARDAR EL CAMBIO DE OBRA"))
						  return true;
						  else
						  return false;
						 
						 }
  
  
	 
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 <div class="" style=" ">
<table style="width:100% ">
 <tr  style="background-color:#CCEBF4;">
 <td  >
  <h1>COBRANZAS > CAMBIO DE OBRAS  </h1>
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
       
  </div>
  <?PHP 
    if(isset($_POST["consulta"]) && $_POST["consulta"]=='consulta'){?>

      <form action="" method="post" id="Form" name="Form" onSubmit="return validarform();">

  <table  border="0"cellpadding="0" cellspacing="0"  style="background-color:#CCEBF4;width:100%; font-weight:bold" >
  <tr>
   <td> NOMBRES CLIENTE : <strong><?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?></strong></td>
  <td><input  type="button" onClick="abrirPop2(<?php echo $res["idcontratos"];?>);" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"  value="NUMCONTRATO:<?php echo $res["numcontrato"];?>"/> </td>
  <td>CODIGO - CLIENTE :  <strong><?php echo $res["numcuenta"];?></strong> </td>
  <TD>
  <input type="button" value="MOSTRAR EL KARDEX DE CLIENTE POR COBRAR" onClick="abrirPop();" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" /></TD>
  </tr>
  <tr>
  <td>SALDO:<input  type="text" size="10"  class="fechas" readonly id="saldo_act" value="<?php echo $res["saldo"]-$sumPagos;?>"/></td>
     <td><label>FECHA </label><input type="text"  name="fecha" id="fecha" class="fechas" value="<?php echo date("Y-m-d")?>"/></td>  
                 

  
  
  </tr>
  </table>

	
<table class="detalleContrato">
        <tr>
        
        <td><label>ALMACENES</label><select id="listaAlmacenes" class="inp-form" >
        <?php 
		
		foreach($listaAlmacenes as $l){
			?><option value="<?php echo $l["idalmacenes"]?>"><?php echo $l["descripcion"]?></option>
            <?php
			
			}
		?>
        
        </select></td>
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
   <input id="cantidad" size="5"  class="inp2-form"  readonly="readonly" value="1" />
   </td>
   
   
   <td>
  <img src="<?php config::ruta(); ?>images/iconos/add.png" width="40" height="40" id="adicionar" style="cursor:pointer;"/>
	</td>
    </tr>
	</table>
    <hr/>
    
    
<table  cellpadding="0" cellspacing="0"  id="detalle" border="0"  width="50%" >
            
                   <thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cant</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Tomo</th>
                            <th>PU</th>
                                                        
                        </tr>
                   
                        
                      </thead>
                      <tbody id="campos">  
                        <?php foreach($res2 as $v){?>
                        <tr id="<?php echo $v["iddetalle_contrato"]?>">
                        <td align="center"><input size="1" style="text-align:center" type="text" name="cantidad[]" value="<?php echo $v["cantidad"];?>"/></td>
                        <td align="center" style="font-weight:bold"><input  size="5"   style="text-align:center" readonlytype="text" name="codigo[]" value="<?php echo $v["codigo"];?>"/></td>
                        <td><input   size="75"type="text" name="titulo[]" value="<?php echo $v["titulo"];?>"/></td>
                        <td align="center"><input type="text" style="text-align:center" size="1" name="tomo[]" value="<?php echo $v["volumen"];?>"/></td>
                        <td align="center"><input  type="text" size="5" style="text-align:center" name="precio_unit[]" value="<?php echo $v["precio_unitario"];?>"/> </td>
                        <td id="1"><input type="button"  id="btn_cambiar"value="cambiar" onclick="cambiarFila(this.parentNode.parentNode);"/><input type="button" value="Quitar" id="btn_quitar"  style="display:none"onclick="QuitarFila(this.parentNode.parentNode);"/>
                        <input  type="hidden" name="idlibro[]" value="<?php echo $v["libros_idlibros"]?>" id="idlibro"/>
                         <input   type="hidden" name="tipo[]" value="0" id="tipo"/>
                        </td>
                        </tr>
                   <?php }?>
                            </tbody>       
                  <tr>
                    <TD colspan="2"></TD>
                    <td colspan="2" align="right"><strong>TOTAL</strong></td>
                    <TD><input  style="font-weight:bold"type="text" id="totaldevo" class="inp2-form" name="totaldevo" value="0"/></TD>
                    
                    </tr>
                    
                    <tr>
                    <TD colspan="2"></TD>
                    <td colspan="2" align="right"><strong>SALDO  ACTUAL</strong></td>
                    <TD><input  style="font-weight:bold"type="text" id="saldofin" class="inp2-form" name="saldofin" value="<?php echo $res["saldo"]-$sumPagos;?>"/></TD>
                    
                    </tr>

      
                </table>	
                </td>
               <td>
       <table cellpadding="0" cellspacing="0"  id="detalle" border="0"  width="50%" >
            
                   
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cant</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Vol</th>
                            <th></th>
                          
                           
                            
                            
                          
                        </tr>
                <tbody id="Cambios"></tbody>
                
                </table>	
          <fieldset><legend>REPROGRAMAR PLAN DE PAGOS</legend>
                <table class="detalleContrato">
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
                <th>Fecha<br/>Vencimiento</th>
                 <th>MontoPago</th>
                </thead>
                <tbody id="campoCuotas"></tbody>
                
                
                </table>
                </fieldset>
                <table>
                <tr>
                <td><input type="submit" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar"  /></td>
                <td><input type="Limpiar" value="" class="form-reset"  onclick="cancelar('<?php config::ruta()?>?accion=cambioObras');" />
                <input type="hidden"  name="guardar" value="guardar"/>
                <input type="hidden"  name="idcuentas" id="idcuentas" value="<?php echo $res["idcredito"]?>"/>
                <input type="hidden"  name="num_filas" id="num_filas" />
                <input type="hidden" id="numfilascuotas" name="numfilascuotas"/>
                </td>
                </tr>
                </table>
                </form>
                <?php }?>
				<!--  end product-table................................... --> 
				
			</div>

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