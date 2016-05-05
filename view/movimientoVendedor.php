 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script language="javascript">

	
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
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
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
$(document).ready(function() {
	 
	

	
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexmayor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	
	 
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
});

</script>


<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="" onsubmit="return validarForm();">
      <table>
         <tr>
           <td>
           
                <table width="75%">
                  <tr>
                   <th>
       <label>NOMBRE/CARNET VENDEDOR</label>
        <input type="text"  class="inp4-form" id="nombre_vendedor" name="nombre_vendedor" >
        <input type="hidden"  class="inp4-form" id="id_vendedor" name="id_vendedor" >

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
 <form action="<?php config::ruta();?>?accion=reporteMovimientoVendedor" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" name="vendedor" value="<?php  echo $ven->getNombresVendedor($_POST["id_vendedor"]);?>"/>
<input type="hidden"  name="f1" value="<?php  echo $f1;?>"/>
<input type="hidden"  name="f2" value="<?php  echo $f2;?>"/>


 </form>
<?php }?>
</div>

  <h1>ALMACEN > REPORTES > MOVIMENTO VENDEDOR ><span style="color:#F30;"> </span> </h1>
  <hr />
</div>

<div id="table-content">

			
		
		 
				<?php if(isset($_POST["consulta"])){?>
                <div style="width:70%; margin:auto" >
				<table  width="100%"   id="kardexmayor-table"  border="1" cellpadding="0" cellspacing="0" >

				 
				      <thead style="background-color:#DAFAFC; font-size:9px;">
				        <tr>
				          <th width="50"  >CODIGO</th>
				          <th width="250" >TITULO</th>
                          <th width="50"  class="">SALDO.<BR /> ANT.</th>
				          <th width="50"  class="">N.R.</th>
                          <th width="50"  class="">N.D.</th>
                           <th width="50"  class="">TRAS.</th>
				          <th width="50"  class="">VTA.OK.</th>
                          <th width="50"  class="">VTA.DIF.</th>
				        <th width="31" align="center">SALDO<BR /> ACT.</th>
				          
				       
			         <!-- </tr>
                       
                      
                      <tr style=" color:#039; font-size:14px; font-weight:bold;">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td ></td>
                      <td></td>
                      <td align="right">&nbsp; </td>
                      <td align="right">&nbsp; </td>
                      <td align="right">&nbsp; </td>
                       
                      </tr>-->
                    
                      </thead>
				      <tbody id="kardex1">
				       
                      <?php 
					  //LISTA DE INGRESOS
					  $s1=0;
				
					  $cont=1;
					  $sumremi=0;
					  $sumdevo=0;
					  $sumok=0;
					  $sumdif=0;
					  $sumtras=0; 
					  $sumactual=0;
					  $sumant=0;
					  foreach($listaLibros as $v){
						  $l=$libro->getCodigo($v["idlibro"]);
						  $saldo_ant=0;
						  $sc=$k->sumCargosPorItemMes($v["idlibro"],$_POST["id_vendedor"],"01-01-2013",$f1);
						  $sd=$k->sumDevoPorItemMes($v["idlibro"],$_POST["id_vendedor"],"01-01-2013",$f1);
						  $st=$k->sumTrasPorItemMes($v["idlibro"],$_POST["id_vendedor"],"01-01-2013",$f1);
						  $so=$k->sumOkPorItemMes($v["idlibro"],$_POST["id_vendedor"],"01-01-2013",$f1);
						  $sdi=$k->sumDifPorItemMes($v["idlibro"],$_POST["id_vendedor"],"01-01-2013",$f1);
						  $saldo_ant=($sc-$sd-$st-$so-$sdi);
						  
						  ?>
					  <tr>
                       <td><?php echo $l["codigo"];?></td>
                       <td><?php echo $l["titulo"];?></td>
                       <td><?php $sumant+=$saldo_ant; echo $saldo_ant;?></td>
                       <td><?php  $sc1=$k->sumCargosPorItemMes($v["idlibro"],$_POST["id_vendedor"],$f1,$f2); $sumremi+=$sc1;echo $sc1;?></td>
                       <td><?php $sd1=$k->sumDevoPorItemMes($v["idlibro"],$_POST["id_vendedor"],$f1,$f2); $sumdevo+=$sd1; echo $sd1; ?></td>
                       <td><?php $st1=$k->sumTrasPorItemMes($v["idlibro"],$_POST["id_vendedor"],$f1,$f2); $sumtras+=$st1;echo $st1;?></td>
                       <td><?php $so1=$k->sumOkPorItemMes($v["idlibro"],$_POST["id_vendedor"],$f1,$f2); $sumok+= $so1;echo $so1; ?></td>
                       <td><?php $sdi1=$k->sumDifPorItemMes($v["idlibro"],$_POST["id_vendedor"],$f1,$f2); $sumdif+=$sdi1; echo $sdi1; ?></td>
                       <td><?php $saldo_act=($sc1-$sd1-$st1-$so1-$sdi1);   $sumactual+=$saldo_act; echo $saldo_act;?></td>

                      
                      </tr>
                      
                      <?php $cont++;}?>
                      				      
			          </tbody>
				      <tfoot>
				     <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      <td></td>
                       <td></td>
                        <td><?php echo $sumant;?></td>
                          <td><?php echo $sumremi;?></td>
                           <td><?php echo $sumdevo;?> </td>
                         
                          
                         
                          <TD colspan="1"><?php echo $sumtras;?></TD>
                          <td  id="saldoFinal" align="right"><?php echo $sumok;?></td>
                          <td align="right"><?php echo $sumdif;?></td>
                          <td align="right"><?php echo $sumactual;?></td>
                      </tr>
				     
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