 <?php require_once("head.php");?>

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#inventario-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});

$('#inventario-table').dataTable( {
		 
   
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
		"aaSorting": [ [0,'asc'] ],
        "bInfo": true,
        "bAutoWidth": true,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
});
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="miMenu" >
    <ul >
      
      
    </ul>
  </div>
 
  <h1>REGISTROS  >INVENTARIO</h1>
  
  <hr />
  </div>


 <div class="" style="border: solid 1px #999;">
        
<table>
       <form name="form"   method="post"  action="">
       
      <tr >
      <td>
       <th><label>ALMACENES:</label>
       
       <select  name="almacenes" class="inp-form">
         <option value="TODOS">TODOS</option>
        <?php 
		foreach($res3 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option>
			  <?php }?>
            
            </select>
              </td>
             
       
        <th> 
            <label for="mes">Mes</label>
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



</select>
              
              </th>
               <th> <label for="anio">Año</label>
<select name="anio" class="inp2-form">
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
        <input type="submit"   name="verStock" value="VerStock" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
        </td>

   </form>
   <td> IMPRIMIR<a href="javascript:imprSelec('seleccion');" ><img src="<?php config::ruta();?>images/iconos/impresora.png"  width="55" height="55"/></a></td>
   <td> <form action="<?php config::ruta();?>?accion=verReporteStock" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="almacen" name="almacen"    value="<?php echo $_POST["almacenes"];?>"/>

  
</form></td>
      </tr>
       
        
        </table>
      
       
        

  </div>

