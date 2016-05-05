 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_administracion"])){?> 
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
			  
			  mensaje("ERROR:: No eligio un vendedor o un chofer para registrar el contrato.","error");
			  return;
			  } 
			  else{
				  document.form.submit();
				  
				  
				  }
		  }
		  function info(fila){
			  
			alertify.log("EN ESPERA DE NUEVO NUMERO DE CONTRATO");
			  
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
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=addContrato"  >
      
      
       
        <label for="nombre_vendedor" > <b>VENDEDOR :</b> </label>
        <input type="text" class="inp4-form" id="vendedor" name="vendedor" >
          
             <label for="nombre_supervisor" ><b>CHOFER :</b> </label>
        <input   type="text" class="inp4-form" id="supervisor" name="supervisor" >
                       
       <input type="hidden" name="id_vendedor" id="id_vendedor" />
              <input type="hidden" name="id_supervisor" id="id_supervisor" />

             

        <input type="hidden" name="ienviar" value="enviar" />

        
                <input type="button" onclick="validarEnviar();"  value="REGISTRAR CONTRATO" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
        </form>
  </div>
     <hr />
<form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  width="90%">
  <h1>Contratos  > Listar  </h1>
  </td>
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
                    <th class="">Estado</th>
                    
                    <th class="">Vendedor</th>
                    <th class="">Chofer</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th width="150">Opciones</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
				?>
                
                <?php if($v["tipocontrato"]=='BAJA'){?>
                <tr style="background-color:#CCC">
                <td><?php echo $v["idcontratos"];?></td>
              	<td><?php echo $v["fechacontrato"];?></td>
                <td><?php echo $v["numcontrato"]?></td>
                <td><?php echo $v["preciototal"]?></td>
                <td><?php echo $v["tipoventa"]?></td>
                <td><?php echo $v["tipocontrato"]?></td>
                <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"])?></td>
                <td><?php echo $vendedor->getNombresVendedor($v["idchofer"])?></td>                  
                <td><?php echo $v["nombres"]?></td>
                <td><?php echo $v["apellidopaterno"]?></td>
                <td><?php echo $v["apellidomaterno"]?></td>
                    
                <td class="options-width">DE BAJA  <img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></td>
                <?PHP } else {?>
                <tr >
                <td><?php echo $v["idcontratos"];?></td>
              
					
					<td><?php echo $v["fechacontrato"];?></td>
                   
                    <td><?php echo $v["numcontrato"]?></td>
                    
                   <td><?php echo $v["preciototal"]?></td>
                     <td><?php echo $v["tipoventa"]?></td>
                      <td><?php echo $v["tipocontrato"]?></td>
                     <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"])?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idchofer"])?></td>                  
                    
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                    
                    <td class="options-width">
                        
                      
                        <?php if($v["terminado"]==1 && $v["tipocontrato"]=="DIFERIDO"  ){?>
                       
                 <a href="<?php echo config::ruta();?>?accion=addPagoContratos&id=<?php echo $v["idcontratos"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/Venta.png" width="20" height="20" /></a>
               
                 
				 
			

                         <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["numcontrato"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="20" height="20" /></a>
                         
                         <a href="<?php echo config::ruta();?>?accion=editContratoPost&id=<?php echo $v["idcontratos"];?>"> <img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="20" height="20"  alt="Editar" title="editar"/></a>
                         
   <a title="BAJA"> <img src="<?php echo config::ruta();?>images/iconos/rechazar.png" width="20" height="20" onclick="enviarRuta('<?php echo config::ruta();?>?accion=bajaContrato&id=<?php echo $v["idcontratos"];?>','Realmente desea  dar de Baja el contrato<b class=resaltar>numero:<?php echo $v["numcontrato"]?></b> ');" alt="Dar de Baja"/></a>                      
                         
<!--                           
-->                        
                 <a href="<?php echo config::ruta();?>?accion=anularDiferido&id=<?php echo $v["idcontratos"];?>"><img src="<?php echo config::ruta();?>images/iconos/anular.jpg" width="20" height="20" alt="Anular Contrato" title="Anular Contrato" /></a>
                                                
                         <a href="###"> <img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
                     
					<?php }
					 if($v["terminado"]==1 && $v["tipocontrato"]=="VENTA"  ){?>
                       
              
                 
				 
			

                         <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["numcontrato"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="20" height="20" /></a>
                         <a href="<?php echo config::ruta();?>?accion=editContratoVenta&id=<?php echo $v["idcontratos"];?>"> <img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="20" height="20"  alt="Editar" title="editar"/></a>
   <a title="BAJA"> <img src="<?php echo config::ruta();?>images/iconos/rechazar.png" width="20" height="20" onclick="enviarRuta('<?php echo config::ruta();?>?accion=bajaContrato&id=<?php echo $v["idcontratos"];?>','Realmente desea  dar de Baja el contrato<b class=resaltar>numero:<?php echo $v["numcontrato"]?></b> ');" alt="Dar de Baja"/></a>                      
                         
<!--                           
-->                        
               
                                                
                         <a href="###"> <img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
                     
					<?php }?>
					
					
					
				
                 
                    
					 
					</td>

					
				</tr><?php
				}
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
                    <th class="">Estado</th>
                    
                    <th class="">Vendedor</th>
                    <th class="">Chofer</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th width="150">Opciones</th>
                  
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