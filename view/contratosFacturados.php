 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<style type="text/css">
.elegido { font-size:24px;}

</style>

<script type="text/javascript">
				// esta rutina se ejecuta cuando jquery esta listo para trabajar
		var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre_vendedor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.value + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{
			
			$( "#nombre_vendedor" ).val( ui.item.label );
			$( "#ci_vendedor" ).val( ui.item.valor);
			$( "#id_vendedor" ).val( ui.item.idVendedor );
			
		
			
			return false;
			
		}
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			var i=$("#id_almacenes").val();
			$("#libro").autocomplete({
				source: "ajax/searchProductos2.php?id="+i, 				/* este es el formulario que realiza la busqueda */
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
	  
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	if(!validarExiste(codigo))
	return false;
    else{
	if(validarCantidad()){
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, id);
	}
	}
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   
   
   function addTableRow( cantidad, titulo, tomo,id)
   {
    campo = '<tr><td><input type="text" class="inp-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
$("#campos").append(campo);
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#num_filas").val(nextinput);

$("#libro").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
total=total+parseInt(tt);
$("#cant_total").val(total);
$("#num_filas").val(nextinput);
alert(total+"-"+nextinput);
   }
 
  });
   function eliminarFila(b ){
	  // $(b).parent().parent().addClass("elegido");
	   $(b).parent().parent().remove();
	   
	  var tt=$("#detalle tbody tr:last").find("input").eq(0).attr("value");
	 
	  		nextinput =nextinput -1;
	 if(nextinput===0)
	  total =0;
	  else
	  total=total-parseInt(tt);

	  alert(total+"-"+nextinput);
	  $("#cant_total").val()=total;
$("#num_filas").val()=nextinput;
	  return false;
	  }
	    function validarCantidad(){
			 var patron = /^\d*$/;  
			if(parseInt($( "#stock" ).val())<parseInt($( "#cantidad" ).val())){
				alert("No hay suficiente stock o no hay registro de cantidad");
				return false;
				
				
				}
				if($( "#cantidad" ).val()==""){
				alert("ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               alert("Número es correcto");
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
					
                    if(parseInt(pk)==parseInt(va)){
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
					
 
	 
	  
	  
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
 
  <h1>Contratos Facturados   > Listar </h1>
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">
	<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				<!--  end message-yellow -->
				
				<!--  start message-red -->
				
				<!--  end message-red -->
				
				<!--  start message-blue -->
				<div id="message-blue">
				
				</div>
				<!--  end message-blue -->
			
				<!--  start message-green -->
				<div id="message-green">
				
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">Nº </th>
                  
                    <th class="">Fecha Contrato</th>
                    <th class="">Num Contrato</th>
                    <th class="">Cod Cliente</th>
                    <th class="">Monto Contrato</th>
                    <th class="">Cuota Inicial</th>
                    <th class="">Saldo</th>
                    <th class="">Num Pagos</th>
                    <th class="">Vendedor</th>
                    <th class="">Cobrador</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th class="">Opciones</th>
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td><?php echo $cont++;?></td>
              
					
					<td><?php echo $v["fechacontrato"];?></td>
                   
                    <td><?php echo $v["numcontrato"]?></td>
                  <td><?php echo $v["numcuenta"]?></td>
                   <td><?php echo $v["preciototal"]?></td>
                     <td><?php echo $v["cuotainicial"]?></td>
                    <td><?php echo $v["saldo"]?></td>
                    <td><?php echo $v["numcuotas"]?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]);?></td>
                    <td><?php echo $cobrador->getNombresCobrador($v["idcobrador"]);?></td>
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                  
                     
                    	<td >
                        
                                                   <a href="####"><img src="<?php echo config::ruta();?>images/iconos/search.png" width="30" height="30"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>

					<a href="###"><img src="<?php echo config::ruta();?>images/iconos/aprovar.png" width="30" height="30" onclick="enviarRuta('<?php echo config::ruta();?>?accion=addCuenta&id=<?php echo $v["idcontratos"];?>','Se creara una cuenta  para este contrato?');" title="CrearCuenta"/></a>
             
            
					</td>
				</tr><?php
				}
				?>
               
                </tbody>
                <tfoot>
				<tr>
				
					<th class="">Nº </th>
                  
                    <th class="">Fecha Contrato</th>
                    <th class="">Num Contrato</th>
                   <th class="">Cod Cliente</th>
                    <th class="">Monto Contrato</th>
                    <th class="">Cuota Inicial</th>
                    <th class="">Saldo</th>
                    <th class="">Num Pagos</th>
                    <th class="">Vendedor</th>
                    <th class="">Cobrador</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th class="">Opciones</th>
                  
				</tr>
				</tfoot>
                <tbody>
				</table>
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