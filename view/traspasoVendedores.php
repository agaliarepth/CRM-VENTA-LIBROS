 <?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
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
					
 function validarTraspaso(iddevolucion,idvendedor,fecha){

      $.ajax({

                              type: "POST",
                              url: "ajax/validarTraspaso.php?idvendedor="+idvendedor+"&fecha="+fecha,
                              data: "id="+iddevolucion,
                              dataType: "json",
                              error: function(){
                                    alert("error petición ajax");
                              },

                              success: function(data){
								  var string="No se procesaron estos items  en la Devolucion por que ya estan siendo Usados.</br>";
								  if(data==1){

									enviarRuta("<?php echo config::ruta();?>?accion=traspasoVendedores&id="+iddevolucion+"&e=n","Esta seguro de procesar esta nota de devolucion?.")



									  }

									else  {

									$(data).each(function(key,value){

									      string+="Codigo:"+value.codigo+" Cantidad:"+value.cantidad+"</br>";


									});
									mensaje(string,"warning");



										 }
									  n();



                              }
                  });


	}
	 
	  
	  
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=addTraspaso">
      <table>
      <tr>
      <td>
      <label> Envia Vendedor</label>


       
			
		<select  class="inp4-form" id="nombre_vendedor" name="nombre_vendedor" >
            <?php foreach($res3 as $v){?>
            <option value="<?php echo $v["idVendedores"]."||".$v["nombres"]." ".$v["apellidos"]."||".$v["carnet"];?>"><?php echo $v["apellidos"]." ".$v["nombres"];?></option><?php }?>
            </select>
       
      </td>
          <td>
             <label>Fecha</label>
             <input type="text" class="fechas" id="fecha" name="fecha" value="<?php echo date("Y-m-d"); ?>"/>
</td>
<td>
        <input type="hidden" name="ienviar" value="enviar" />

        
                <input type="submit"  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"  value="Nueva Nota de Traspaso" />
                </td>
                </tr>
                </table>
        </form>
  
  </div>
   
 
 <form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1>NOTAS DE TRASPASO > LISTAR </h1>
  </td>
 <th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1 ) {?> selected="selected"<?php }?>>ENERO</option>
<option value="2"  <?php if(date("m")==2) {?> selected="selected"<?php }?>>FEBRERO</option>
<option value="3" <?php if(date("m")==3) {?> selected="selected"<?php }?>>MARZO</option>
<option value="4" <?php if(date("m")==4) {?> selected="selected"<?php }?>>ABRIL</option>
<option value="5" <?php if(date("m")==5) {?> selected="selected"<?php }?>>MAYO</option>
<option value="6" <?php if(date("m")==6) {?> selected="selected"<?php }?>>JUNIO</option>
<option value="7" <?php if(date("m")==7) {?> selected="selected"<?php }?>>JULIO</option>
<option value="8" <?php if(date("m")==8) {?> selected="selected"<?php }?>>AGOSTO</option>
<option value="9" <?php if(date("m")==9) {?> selected="selected"<?php }?>>SEPTIEMBRE</option>
<option value="10" <?php if(date("m")==10) {?> selected="selected"<?php }?>>OCTUBRE</option>
<option value="11" <?php if(date("m")==11) {?> selected="selected"<?php }?>>NOVIEMBRE</option>
<option value="12" <?php if(date("m")==12) {?> selected="selected"<?php }?>>DICIEMBRE</option>


</select></th>
<th><label for="anio">AÑO </label><select name="anio" class="inp2-form">
<option value="2013"   <?php if(date("Y")==2013) {?> selected="selected"<?php }?>>2013</option>
<option value="2014"   <?php if(date("Y")==2014) {?> selected="selected"<?php }?>>2014</option>
<option value="2015"   <?php if(date("Y")==2015) {?> selected="selected"<?php }?>>2015</option>
<option value="2016"   <?php if(date("Y")==2016) {?> selected="selected"<?php }?>>2016</option>
<option value="2017"   <?php if(date("Y")==2017) {?> selected="selected"<?php }?>>2017</option>
<option value="2018"   <?php if(date("Y")==2018) {?> selected="selected"<?php }?>>2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>



</select>

</th>
 <td>



                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
  </tr>
  </table>
  <input type="hidden"  name="consulta" value="consulta" />
  </form>
  <hr />
  </div>


<div id="table-content">
<?php 

if(isset($_GET["m"])){
	
	switch($_GET["m"]){
		case '1': break;
		case '1': break;
		case '3':{ ?>
        <div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Se intento eliminar una Categoria en forma Erronea....</td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		}
	
	}


?>			
				<!--  start message-yellow -->
				
				<!--  end message-blue -->
			
				<!--  start message-green -->
				
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Acciones</th>
					<th class="">Nº Traspaso </th>
                   
                    <th class="">Fecha</th>
                    <th class="">Recibe</th>
                    <th class="">Envia</th>
                    <th class="">Estado</th>

                    
                   <th class="">Borrar</th>
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr <?PHP  if ($v["estado"]=="ANULADO"){?> style="background-color:#CCC"<?PHP }?>>
                <td>				
                <img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verTraspaso&id=<?php echo $v["idtraspasos"];?>');"/></a>
                    <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["idtraspasos"];?>&tipo=traspaso" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="35" height="35" /></a>
                </td>
               <td><?php echo $v["idtraspasos"];?></td>
					
					<td><?php echo $v["fecha"];?></td>
                   
                    <td><?php echo $v["recibe"]?></td>
                    <td><?php echo $v["envia"]?></td>
                    <td><?php echo $v["estado"]?></td>
                   
                    	<td >

                   <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=editTraspaso&e=s&id=<?php echo $v["idtraspasos"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a>
                            <img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="validarTraspaso('<?php echo $v["idtraspasos"];?>','<?php echo $v["idenvia"];?>','<?php echo $v["fecha"];?>');" width="35" height="35" alt="Enviar Nota" />

                            <img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=traspasoVendedores&e=anular&it=<?php echo $v["idtraspasos"];?>');"/></a>

                   <?php }?>

                    <?php if($v["terminado"]==1&& $v["estado"]!="ANULADO") {?>
                    <img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=traspasoVendedores&e=anular&it=<?php echo $v["idtraspasos"];?>');"/></a>

                       <?PHP }?>
                       </td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				<th class="">Acciones</th>
						<th class="">Nº Traspaso </th>
                    <th class="">Fecha</th>
                    <th class="">Recibe</th>
                    <th class="">Envia</th>
                    <th class="">Estado</th>

                    
                   <th class="">Borrar</th>
                    
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