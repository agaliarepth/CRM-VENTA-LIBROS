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
 
   
 
  <h1> VENTAS > REPORTES > RELACION OBRAS VENDIDAS</h1>

  <hr />
  </div>



<div id="table-content">
<form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=relacionObrasVendidas">
      
    <fieldset > 
    <table border="0">
<tr>

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

              <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
               </td>
          </tr>
         
          </table>
        </fieldset>
               
      </form>
               
               
               
      
               
               
               
              
      
 
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
				
				 if(isset($_POST["consulta"])){?>
                 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteObrasVendidas" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg"  class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="fecha" value="<?php if(isset($_POST["consulta"])){
	  
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
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>"<?php }?> />
               
</form>
</div>
		<table width="60%" border="1" id="categorias-table" style="font-size:9px;background-color:#E0FFC1" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
   <TD width="10%">COD ITEM</TD>
    <TD width="30%">TITULO</TD>
     <TD width="19%">CANTIDAD</TD>
      <TD width="15%">COSTO UNIT</TD>
       <TD width="26%">COSTO TOTAL</TD>
        
    </tr>
  
  </thead>
  <tbody>
  <?php $sum1=0;$sum2=0; foreach($res as $v){?>
  <tr>
 <td><?php echo $v["codigo"]?></td>
 <td><?php  $res2=$li->getCodigo($v["libros_idlibros"]); echo $res2["titulo"];?></td>
  <td><?php $cant=$det->sumarPorCodigoObrasVendidas($v["codigo"],$_POST["mes"], $_POST["anio"]); $sum1+=$cant;echo $cant;?></td>
  <td><?php $p=$li->getPrecio($v["codigo"]);echo $p["precio_base"]; ?></td>
  <td><?php $r=($cant*$p["precio_base"]); $sum2+=$r;echo ($r);?></td>
		</tr> 
   <?php }?>
      <tr style="font-size:12px; font-weight:bold; background-color:#E9E9E9">
       <td></td>
      <td ><B>TOTALES</B></td>
       <td><?php echo number_format($sum1,2,',','.');?></td>
      <td>&nbsp;</td>
      <td><?php echo number_format($sum2,2,',','.');?></td>
      
    </tr>
          </tbody>
                 <tfoot>
             
   
    </tfoot>
    
</table><?php }?>
		<div style="float:right;">
		  
</div>

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