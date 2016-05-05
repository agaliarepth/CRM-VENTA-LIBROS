 <?php require_once("head.php");?>
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

     <hr />
<form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  width="90%">
  <h1>REGISTROS > CONTRATOS </h1>
  </td>
 <th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1">ENERO</option>
<option value="2">FEBRERO</option>
<option value="3">MARZO</option>
<option value="4">ABRIL</option>
<option value="5">MAYO</option>
<option value="6">JUNIO</option>
<option value="7">JULIO</option>
<option value="8">AGOSTO</option>
<option value="9">SEPTIEMBRE</option>
<option value="10">OCTUBRE</option>
<option value="11">NOVIEMBRE</option>
<option value="12">DICIEMBRE</option>



</select></th>
<th><label for="anio">AÑO </label><select name="anio" class="inp2-form">
<option value="2013">2013</option>
<option value="2014" selected="selected">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
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
  <input type="hidden"  name="contratos" value="contratos" />
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
                  
                    <th class="">Fecha Contrato</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Monto Contrato</th>
                    <th class="">Tipo Contrato</th>
                    
                    <th class="" width="150">Vendedor</th>
                    <th class="" width="150">Chofer</th>
                    <th class="" width="150">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th >Opciones</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td><?php echo $v["idcontratos"];?></td>
              
					
					<td><?php echo $v["fechacontrato"];?></td>
                   
                    <td><?php echo $v["numcontrato"]?></td>
                    
                   <td><?php echo $v["preciototal"]?></td>
                     <td><?php echo $v["tipoventa"]?></td>
                     <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"])?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idchofer"])?></td>                  
                    
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                    	<td >
                        
                      
     
                                                
                          <img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/>
                     
					
					 
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
                
                    <th class="">Monto Contrato</th>
                    <th class="">Tipo Contrato</th>
                    
                    <th class="">Vendedor</th>
                    <th class="">Chofer</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th >Opciones</th>
                  
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

