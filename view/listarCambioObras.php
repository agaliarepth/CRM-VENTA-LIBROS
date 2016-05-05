 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">
				
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
			$( "#id_vendedor" ).val( ui.item.idVendedor );
			return false;
				}
					
 
	 $(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#supervisor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado2/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " / CI: " + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado2(event, ui)
		{	$( "#supervisor" ).val( ui.item.label );
			$( "#id_supervisor" ).val( ui.item.idVendedor );
			return false;
				}
	  
	  function validarEnviar(){
		  
		  if($( "#id_vendedor" ).val()=='' || $( "#id_supervisor" ).val()==''){
			  
			  alert("ERROR:: NO ELIGIO UN VENDEDOR O CHOFER PARA REGISTRAR EL CONTRATO");
			  return;
			  } 
			  else{
				  document.form.submit();
				  
				  
				  }
		  }
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 <form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  width="45%">
  <h1>CAMBIO DE OBRAS  > LISTAR  </h1>
  </td>
  <TD><strong> REGISTRAR CAMBIO OBRA</strong></TD>
   <TD colspan="5">
                <a href="<?php echo config::ruta();?>?accion=cambioObraS"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a>
                </TD>
 <th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1) {?> selected="selected"<?php }?>>ENERO</option>
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
  <input type="hidden"  name="cambioObras" value="cambioObras" />
  </form>
  <hr />
  </div>


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
                    <th class="">Fecha </th>
                    <th class="">Num Cuenta</th>
                     <th class="">Cliente</th>
                    <th class="">Num Ingreso</th>
                    <th class="">Num Egreso</th>
                    <th class="">Estado</th>
                    <th width="150">Opciones</th>
                  </tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
					$res2=$credito->getCreditoContratoId($v["credito_idcredito"]);
				?>
                
      
                <tr >
                <td><?php echo $v["idcambioObra"];?></td>
              	<td><?php echo $v["fecha"];?></td>
                <td><?php echo $res2["numcuenta"]?></td>
                <td><?php echo $res2["nombres"]." ".$res2["apellidopaterno"]." ".$res2["apellidomaterno"]?></td>
                <td><?php echo $v["numingreso"]?></td>
                <td><?php echo $v["numegreso"]?></td> 
                <td><?php echo $v["estado"]?></td>           
                <td class="options-width">
                
                <?php if($v["estado"]=="SIN ENVIAR"){ ?>
                 <a ><img src="<?php echo config::ruta();?>images/iconos/download.png" width="25" height="25" alt="Enviar a Almacen" title="Enviar a Almacen" onclick="enviarAlmacenCambioObra('<?php echo config::ruta();?>?accion=listarCambioObras&e=ea&id=<?php echo $v["idcambioObra"];?>');" /></a>  
                 
                 <a ><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="25" height="25" alt="Eliminar" title="Eliminar" onclick="enviarAlmacen('<?php echo config::ruta();?>?accion=addIngresoVenta&id=<?php echo $v["iddevolucionObras"];?>');" /></a>
                 
                 <?PHP } ?>
                 <?php if($v["estado"]=="APROVADO"){ ?>
                <a href="###"><img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verCambioObra&id=<?php echo $v["idcambioObra"];?>');"/></a>
              
                 
                 <?PHP } ?>
                </td>
               

					
				</tr><?php
				
				}
				?>
               
                </tbody>
                
                
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