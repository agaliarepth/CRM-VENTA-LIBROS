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


 	
  });
 
	   
			
	  
	  
  </script> 
	



<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
 
  <h1>VENTAS > REPORTES > COMPORTAMIENTO VENTAS </h1>

  <hr />
  </div>



<div id="table-content">

             
                
               
               <form name="form"   method="post"  action="">
              
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

</th> <td>

            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="PRODUCCION MENSUAL" />  <input type="hidden" name="tipo" value="mensual"/>
                <input type="hidden" name="tipo" value="comportamiento"/>
                </td>
             
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
		 if(isset($_POST["tipo"])&& $_POST["tipo"]=="comportamiento"){?>
         
          <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteroduccionMensual" method="post" target="_blank" id="FormularioExportacion">
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