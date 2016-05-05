 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 


<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>

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
			$("#libro").autocomplete({
				source: "ajax/searchProductos.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + ":" + item.titulo + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{
			
			$( "#libro" ).val( ui.item.codigo );
			$( "#titulo" ).val( ui.item.titulo);
			$( "#idlibro" ).val( ui.item.id);
			
			
		
			
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
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=kardexMayorTotal">
         <table>
         <tr>
           <td><table>
             <tr>
               
               <th><label for="mes">Mes</label>
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
               <th><label for="anio">Año</label>
                 <select name="anio" class="inp2-form">
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
              
               <td><input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" /></td>
             </tr>
             <tr>
         
             </tr>
           </table></td>
         </tr>
         </table>
      </form>
  </div>
  <div style="float:right;">
  <?php if(isset($_POST["consulta"])){?>
 <form action="<?php config::ruta();?>?accion=reporteKardexMayorTotal" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="codigo" name="codigo" value="<?php  echo $_POST["libro"];?>"/>
<input type="hidden" id="titulo_libro" name="titulo_libro" value="<?php  echo $_POST["titulo"];?>"/>

</form>
<?php }?>
</div>
  <h1>Kardex Mayor ><span style="color:#F30;"></h1>
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
                
				<?php if(isset($_POST["consulta"])){?>
				<table   border="1" id="categorias-table"  width="60%" >

				
				      <thead style="background-color:#999; font-size:9px;">
				        <tr>
				          <th   >N&deg;</th>
  				          <th   >NRO DOC</th>

                          <th   >ITEM</th>
				          <th  >FECHA</th>
				          <th   class="">PROCEDENCIA</th>
				          <th   class="">INGRESO</th>
				          <th   align="center">EGRESO</th>
				          <th    class="">SALDO</th>
                          <th  class="">CONCEPTO</th>
                          <th  class="">OBSERVACIONES</th>
				        </tr>
			          
				      
                      </thead>
				      <tbody>
				       
                      <?php 
					  $s1=0;
				
					  $cont=1; foreach($res as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["num_doc"];?></td>

                       <td><?php  $aux=$li->getCodigo($v["idlibros"]); echo $aux["codigo"]?></td>
                        <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["procedencia"];?></td>
                       
                          <td><?php echo $v["ingreso"];?></td>
                           <td><?php echo $v["salida"];?></td>
                            <td></td>
                             <td><?php echo $v["concepto1"];?></td>
                             <td></td>
                            
                      
                      </tr>
                      
                      <?php $cont++;} foreach($res3 as $r){?>
					  <tr >
                      <td><?php echo $cont++;?></td>
                       <td></td>
                      <td><?php echo $r["codigo"];?></td>
                       <td><?php echo $anio."-".$mes."-31";?></td>
                        <td><?php echo "ALM";?></td>
                          <td>0</td>
                          <td><?php echo $det->sumarPorCodigoKardexMayor($r["codigo"],$_POST["mes"],$_POST["anio"]);?></td>
                          <td></td>
                          <td><?php echo "REGISTRO VENTA";?></td>

                        
                          <td></td>
                          
                      </tr>
                      <?php }?>
					
				      
			          </tbody>
				      <tfoot>
			
				     
			          </tfoot>
			        </table>
                    
                    
                  
				<?php }?>
				<!--  end product-table................................... --> 
				<!--  end content -->
<div class="clear">&nbsp;</div>
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