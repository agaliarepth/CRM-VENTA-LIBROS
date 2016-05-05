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
			$("#vendedor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " / CI: " + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{	$( "#vendedor" ).val( ui.item.label );
			$( "#idvendedor" ).val( ui.item.idVendedor );
			return false;
				}
		
		
		
	function validarDevolucion(iddevolucion,idvendedor,fecha){

      $.ajax({

                              type: "POST",
                              url: "ajax/validarDevolucion.php?idvendedor="+idvendedor+"&fecha="+fecha,
                              data: "id="+iddevolucion,
                              dataType: "json",
                              error: function(){
                                    alert("error petición ajax");
                              },

                              success: function(data){
								  var string="No se procesaron estos items  en la Devolucion por que ya estan siendo Usados.</br>";
								  if(data==1){

									enviarRuta("<?php echo config::ruta();?>?accion=addDevolucion&id="+iddevolucion+"&e=n","Esta seguro de procesar esta nota de devolucion?.")




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
    <table border="0" cellpadding="0" cellspacing="0" >
       <form name="form"    method="post"  action="<?php echo config::ruta();?>?accion=addDevolucion">
      
      <tr>
       <td> <label><b>ALMACEN:</b></label>
       <select  class="inp-form" name="almacenes">
        <?php foreach($res3 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
              
			
		</select>
        </td>
        <td>
        <label for="nombre_vendedor" > <b>VENDEDOR :</b> </label>
        <input type="text" class="inp4-form" id="vendedor" name="vendedor" >
        <input type="hidden" name="idvendedor"  id="idvendedor" value="" />
             
</td>
     
     <td>   <input type="hidden" name="ienviar" value="enviar" />

        
                <input type="submit"  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" value="Nueva Nota de Devolucion" />
                </td>
        </form>
        </tr>
        </table>
  </div>
 
 <form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1>NOTAS DE DEVOLUCION  > LISTAR </h1>
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



			
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="blue-left" > <a href="<?php config::ruta();?>?accion=relacionNotasDevolucion">RELACION NOTAS DE  DEVOLUCION</a> </td>
                
					
				</tr>
				
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
					<th class="">Acciones</th>
					<th class="" width="15" >Nº Devolucion </th>
                    
                    <th class="">Fecha</th>
                    <th class="">Vendedor</th>
                    <th class="">Almacen </th>
                     <th class="">Tipo Devolucion</th>
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
				
				<?php if($v["estado"]=="Sin Enviar"){ ?>
                  
                 
<img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="validarDevolucion('<?php echo $v["iddevolucion"];?>','<?php echo $v["vendedores_idVendedores"];?>','<?php echo $v["fecha"];?>');"  width="35" height="35" alt="Enviar Nota" />



  	
                  
                  <?php }?>
                    <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=editDevolucion&e=s&id=<?php echo $v["iddevolucion"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a>
				    
				  <?php }?>

					
				<img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["iddevolucion"];?>');"/></a>
                 <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["iddevolucion"];?>&tipo=devolucion" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="35" height="35" /></a>

                </td>
               
                				
					<td align="center"><?php echo $v["iddevolucion"];?></td>
                    
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["nombre_vendedor"];?></td>
                     <td><?php echo $v["almacen"]?></td>
                      <td><?php echo $v["tipo"]?></td>

                    <td<?php if( $v["estado"]=="Devuelto"){?>  class="bannerRojo"<?php }  ?>><?php echo $v["estado"]?></td>
                    	<td  align="center">
                   <?php if(isset($_SESSION["modulo_almacenes"])&& $v["estado"]=='ANULADO'){?> 
                 <a href="###"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasDevolucion&id=<?php echo $v["iddevolucion"];?>&e=bd&ia=<?php echo $v["idalmacenes"];  ?>','Realmente desea eliminar  esta Nota.?');"/></a>
                <?php }?>
                <?php if($v["estado"]=="Devuelto"){?>
				<a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasDevolucion&e=anular&id=<?php echo $v["iddevolucion"];?>','Esta Seguro de anular esta nota.?');"/></a>
				
					<?php }?>
                    
                      <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                <a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasDevolucion&e=anular&id=<?php echo $v["iddevolucion"];?>','Esta Seguro de anular esta nota.?');"/></a>
				    
				  <?php }?>
                    
					</td>

					
				</tr><?php				}
				?>
                </tbody>
                <tfoot>
				<tr>
					
				<th class="">Acciones</th>
					<th class="">Nº Devolucion </th>
                    <th class="">Fecha</th>
                    <th class="">Vendedor</th>
                    <th class="">Almacen </th>
                    <th class="">Tipo Devolucion</th>

                    <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
                   
				</tr>
				</tfoot>
                <tbody>
				</table><a href="../controller">controller</a>
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