<div id="table-content">
		
				
               
            
              <?php 
			  
			  if(isset($_POST["verStock"])&& $_POST["verStock"]!="")
{?>
             
                <div style="width:100%;"> 
                <?php if($_POST["almacenes"]=="TODOS"){?>

                  <div id="seleccion">
                <h1 style="font-size:14">INVENTARIO  CONSOLIDADO DE TODOS LOS ALMACENES</h1>
                  
                  <table border="0"   style="font-size:10px;"  width="80%" cellpadding="0" id="inventario-table" cellspacing="0" >
                <thead>
				<tr >
					
					
                    <th  width="100" align="center">CODIGO</th>
                    <th  width="500"  align="center">TITULO</th>
                    <th  width="10"  align="center">VOL</th>
                    <th  width="50"  align="center">EDITORIAL</th>
                    
                    <th  width="50"  align="center">CIF</th>
                    <th class="" width="100">STOCK <?php echo $_POST["mes"]."-".$_POST["anio"] ?> </th>
                    <th width="50">TOTAL</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				$sum_cif=0; $sum_stock=0;
				foreach($res as $v){
					 $saldo_ante=0;
					 
			    $ingreso_ant=$detingreso->sumIngresoInventarioAntTodos($mes2 , $anio2,$v["idlibros"]);
				$egreso_ant=$detegreso->sumEgresoInventarioAntTodos($mes2 , $anio2,$v["idlibros"]);
				$remi_ant=$detremision->sumRemisionInventarioAntTodos($mes2 , $anio2,$v["idlibros"]);
				$dev_ant=$detdevolucion->sumDevolucionInventarioAntTodos($mes2 , $anio2,$v["idlibros"]);
				
                $saldo_ante=($ingreso_ant+$dev_ant)-($egreso_ant+$remi_ant);


				
				
				$ingreso_act=$detingreso->sumIngresoInventarioTodos($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				if($ingreso_act<=0)$ingreso_act=0;
				$dev_act=$detdevolucion->sumDevolucionInventarioTodos($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				if($dev_act<=0)$dev_act=0;
				$egreso_act=$detegreso->sumEgresoInventarioTodos($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				
				if($egreso_act<=0)$egreso_act=0;
				$remi_act=$detremision->sumRemisionInventarioTodos($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				
				if($remi_act<=0)$remi_act=0;
				$saldo_act=($saldo_ante+$ingreso_act+$dev_act)-($egreso_act+$remi_act);
					?>
                    <?php if($saldo_act>0){?>
               <tr>
                <td><?php echo $v["codigo"]?></td>
                <td><?php echo utf8_decode($v["titulo"]);?></td>
                <td align="center"><?php echo utf8_decode($v["tomo"]);?></td>
                <td><?php echo utf8_decode($v["nombre_editorial"]);?></td>
              
               
                 
                
              
               
                <TD><?php echo $v["precio_base"]; $sum_cif+=$v["precio_base"];?></TD>
                 <td align="center">
                 <?php  echo $saldo_act; $sum_stock+=$saldo_act;?>
                 
                 </td>
                 <TD><?php echo $v["precio_base"]*$saldo_act; ?></TD>
                 
				</tr>
                <?php }?>
				<?php }// fin FOREACH
				?>
             
               
                </tbody>
                <tfoot>
               <tr>
               <TD>&nbsp;</TD>
               <TD>&nbsp;</TD>
               <TD>&nbsp;</TD>
               <td>
               <strong>TOTALES</strong>
               </td>
               <TD><strong><?PHP echo $sum_cif;?></strong></TD>
               <TD><strong><?PHP echo $sum_stock;?></strong></TD>
               <TD><strong><?PHP echo $sum_cif*$sum_stock;?></strong></TD>
               </tr>
                
                </tfoot>
				</table>
               
				</div>
			<?php }
			else{?>
            
             
               <div id="seleccion">
				 <h1>INVENTARIO DE <?PHP echo $almacen; ?></h1>
				 <table border="0"    width="50%"cellpadding="0" cellspacing="0" id="inventario-table" >
                <thead>
				<tr >
					
					
                    <th  width="100" align="center">CODIGO</th>
                    <th  width="350"  align="center">TITULO</th>
                    <th  width="10"  align="center">VOL</th>
                    <th  width="50"  align="center">EDITORIAL</th>
                    <th  width="50"  align="center">CIF</th>
                       
                    
                     <th class="" width="100">SALDO AL <br /><?php echo "31-".$_POST["mes"]."-".$_POST["anio"] ?> </th><th  width="50"  align="center">TOTAL</th>
				</tr>
				</thead>
                <tbody>
                <?php 
								$sum_cif=0; $sum_stock=0;

				foreach($res as $v){
					 $saldo_ante=0;
					 
					?>
                     <?php
				$ingreso_ant=$detingreso->sumIngresoInventarioAnt($mes2 , $anio2,$v["idlibros"],$id);
				$egreso_ant=$detegreso->sumEgresoInventarioAnt($mes2 , $anio2,$v["idlibros"],$id);
				$remi_ant=$detremision->sumRemisionInventarioAnt($mes2 , $anio2,$v["idlibros"],$id);
				$dev_ant=$detdevolucion->sumDevolucionInventarioAnt($mes2 , $anio2,$v["idlibros"],$id);
				
                 $envia_ant=$traspaso->sumIngresoInventarioAntEnvia($mes2 , $anio2,$v["idlibros"],$id);
				 $recibe_ant=$traspaso->sumIngresoInventarioAntRecibe($mes2 , $anio2,$v["idlibros"],$id);

				
				$saldo_ante=($ingreso_ant+$dev_ant+$recibe_ant)-($egreso_ant+$remi_ant+$envia_ant);
				//echo $saldo_ante;
				 ?>
                
               
               
                <?php
				$ingreso_act=$detingreso->sumIngresoInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				if($ingreso_act<=0)$ingreso_act=0;
			
				
				//echo $ingreso_act;
				 ?>
                 
                
              
                <?php
				$dev_act=$detdevolucion->sumDevolucionInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				if($dev_act<=0)$dev_act=0;
			
				
				//echo $dev_act;
				 ?>
                 
                
                
                <?php
				$egreso_act=$detegreso->sumEgresoInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				
				if($egreso_act<=0)$egreso_act=0;
			
			//	echo $egreso_act;
				 ?>
                 
                
                
                <?php
				$remi_act=$detremision->sumRemisionInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				
				if($remi_act<=0)$remi_act=0;
			
			//	echo $remi_act;
				 ?>
                 
                
                
                <?php
				$recibe_act=$traspaso->sumIngresoInventarioRecibe($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				
				if($recibe_act<=0)$recibe_act=0;
			
				//echo $recibe_act;
				 ?>
                 
                
                
                <?php
				$envia_act=$traspaso->sumIngresoInventarioEnvia($_POST["mes"] , $_POST["anio"],$v["idlibros"],$id);
				
				if($envia_act<=0)$envia_act=0;
			
				$saldo_act=($saldo_ante+$ingreso_act+$dev_act+$recibe_act)-($egreso_act+$remi_act+$envia_act);
				 ?>
                 <?php if ($saldo_act>0){?>
               <tr>
                <td><?php echo $v["codigo"]?></td>
                <td><?php echo utf8_decode($v["titulo"]);?></td>
                <td align="center"><?php echo utf8_decode($v["tomo"]);?></td>
                <td><?php echo utf8_decode($v["nombre_editorial"]);?></td>
                <td><?php echo $v["precio_base"]; $sum_cif+=$v["precio_base"]?></td>
               
                 
                
               
               
                
                 <td>
                 <?php  echo $saldo_act; $sum_stock+=$saldo_act;?>
                 
                 </td>
                  <td><?php echo $v["precio_base"]*$saldo_act;?></td>
				</tr>
				<?php }
				}// fin FOREACH
				?>
             
               
                </tbody>
              <tfoot>
               <tr>
               <TD>&nbsp;</TD>
               <TD>&nbsp;</TD>
               <TD>&nbsp;</TD>
               <td>
               <strong>TOTALES</strong>
               </td>
               <TD><strong><?PHP echo $sum_cif;?></strong></TD>
               <TD><strong><?PHP echo $sum_stock;?></strong></TD>
               <TD><strong><?PHP echo $sum_cif*$sum_stock;?></strong></TD>
               </tr>
                
                </tfoot>
				</table>
				
				
				
				</div>
				<?php } //FIN DE ELSE?>
			
			
			
<?php }//FIN DE IF ?>
            
            </div>
          
        
            
            
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
