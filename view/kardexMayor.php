 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script language="javascript">


$(document).ready(function() {
	 
	 var saldo=parseInt($("#saldoAnterior").html());

	 ordenar();
	
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexmayor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	
	 
});
function ordenar(){
	saldo=parseInt($("#saldoAnterior").html());

	 $('#kardex1 tr').each(function () {
		  if($(this).find("td").eq(5).html()!=""){
			  
			  saldo=saldo+parseInt($(this).find("td").eq(5).html());
			  $(this).find("td").eq(7).html(saldo);
			  
			  }
			  if($(this).find("td").eq(6).html()!=""){
			  
			  saldo=saldo-parseInt($(this).find("td").eq(6).html());
			  $(this).find("td").eq(7).html(saldo);
			  
			  }
		  
		  });
	
	  $("#saldoFinal").html(saldo);
	}


 
	
		  
		$("#kardexmayor-table thead").click(function(){
			
			 ordenar();
			});  
$('#kardexmayor-table').dataTable( {
		 
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
	
		
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [1,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    
        });
 ordenar();
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
		
		function validarForm(){
			
			if(	$( "#idlibro" ).val())
			
			return true;
			else{
				
				mensaje("ERROR::DEBE SELECCIONAR UN ITEM DE LA LISTA.","error");
				
							return false;
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
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=kardexMayor" onsubmit="return validarForm();">
      <table>
         <tr>
           <td>
           
                <table width="75%">
                  <tr>
                   <th> 
                 <label >CODIGO / TITULO</label>
              
                 <input type="text" name="libro"  class="inp2-form" id="libro" />
                  </th>
                  <th> 
                 <label >TITULO LIBRO</label>
             
                 <input type="text" name="titulo" id="titulo" class="inp4-form" />
                 <input type="hidden" name="idlibro" id="idlibro" />
                 </th>
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
 <form action="<?php config::ruta();?>?accion=reporteKardexMayor" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="codigo" name="codigo" value="<?php  echo $_POST["libro"];?>"/>
<input type="hidden" id="titulo_libro" name="titulo_libro" value="<?php  echo $_POST["titulo"];?>"/>

</form>
<?php }?>
</div>

  <h1>Kardex Mayor ><span style="color:#F30;"> <?php if(isset($_POST["consulta"])) echo $_POST["libro"]." - ".$_POST["titulo"];?></span> </h1>
  <hr />
</div>


<div id="table-content">

			
		
		 
				<?php if(isset($_POST["consulta"])){?>
                <div style="width:70%; margin:auto" >
				<table  width="100%"   id="kardexmayor-table"  border="1" cellpadding="0" cellspacing="0" >

				 
				      <thead style="background-color:#DAFAFC; font-size:9px;">
				        <tr>
				          <th width="17"  >N&deg;</th>
				          <th width="75" >FECHA</th>
				          <th width="200"  class="">PROCEDENCIA</th>
                          <th width="70"  class="">TIPO DOC</th>
				          <th width="55"  align="center" class="">NºDOC</th>
				           <th width="50" align="center">INGRESO</th>
				        <th width="57" align="center">SALIDA</th>
				        <th width="31" align="center">SALDO</th>
				          
				       
			          </tr>
                        <tr   style=" color:#039; font-size:14px; font-weight:bold;">
                      <td  ></td>
                      <td> </td>
                      <td>SALDO AL::<?php echo $fecha2;?></td>
                          <td></td>
                          <td align="right"></td>
                          <td></td>
                         
                          <td></td>
                           <td id="saldoAnterior" align="right"><?php echo $saldo;?> </td>
                          
                      </tr>
                      
                      <tr style=" color:#039; font-size:14px; font-weight:bold;">
                      <td  ></td>
                      <td></td>
                      <td></td>
                          <td></td>
                          <td align="right"></td>
                          <td></td>
                          <td align="right">&nbsp; </td>
                          <td></td>
                       
                      </tr>
                    
                      </thead>
				      <tbody id="kardex1">
				       
                      <?php 
					  //LISTA DE INGRESOS
					  $s1=0;
				
					  $cont=1; 
					  foreach($res1 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["envia"];?></td>
                        <td><?php echo "N.INGRESO"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verIngreso&id=<?php echo $v["idingreso"];?>');"><?php echo $v["idingreso"];?></a></td>
                          <td align="right"><?php echo $v["cantidad"];?></td>
                           <td align="right"><?php ?></td>
                            <td align="right"></td>
                             
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                      <?php // lista de EGRESOS 
					  foreach($res2 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["envia"];?></td>
                         <td><?php echo "N.EGRESO"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verEgreso&id=<?php echo $v["idegreso"];?>');"><?php echo $v["idegreso"];?></a></td>
                          <td align="right"><?php echo "";?></td>
                           <td align="right"><?php echo $v["cantidad"];?></td>
                            <td align="right"></td>
                          
                      
                      </tr>
                      
                      <?php $cont++;}?>
					  
					 <?php //LISTA DE REMISIONES
					 foreach($res3 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["nombre_vendedor"];?></td>
                         <td><?php echo "N.REMISION"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["idremision"];?>');"><?php echo $v["idremision"];?></a></td>
                          <td align="right"><?php echo "";?></td>
                           <td align="right"><?php echo $v["cantidad"];?></td>
                            <td align="right"></td>
                            
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                       <?php
					   //LISTA DE DEVOLUCIONES
					    foreach($res4 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["nombre_vendedor"];?></td>
                         <td><?php echo "N.DEVOLUCION"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["iddevolucion"];?>');"><?php echo $v["iddevolucion"];?></a></td>
                         <td align="right"><?php echo $v["cantidad"];?></td>
                            <td align="right"><?php echo "";?></td>
                            <td align="right"></td>
                           
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                      
                     
					 <!-- <tr>
                      
                      <td><?php//echo $cont;?></td>
                       <td><?php// echo $f2;?></td>
                        <td style=" color:#F00; font-weight:bold;">TOTAL DE VENTAS</td>
                         <td align="center"><?php ?></td>
                          <td align="right"><?php  ?></td>
                        <td style=" color:#F00; font-weight:bold;"><?php // echo $res5["suma"]; ?></td>
                            <td align="right"></td>
                             <td align="center"><?php ?></td>
                            
                      </tr>-->
                      
                    <?php //LISTA DE traspasos POR ENVIA
					 foreach($res6 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["nombre_envia"];?></td>
                         <td><?php echo "N.SALIDA-TRASPASO"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verTraspasoAlmacen&id=<?php echo $v["traspaso_almacen_idtraspaso_almacen"];?>');"><?php echo $v["traspaso_almacen_idtraspaso_almacen"];?></a></td>
                          <td align="right"><?php echo "";?></td>
                           <td align="right"><?php echo $v["cantidad"];?></td>
                            <td align="right"></td>
                            
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                      
                        <?php //LISTA DE traspasos POR recibe
					 foreach($res7 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["nombre_recibe"];?></td>
                         <td><?php echo "N.INGRESO-TRASPASO"?></td>
                         <td align="center"><a href="###" onclick="imprimir('<?php echo config::ruta();?>?accion=verTraspasoAlmacen&id=<?php echo $v["traspaso_almacen_idtraspaso_almacen"];?>');"><?php echo $v["traspaso_almacen_idtraspaso_almacen"];?></a></td>
                          <td align="right"><?php echo $v["cantidad"];?></td>
                           <td align="right"><?php ?></td>
                            <td align="right"></td>
                            
                      
                      </tr>
                      
                      <?php $cont++;}?>
				      
                      
                      <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      <td></td>
                       <td>totales</td>
                        <td></td>
                          <td></td>
                           <td>SALDO </td>
                         
                          
                         <td></td>
                          <TD ><?php echo date("d-M-Y",strtotime($f2));?></TD>
                          <td  id="saldoFinal" align="right"></td>
                      </tr>
			          </tbody>
				      <tfoot>
				     
				     
			          </tfoot>
			        </table>
                    
                    </div>
                  
				<?php }?>
				<!--  end product-table................................... --> 
				<!--  end content -->
<div class="clear">&nbsp;</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>

    
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