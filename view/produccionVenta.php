 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">

		
		
	
  $(document).ready(function($)
  {
	       $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});

 <?php if(isset($_POST["tipo"])&& $_POST["tipo"]=="mensual"){?>
 
  
	       $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#categorias2-table").eq(0).clone()).html());
     $("#FormularioExportacion2").submit();
});
 
 <?php }?>
 	
  });
 
	   
			
	  
	  
  </script> 
	



<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
 
  <h1>PRODUCCION VENTAS </h1>

  <hr />
  </div>



<div id="table-content">
<form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=produccionVentas">
      <fieldset>
   
    <table border="0">
    <tr>
  
    

<th>
<input type="text" class="fechas" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>"/>


</th>
  
                <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="PRODUCCION DIARIA" /></td>
                <td>
                <input type="hidden" name="tipo" value="diaria"/>
               </td>
                  
               
               </form>
             
                <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=produccionVentas">
              
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

</th> <td>

            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="COMPORTAMIENTO DE LAS VENTAS" />  <input type="hidden" name="tipo" value="comportamiento"/></td>
             
   </form>
               
               <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=produccionVentas">
              
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

</th> <td>

            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="PRODUCCION MENSUAL" />  <input type="hidden" name="tipo" value="mensual"/></td>
             
   </form>
          </tr>
       
        
              </table>
            
                 </fieldset>
               
               
    
               
               
               
              
      
 
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
		<?php
				
				 if(isset($_POST["tipo"])&& $_POST["tipo"]=="diaria"){?>
                 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteroduccionDiaria" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="fecha" value="<?php echo $_POST["fecha"]; ?>" />
              
</form>
</div>


		<table width="100%" border="1" id="categorias-table" style="font-size:9px;background-color:#E0FFC1" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <th >EJECUTIVOS DE VENTAS</th>
    <TH>FECHA</TH>
    <th >CANT</th>
    <th >PRECO VENTA</th>
    <th >PRECIO</BR>BASICO</th>
    <th >CUOTA I.</th>
    <th>%</th>
    <th >SALDO</th>
    <th >COMISION</th>
    <th >% COMISION</th>

    </tr>
  
  </thead>
  <tbody>
  <?php $s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;
		 
 
  foreach($res as $v){
	 
	  ?>
  <tr style="background-color:#DFDFDF;">
 
    <td><?php echo $v["nombrevendedor"]?></td>
     <td><?php echo $v["fecharecibo"]?></td>
    <td><?php $s1+=$v["cont"];echo $v["cont"]?></td>
    <td><?php $s2+=$v["ptotal"];echo $v["ptotal"];?></td>
    <td><?php $s3+=$v["comision"];echo $v["comision"]?></td>
    <td><?php $s4+=$v["cuota"];echo $v["cuota"]?></td>
    <td><?php  $p1=round(($v["cuota"]*100)/$v["ptotal"],2); echo $p1; $s5+=$p1; ?></td>
    <td><?php  $saldo=$v["ptotal"]-$v["cuota"]; echo $saldo; $s6+=$saldo;?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    </tr>
    
    
    <?php 
	}
	
  
				 ?>
                 </tbody>
                 <tfoot>
      <tr style="font-size:12px; font-weight:bold; background-color:#E9E9E9">
      <td ><B>TOTALES</B></td>
      <td><?php echo $s1; ?></td>
     
      <td><?php echo $s2; ?></td>
      <td><?php echo $s3; ?></td>
      <td><?php echo $s4; ?></td>
      <td><?php  echo $s5;?></td>
      <td><?php  echo $s6;?></td>
      <td><?php  ?></td>
      <td><?php   ?></td>
      </tr>
    </tfoot>
    
</table>
<?php }
		 if(isset($_POST["tipo"])&& $_POST["tipo"]=="comportamiento"){?>
         
          <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteroduccionMensual" method="post" target="_blank" id="FormularioExportacion2">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
 <input type="hidden" name="fecha" value="<?php 
	  
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
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>" />
              
</form>
</div>


		<table width="100%" border="1" id="categorias-table" style="font-size:9px;background-color:#E0FFC1; text-align:center;" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <td colspan="4" >CONTADO</td>
    <td colspan="4" >DOS PAGOS</td>
   <td colspan="4" >CUATRO PAGOS</td>
    <td colspan="4" >SEIS PAGOS</td>
    <td colspan="4" >OCHO PAGOS</td>
    <td colspan="4" >DIEZ PAGOS</td>
    <td colspan="2" >TOTAL</td>
    </tr>
    <tr>
     <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >%</td>
    <td >CTAS</td>
    <td >%</td>
       <td >Bs</td>
     <td >CTAS</td>
    
    </tr>
   

    
  
  </thead>
  <tbody>
  <tr>
  <?php $total=$res1["total"]+$res2["total"]+$res3["total"]+$res4["total"]+$res5["total"]+$res6["total"];
        $totalCuentas=$res1["cuentas"]+$res2["cuentas"]+$res3["cuentas"]+$res4["cuentas"]+$res5["cuentas"]+$res6["cuentas"];
           ?>
     <td ><?php echo $res1["total"];?></td>
     <td ><?php echo round(($res1["total"]*100)/$total,2);?></td>
    <td ><?php echo $res1["cuentas"];?></td>
    <td ><?php echo round(($res1["cuentas"]*100)/$totalCuentas,2);?></td>
    
      <td ><?php echo $res2["total"];?></td>
     <td ><?php echo round(($res2["total"]*100)/$total,2);?></td>
    <td ><?php echo $res2["cuentas"];?></td>
    <td ><?php echo round(($res2["cuentas"]*100)/$totalCuentas,2);?></td>
    
    <td ><?php echo $res3["total"];?></td>
     <td ><?php echo round(($res3["total"]*100)/$total,2);?></td>
    <td ><?php echo $res3["cuentas"];?></td>
    <td ><?php echo round(($res3["cuentas"]*100)/$totalCuentas,2);?></td>
    
    <td ><?php echo $res4["total"];?></td>
     <td ><?php echo round(($res4["total"]*100)/$total,2);?></td>
    <td ><?php echo $res4["cuentas"];?></td>
    <td ><?php echo round(($res4["cuentas"]*100)/$totalCuentas,2);?></td>
    
    <td ><?php echo $res5["total"];?></td>
     <td ><?php echo round(($res5["total"]*100)/$total,2);?></td>
    <td ><?php echo $res5["cuentas"];?></td>
    <td ><?php echo round(($res5["cuentas"]*100)/$totalCuentas,2);?></td>
    
    <td ><?php echo $res6["total"];?></td>
     <td ><?php echo round(($res6["total"]*100)/$total,2);?></td>
    <td ><?php echo $res6["cuentas"];?></td>
    <td ><?php echo round(($res6["cuentas"]*100)/$totalCuentas,2);?></td>
    
    
       <td ><?php echo $total;?></td>
     <td ><?php echo $totalCuentas;?></td>
    
    </tr>
  
                 </tbody>
                                 
    
</table>
         
				<?php } ?>
                
                 <?php if(isset($_POST["tipo"])&& $_POST["tipo"]=="mensual"){?>
         
          <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteroduccionMensual" method="post" target="_blank" id="FormularioExportacion2">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
 <input type="hidden" name="fecha" value="<?php 
	  
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
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>" />
              
</form>
</div>


		<table width="100%" border="1" id="categorias2-table" style="font-size:9px;background-color:#E0FFC1" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <td >NOMBRE CLIENTE</td>
    <td >Cod</br>CL.</td>
    <td >N.</br>CTT.</td>
    <td >CANT</td>
    <td >Cod.</br>Item</td>
    <td>OBRA</td>
    <td >Precio de</br>Venta</td>
    <td >Precio </br>Basico</td>
    <td >Cuota I.</td>
    <td >% C.I.</td>
    <td >SALDO</td>
    <td >N.</BR>C.</td>
    <td >TOTAL</BR>COMISION</td>
    <th>%COM</th>

    </tr>
  
  </thead>
  <tbody>
  <?php $s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;
		 
 
  foreach($res as $r){
	 $res2=$c->produccionMensual($r["idvendedor"]);
	 foreach($res2 as $v){
	  ?>
  <tr style="background-color:#DFDFDF;">
 
    <td><?php echo $v["nombres"]." ". $v["apellidopaterno"]." ".$v["apellidomaterno"];?></td>
    <td><?php echo $v["numcuentacontrato"]?></td>
    <td><?php echo $v["numcontrato"];?></td>
    <?php $res3=$det->getItemProduccion ($v["idcontrato"]);?>
    <td><?php $s1+=$res3["cantidad"];echo $res3["cantidad"];?></td>
    <td><?php echo $res3["codigo"];?></td>
    <td><?php echo $res3["titulo"]; ?></td>
    <td><?php  $s2+=$v["preciototal"]; echo $v["preciototal"];?></td>
    <td><?php $s3+=$v["valorcomisionable"]; echo $v["valorcomisionable"]; ?></td>
    <td><?php $s4+=$v["cuotainicial"]; echo $v["cuotainicial"];?></td>
     <td><?php $p1=round(($v["cuotainicial"]*100)/$v["preciototal"],2); echo $p1; $s5+=$p1;?></td>
      <td><?php $saldo=$v["preciototal"]-$v["cuotainicial"]; echo $saldo; $s6+=$saldo;?></td>
      <td><?php ?></td>
     <td><?php $s7+=$v["montocomision"]; echo $v["montocomision"]; ?></td>
     <td><?php $s8+=$v["porcentajecomision"]; echo $v["porcentajecomision"]; ?></td>
    </tr>
      <?php } ?>
    <tr style="font-weight:bold;">
    <td></td>
    
    <td></td>
     <td ><?php echo $v["nombrevendedor"];?></td>
   
    <td><?php echo $s1;?></td>
    <td></td>
     <td></td>
    <td><?php echo $s2;?></td>
    <td><?php echo $s3;?></td>
     <td><?php echo $s4;?></td>
     <td><?php echo $s5;?></td>
     <td><?php echo $s6;?></td>
     <td></td>
    <td><?php echo $s7;?></td>
     <td><?php echo $s8;?></td>
    
    
    </tr>
    
    <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    
    </tr>
    
    <?php  $s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;$s8=0;
	} ?>
                 </tbody>
                                 
    
</table>
         
				<?php } ?>

				<!--  start product-table ..................................................................................... -->
                
				
				
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