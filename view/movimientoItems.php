 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script language="javascript">


$(document).ready(function() {
	 
	

 
	
		  
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

  <h1>ALMACEN > REPORTES > MOVIMENTO ITEMS ><span style="color:#F30;"> </span> </h1>
<br />
  <hr />
</div>
<div class="clear">&nbsp;</div>


<div id="table-content">

			
		
		 
				<?php if(isset($_POST["consulta"])){?>
                <div style="width:70%; margin:auto" >
				<table  width="100%"   id="kardexmayor-table"  border="1" cellpadding="0" cellspacing="0" >

				 
				      <thead style="background-color:#DAFAFC; font-size:9px;">
				        <tr>
				          <th width="50"  >Codigo</th>
				          <th width="250" >TITULO</th>
                            <th width="50" >Saldo <br>Anterior</th>
                          <th width="50"  class="">N.I.</th>
                          <th width="50"  class="">N.E.</th>
				          <th width="50"  class="">N.R.</th>
                          <th width="50"  class="">N.D.</th>
				          <th width="50"  class="">VTA.</th>
                          <th width="50"  class="">DIF</th>
				           <th width="31" align="center">SALDO</th>
				          
				       
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
                          <td></td>
                          <td></td>
                       
                      </tr>
                    
                      </thead>
				      <tbody id="kardex1">
				       
                      <?php 
					  //LISTA DE INGRESOS
					  $s1=0;
				
					  $cont=1; 
					  foreach($listaLibros as $v){
                          $saldo_ant=0;

                          $si=$det1->sumIngreso($fecha2,$v["idlibros"]);
                          $se=$det2->sumEgreso($fecha2,$v["idlibros"]);
                          $sr=$remi->sumRemisiones($fecha2,$v["idlibros"]);
                          $sd=$devo->sumDevolucion($fecha2,$v["idlibros"]);
                          $sc=$det->sumContratosKardexMayor($fecha2,$v["idlibros"]);
                          $t_envia=$traspaso->sumTraspasoEnvia($fecha2,$v["idlibros"],5);
                          $t_recibe=$traspaso->sumTraspasoRecibe($fecha2,$v["idlibros"],5);


                          //$saldo_ant=($si["suma"]+$t_recibe["suma"]-$se["suma"]-$sr["suma"]+$sd["suma"])+($sr["suma"]-$sd["suma"]-$t_envia["suma"]-);


                          $ingreso=$det1->sumIngresoRangoFechas($f1,$f2,$v["idlibros"]);
                          $egreso=$det2->sumIngresoRangoFechas($f1,$f2,$v["idlibros"]);
                          $remision=$remi->sumIngresoRangoFechas($f1,$f2,$v["idlibros"]);
                          $devolucion=$devo->sumIngresoRangoFechas($f1,$f2,$v["idlibros"]);
                          $contratosVenta=$det->sumRangoFechas($f1,$f2,$v["idlibros"],"VENTA");
                          $contratosDif=$det->sumRangoFechas($f1,$f2,$v["idlibros"],"DIFERIDO");

                          //$res5=$det->getMesSumado($_POST["idlibro"],$f1,$f2);
                          $traspasoEnvia=$traspaso->getMesEnvia($v["idlibros"],$f1,$f2,5);
                          $traspasoRecibe=$traspaso->getMesRecibe($v["idlibros"],$f1,$f2,5);





                          ?>





					  <tr>
                      
                      <td><?php echo $v["codigo"];?></td>
                       <td><?php echo $v["titulo"];?></td>
                       <td><?php echo $saldo_ant;?></td>
                       <td><?php echo $ingreso; ?></td>
                       <td><?php echo $egreso; ?></td>
                       <td><?php echo $remision; ?></td>
                       <td><?php echo $devolucion; ?></td>
                       <td><?php echo $contratosVenta;   ?></td>
                       <td><?php echo  $contratosDif;  ?></td>
                       <td><?php  ?></td>
                        
                             
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                     
                      
                      
                 
                      
                   
                      
                     
				      
			          </tbody>
				      <tfoot>
				     <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      <td></td>
                       <td></td>
                        <td></td>
                          <td></td>
                           <td>SALDO </td>
                         
                          
                         
                          <TD colspan="2"><?php echo date("d-M-Y",strtotime($f2));?></TD>
                          <td  id="saldoFinal" align="right"></td>
                         <td></td>
                         <td></td>
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