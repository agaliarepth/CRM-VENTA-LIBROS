 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/tinybox.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo config::ruta();?>js/query.tablesorter.js"></script>
		<script language="javascript">
$(document).ready(function() {
	

	
	
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append($("#relacionNotasDevolucion-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();});


	 $('#relacionNotasDevolucion-table').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#relacionNotasDevolucion-table body ');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = "";
            for (var i = 0; i < nTrs.length; i++) {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData[0];
                if (sGroup != sLastGroup) {
                    var nGroup = document.createElement('tr');
                    var nCell = document.createElement('td');
                    nCell.colSpan = iColspan;
                    nCell.className = "group";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild(nCell);
                    nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
                    sLastGroup = sGroup;
                }
            }
        },
		"fnFooterCallback": function (nRow, aasData, iStart, iEnd, aiDisplay) {

            var columnas = [3]; //the columns you wish to add            
            for (var j in columnas) {
                var columnaActual = columnas[j];
                var total = 0;
                for (var i = iStart; i < iEnd; i++) {
                    total = total + parseFloat(aasData[aiDisplay[i]][columnaActual]);
                }
                $($(nRow).children().get(columnaActual)).html(total.toFixed(0));
               
            } // end 

        }, // end footercallback
   
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
		"aaSorting": [ [2,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
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
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=relacionNotasDevolucion">
      <table>
     
<tr>
<th colspan="2" > <label for="almacenes">ALMACENEN:</label>
       <select class="inp-form" name="almacenes">
       <option value="TODOS">TODOS</option>
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"><?php echo $row["descripcion"];?></option><?php }?>
			
		</select>
       </th>
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




   <td>&nbsp;</td>
                <td>
                <input type="hidden" name="consulta" value="relacionNotasDevolucion"/>
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteRelacionNotasDevolucion" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="fecha" value="<?php if(isset($_POST["consulta"])||isset($_GET["pag"])){
	  
	  switch($mes){
		  case '1': $mes="Enero"; break;
		  case '2': $mes="Febrero"; break;
		  case '3': $mes="Marzo"; break;
		   case '4': $mes="Abril"; break;
		    case '5': $mes="Mayo"; break;
			 case '6': $mes="Junio"; break;
			  case '7': $mes="Julio"; break;
			   case '8': $mes="Agosto"; break;
			    case '9': $mes="Septiembre"; break;
				 case '10': $mes="Octubre"; break;
				  case '11': $mes="Noviembre"; break;
				   case '12': $mes="Diciembre"; break;
	  }
		
	   echo $mes." del ". $anio; ?>"<?php }?> />
                <input type="hidden" name="almacen" value="<?php  echo $nom; ?>"/>
</form>
</div>
  <h1>RELACION NOTAS DE DEVOLUCION
    </h1>
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
               
			
				<?php
				
				 if(isset($_POST["consulta"])){
					 
				
					 
					
					 ?>
                    
            
                <table border="0"  cellpadding="0"  id="relacionNotasDevolucion-table" style="font-size:11px; margin:auto; width:100%;">
                <thead>
                
				    <tr style="background-color:#333; color:#FFF;">
				   
					<th class="">FECHA</th>
                    <th class="">No DOC</th>
                    <th class="">CODIGO</th>
                     <th class="">CANT</th>
                    <th class="" align="left">TITULO</th>
                    <th class="">VOL</th>
                        <th>Tipo Devolucion</th>
                    <th class="">CHOFER/VENDEDOR</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$total=0;
				$total2=0; 
				$contador=0;
				foreach($res as $v){
				$contador++;?>
                <tr>
                 
								
					<td><?php echo $v["fecha"];?></td>
                    <td ><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["iddevolucion"];;?>','500');" rel="nofollow"><?php echo $v["iddevolucion"]; ?></a></td></td>
                    <td><?php echo $v["codigo"]?></td>
                    <td><?php  ;echo $v["cantidad"]?></td>
                    <td ><?php echo $v["titulo"]?></td>
                    <td  align="left"><?php echo $v["volumen"]?></td>
                    <td><?php echo $v["tipo"] ?></td>
                    <td align="right" ><?php $res2=$vendedor->getId($v["vendedores_idVendedores"]); echo $res2["nombres"]." ".$res2["apellidos"];?></td>
                  	
				</tr>
				<?php
				}
				?>
                
                </tbody>
                <tfoot>
                 <tr style="background-color:#333; color:#FFF">
                <td></td>
                 <td></td>
                  <td>TOTAL</td>
                   <td></td>
                    <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                </tr>
                
                
                </tfoot>
              
				</table>
				<?php }?>
			 
                
				
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