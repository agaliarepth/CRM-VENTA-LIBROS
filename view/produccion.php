 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 


<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categoria-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>

<script type="text/javascript">

		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre_cobrador").autocomplete({
				source: "ajax/searchCobradores.php", 				/* este es el formulario que realiza la busqueda */
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
			$( "#id" ).val( ui.item.idcobradores );
			
		
			
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
<th><label for="anio">Año</label><select name="anio" class="inp2-form">
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
<td><label>ordenado Por</label><select class="inp-form" name="orden">
<option value="nombres">Nombre Cobrador </option>


</select></td>

 <TD><label>Fecha Referencial</label><input type="text" class="fechas" id="fecha"  name="atraso" value="<?php echo date("Y-m-d")?>"/> </TD>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteProduccion" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha;?>" />
</form>
</div>
  <h1>CUADRO DE PRODUCCION ></h1>
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
                
               <!-- <input  type="button" value="PASAR  CARGOS  AL SIGUIENTE MES" onclick="pasarCargos('<?php echo $mes;?>','<?php echo $anio; ?>','<?php echo $id;?>');" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/><input type="button" value="VER REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; marginleft:15px; font-size:16px; font-family:calibri; height:35px;"/>-->
				<table width="1555"   border="1" cellpadding="0" cellspacing="0" class="kardex" id="categoria-table"  style="background-color:#E0FFC1" >
           
             
				
				<thead style="background-color:#BBE9FF; font-size:9px;">
				  
				  <th align="left">COBRADOR</th>
				  <th>DEBITO</Br> TOTAL</th>
				  <th class="">Bs Por<BR />Cobrar</th>
				  <th align="center">Bs<BR />Cobrados</th>
				  <th class="" align="center">%</th>
				  <th class="" align="center">Num De</br> Cuentas X <BR />Cobrar</th>
				  <th class="">Num De</br> Cuentas X <BR />Cobradas</th>
				  <th  class="">%</th>
				  <th class="">&nbsp;</th>
				  <th  class="">POSIBLE </br> COBRANZA</br>  91%</th>
				  <th  class="">Bs.<br /> COBRADOS</th>
                   <th  class="">Bs. QUE LE <br />FALTAN<br /> POR COBRAR</th>
                    <th  class="">Bs. POR <br />COBRAR POR DIA<br /> 91%</th>
                    <th  class="">%</th>
                     <th  class="">Nro. DE <br /> CUENTAS <br />91%</th>
                    <th  class="">CUENTAS <br />COBRADAS</th>
                    <th  class="">CUENTAS <br />QUE LE <br />FALTAN POR<br /> COBRAR  91%</th>
                     <th  class="">CUENTAS<br /> POR DIA <br />90%</th>
                    <th  class="">CTAS Q'<br /> FALTAN PARA <br />OBJETIVO 90%</th>
                  
				  </thead>
                  <tbody>
                 <?php $cont=1;
				       $su1=0;
					   $su2=0;
					   $su3=0;
					   $su4=0;
					   $su5=0;
					   $su6=0;
					   $su7=0;
					   $su8=0;
					   $su9=0;
					   $su10=0;
					   $su11=0;
					   $su12=0;
					   $su13=0;
					   $su14=0;
					   $su15=0;
					   
				 foreach($res as $v){?>
                 <tr style="text-align:center">
                 <td align="left"><?php echo $v["nombres"]." ". $v["apellidos"];?></td>
                 <td><?php 
				 $sa=0;
				  $res=$cu->cuentasPorCobrador($v["idcobradores"],$mes,$anio);
                  foreach($res as $v1){
					   $res3=$pa->reportePorMesTodos($v["idcobradores"],$mes-1,$anio,$v1["idcuentas"]);
				if( $res3["saldo"]==""){
					$res4=$pa->getUltimoPago1($v["idcobradores"],$mes,$anio,$v1["idcuentas"],$fecha);
						if(count($res4)>0)
							
							 $sa+=$res4[0]["saldo"];
						
						else
						
						$sa+=$v1["saldo"];
						
					  }
					  else{
					
					$sa+=$res3["saldo"];
					}
				  }
				            $p1=$pa->montoTotal($mes,$anio,$v["idcobradores"],$fecha);
							
				 $t1=$sa;
				 $su1+=$t1;
				 echo  ($t1); ?></td>
                 <td><?php
				 $s2=0;
				  $res=$cu->cuentasPorCobrador($v["idcobradores"],$mes,$anio);
                  foreach($res as $v1){
		 
				  $s2+=$v1["cuotamensual"];
				  }
				
				  echo  ($s2);
				 $su2+=$s2;
				  ?></td>
                 <td><?php 
				  $s3=0;
				  $res=$cu->cuentasPorCobrador($v["idcobradores"],$mes,$anio);
                  foreach($res as $v1){
		 
				 
				 $ico=$pa->reportePorMesTodos($v1["idcobrador"],$mes,$anio,$v1["idcuentas"]);
					if( $ico["monto"]=="")
							
					$s3+=0;
					else
					 $s3+=$ico["monto"];
					
				  }
				
				  echo  ($s3);
				  $su3+=$s3;
				 ?></td>
                 <td><?php 
				 if($s2==0)
				 $por1=0;
				 else
				 $por1=round(($s3*100)/$s2,2);
				 echo $por1;
				 $su4+=$por1;
				 ?></td>
                 <td><?php 
				 
				  $cc=0;
				    $res=$cu->cuentasPorCobrador($v["idcobradores"],$mes,$anio);
                  foreach($res as $v1){
					  $cc++;
					  
					  }
					  echo $cc;
					  $su5+=$cc;
				  ?></td>
                 <td><?php  
					 $por2=0;
				    $res=$cu->cuentasPorCobrador($v["idcobradores"],$mes,$anio);
                  foreach($res as $v1){
					  $co=0;
					  $cuota=0;
				 $ico=$pa->reportePorMesTodos($v["idcobradores"],$mes,$anio,$v1["idcuentas"]);
					if( $ico["monto"]=="")
					$co=0;
				else
					$co=$ico["monto"];
					 $cuota=$v1["cuotamensual"];
					 
					 if($co>=$cuota*0.75){
					     $por2+=1;
						
						 
						 
					if($co<$cuota*0.50){
						 $por2+=0;
					     
					}
				if($co==$cuota*0.50){
				     	 $por2+=0.5;
						
						
						}
					if($co<$cuota*0.75){
					      $por2+=0.5;
						
						 
						 }
					}
					else
					$por2+=0;
					  
					  }
					  echo $por2;
					  $su6+=$por2;
					?></td>
                 <td><?php 
				 if($cc==0)
				 $t4=0; 
				 else
				 				 $t4=round(($por2*100)/$cc,2);echo $t4; 
				$su7+=$t4;				 
								  ?></td>
                 <td><?php ?></td>
                 <td><?php
				  echo round($s2*0.91,2); 
				  $su8+=round($s2*0.91,2); 
				 ?>
                 
                 </td>
                 <td><?php		echo $s3;
				 $su9+=	$s3;		
				  ?></td>
                  
                   <td><?php $bqc=round($s2*0.91,2)-$s3;
				   echo $bqc; $su10+=$bqc;?></td>
                 <td><?php
				 $dias=Helpers::dias_transcurridos($_POST["atraso"],date("Y-m-d"));
				 if($dias==0)
				 $m=0;
				 else
				 $m=round($bqc/$dias,2);
				 echo $m;
				 $su11+=$m;
				  ?></td>
                
                 <td><?php 
				 ?>
                 </td>
                  <td><?php
				  $t5=round($cc*0.91,2);
				   echo $t5; 
				   $su12+=$t5; ?>
                 </td>
                 <td><?php echo $por2; $su13+=$por2; ?></td>
                 <td><?php echo $t5-$por2; $su14+=$t5-$por2;?></td>
                    <td><?php
					 if($dias==0)
					 echo"0";
					 else{
					
					 echo round($t5/$dias,2); $su15+=round($t5/$dias,2); }?></td>
                     <td><?php  ?></td>
                             </tr>
                             <?php }?>  
                  
				
                </tbody>
                <tfoot>
                <tr style=" font-weight:bold">
                 <td>TOTALES</td>
                <td><?php echo $su1;?></td>
                <td><?php echo $su2;?></td>
                <td><?php echo $su3;?></td>
                <td><?php echo $su4;?></td>
                <td><?php echo $su5;?></td>
               <td><?php echo $su6;?></td>
               <td><?php echo $su7;?></td>
               <td><?php ?></td>
               <td><?php echo $su8;?></td>
               <td><?php echo $su9;?></td>
               <td><?php echo $su10;?></td>
               <td><?php echo $su11;?></td>
               <td><?php ?></td>
               <td><?php echo $su12;?></td>
               <td><?php echo $su13;?></td>
               
               <td><?php echo $su14;?></td>
               <td><?php echo $su15;?></td>
               <td><?php ?></td>
                
                
                
                </tr>
                
              </tfoot>
                 
                 
                  
                
				</table><?php }?>
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