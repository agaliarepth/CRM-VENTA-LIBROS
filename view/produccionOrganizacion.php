 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<script language="javascript">
$(document).ready(function() {
	 
	 
	
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#produccion-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	
	 
});



 
	
		 
$('#produccion-table').dataTable( {
	
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
	
		
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
		"aaSorting": [ [0,'desc'] ],
        "bInfo": true,
        "bAutoWidth": true,
		 "iDisplayLength": 300,
		
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    
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
       <form name="form"   method="post"  action="">
      <table>
         <tr>
           <td>
           
                <table width="75%">
                  <tr>
                
                 <th> <label><b>FECHA INICIAL</b></label>
              <input  type="text" name="fecha_ini" class="fechas" id="fecha" value="<?php echo date("Y-m-d")?>"/>
              
              </th>
         
               <th> <label><b>FECHA FINAL</b></label>
              <input  type="text" name="fecha_fin" class="fechas" id="fecha2" value="<?php echo  date("Y-m-d")?>"/>
              
              </th>
               
               <th>
               <input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" />
                 </th>
                 </tr>
          
               </table>
           </td>
         </tr>
         </table>
      </form>
  </div>
  <div style="float:right;">
   <?php if(isset($_POST["consulta"])){?>
  <table cellpadding="0" cellspacing="0" border="0">
  <tr>
  <td> IMPRIMIR<a href="javascript:imprSelec('seleccion')" ><img src="<?php config::ruta();?>images/iconos/impresora.png"   width="55" height="55"/></a></td>
  <td>
 
 <form action="<?php config::ruta();?>?accion=reporteProduccionOrganizacion" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="fecha" name="fecha" value="<?php  echo $_POST["fecha_fin"];?>"/>

</form>

<?php }?>
</td>
</tr>
</table>
</div>

  <h1>ALMACEN > REPORTES  </h1>
  <hr />
</div>

<div id="seleccion">
 <?php if(isset($_POST["consulta"])){?>
                <h1 style="font-size:14; text-aligN:center; " > CUADRO DE  PRODUCCION POR ORGANIZACION DE <?php echo $_POST["fecha_fin"] ?></h1>
<div id="table-content">
<?php }?>
			
		
		 
				<?php if(isset($_POST["consulta"])){?>
                <div style="width:70%">
				<table  width="100%"   id="produccion-table"  border="1" cellpadding="0" cellspacing="0" >

				 
				      <thead style="background-color:#999; font-size:9px;">
				        <tr>
				          <th width="150"  >EJECUTIVOS DE VENTAS</th>
				          <th width="32" >N&deg; CTTOS <BR />EFECTIVOS</th>
				          <th width="132"  class="">BOLIVIANOS</th>
				           <th width="32" >N&deg; CTTOS <BR />DIFERIDOS</th>
				          <th width="32"  class="">BOLIVIANOS</th>
				         <th width="32" >TOTAL  <BR />CONTRATOS</th>
				          <th width="32"  class="">TOTAL<BR />BOLIVIANOS </th>
				          
				      
				       
			          </tr>
                   
                    
                      </thead>
				      <tbody id="kardex1">
				       
                      <?php 
					  $s1=0;
					  $s2=0;
					  $s3=0;
					  $s4=0;
					  $s5=0;
					  $s6=0;
				
					
					  foreach($listaVendedores as $v){
						  $c1=0;
						  $m=0;
						  $vendedor=$ven->getNombreVendedor($v["idvendedor"]);
						  
						  ?>
					  <tr>
                      
                      <td><?php echo $vendedor["nombres"]." ".$vendedor["apellidos"];?></td>
                        <td align="center"><?php  $c2=$c->contarContratosTipoVendedor2($v["idvendedor"],$_POST["fecha_ini"] ,$_POST["fecha_fin"]); $c1+=$c2; $s1+=$c2;echo $c2;?></td>
                         <td align="right"><?php $m1=$c->sumContratosTipoVendedor2($v["idvendedor"],$_POST["fecha_ini"] ,$_POST["fecha_fin"]); 
						 
						 if($m1<=0){
							 echo "0";
							 }
							 else{
						 $m+=$m1; $s2+=$m1; echo number_format($m1, 2, '.', ',');
							 }
						 ?></td>
                        <td align="center"><?php  $c2=$c->contarContratosTipoVendedor("DIFERIDO",$v["idvendedor"],"01-01-2013" ,$_POST["fecha_fin"]); $c1+=$c2; $s3+=$c2;echo $c2;?></td>
                         <td align="right"><?php $m1=$c->sumContratosTipoVendedor("DIFERIDO",$v["idvendedor"],"01-01-2013" ,$_POST["fecha_fin"]); $m+=$m1; $s4+=$m1;  echo number_format($m1, 2, '.', ',');?></td>
                          <td align="center"><?php $s5+=$c1; echo $c1;?></td>
                           <td align="right"><?php $s6+=$m;echo number_format($m, 2, '.', ',');?></td>
                           
                      
                      </tr>
                      
                      <?php }?>
                      
                     <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      
                          <td>=</td>
                          <td  ><?php echo number_format( $s1,2,'.',','); ?></td>
                          <td><?php echo number_format($s2,2,'.',','); ?></td>
                          <td><?php echo number_format($s3,2,'.',','); ?></td>
                          <td><?php echo number_format($s4,2,'.',','); ?></td>
                           <td><?php echo number_format($s5,2,'.',','); ?></td>
                          <td><?php echo number_format($s6,2,'.',','); ?></td>
                      </tr>
					  
					
				      
			          </tbody>
				      <tfoot>
				     
				     
			          </tfoot>
			        </table>
                    
                    
                  
				<?php }?>
                </div>
				<!--  end product-table................................... --> 
				<!--  end content -->
</div>

    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
</div>
</div>
</div>


</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>