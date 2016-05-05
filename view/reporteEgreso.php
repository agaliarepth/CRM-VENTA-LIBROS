 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
		<script language="javascript">
$(document).ready(function() {
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
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=reporteEgreso">
      <table>
     
<tr>
<th colspan="2" > <label for="almacenes">LISTA DE ALMACENES</label>
       <select class="inp-form" name="almacenes">
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

  <td><label for="anio">Filtrar Por: </label><select  class="inp-form" name="destino">
        <option value="todos">Todos</option>
			  <option value="BAJA DE MERCADERIA">BAJA DE MERCADERIA</option>
               <option value="CAMBIO OBRA">CAMBIO OBRA</option>
                <option value="DEVOLUCION EN COMPRA">DEVOLUCION EN COMPRA</option>
                  <option value="DEVOLUCION CONTRATO">DEVOLUCION CONTRATO</option>
                 <option value="OBSEQUIO">OBSEQUIO</option>
                  <option value="NINGUNO">NINGUNO</option>
                   <option value="VENTA DE MERCADERIA">VENTA DE MERCADERIA</option>
                    <option value="TRASPASO SUCURSAL">TRASPASO SUCURSAL</option>
                     
			
		</select></td>
</th>
<th><label for="anio">Ordenado por </label><select name="orden" class="inp-form">
<option value="idegreso">Num Documento</option>
<option value="fecha">Fecha</option>
<option value="destino">Destino</option>
<option value="envia">Procedencia</option>
<option value="recibe">Procedencia</option>

<option value="codigo">Codigo </option>

</select>

</th>


        <td>&nbsp;</td>
                <td>
                <input type="hidden" name="consulta" value="reporteIngreso"/>
              
                
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteEgreso" method="post" target="_blank" id="FormularioExportacion">
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
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>"<?php }?> />
                <input type="hidden" name="almacen" value="<?php  echo $nom; ?>"/>
              
</form>
</div>
  <h1>Relacion Notas de Egreso
    <?php if(isset($_POST["nombre_vendedor"])) echo $_POST["nombre_vendedor"];?> </h1>
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
                
				<div>PAGINAS::
				<?php
				
				 if(isset($_POST["consulta"])){
					 
					 $contador=0;
					 $totalPag = ceil(count($cont)/5000);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
            $links[] = "<a style='font-size:18px' href=\"?accion=reporteEgreso&pag=$i&anio=".$_POST["anio"]."&mes=".$_POST["mes"]."&id=$cad[0]&orden=".$_POST["orden"]."&destino=".$_POST["destino"]."&nom=".$cad[1]."\">$i</a>"; 
         }
         echo implode(" - ", $links); 
				 
					 
					
					 ?>
                     </div>
                
                <table border="0"  cellpadding="0"  id="categorias-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#333; color:#FFF;">
				
					<th >Fecha </th>
                    <th >Procedencia</th>
                    <th >No Doc</th>
                   <th   class="">Ingreso</th>
				  <th   class="">Salida</th>
				  <th   class="">Saldo</th>
                    <th >Concepto</th>
                    <th >Observa<br />ciones</th>
                    <th >No Doc<br />ING</th>
                    <th>Codigo</th>
                     <th >Titulo</th>
                      <th >P.U</th>
                    <th >P.Total</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php 
				$cant=0;
				$total=0;
				foreach($res as $v){
					$cant=$cant+$v["cantidad"]; 
				?><tr>
									
					<td><?php echo $v["fecha"];?></td>
                    <td ><?php echo $v["envia"];?></td>
                    <td><?php echo $v["idegreso"]?></td>
                    <td>&nbsp;</td>
                    <td><?php echo $v["cantidad"];?></td>
                    <td>&nbsp;</td>
                    <td ><?php echo $v["destino"]?></td>
                     <td ></td>
                      <td ></td>
                   <td ><?php echo "'".$v["codigo"]."'"?></td>
                    <td  align="left";><?php echo $v["titulo"]?></td>
                    <td  align="right"><?php $v1=str_replace(".",",",$v["precio_unitario"]);echo $v1;?></td>
                    <td align="right"><?php $total+=$v["precio_total"]; $v2=str_replace(".",",",$v["precio_total"]);echo $v2;?></td>
                   
                    			
				</tr>
                
                <?php
				}
				?>
               
                </tbody>
                <tfoot>
                 <tr style=" font-weight:bold;">
                  <td>&nbsp;</td>
                  <td colspan="2" >Total</td>
                  <td>&nbsp;</td>
                  <td align="right";><?php echo $cant; ?></td>
                  <td>&nbsp;</td>
                  <td >&nbsp;</td>
                  <td ></td>
                  <td ></td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
               
                  <td><?php $v3=str_replace(".",",",$total);echo $v3; ?></td>
                </tr>
                
                </tfoot>
            
				</table>
				<?php }
				
				 else if(isset($_GET["pag"])){
						  $contador=($_GET["pag"]-1)*5000;
						  $totalPag = ceil(count($cont)/5000);
         $links = array();
         for( $i=1; $i<=$totalPag ; $i++)
         {
            $links[] = "<a style='font-size:18px' href=\"?accion=reporteEgreso&pag=$i&anio=".$_GET["anio"]."&mes=".$_GET["mes"]."&id=".$_GET["id"]."&orden=".$_GET["orden"]."&destino=".$_GET["destino"]."&nom=".$_GET["nom"]."\">$i</a>"; 
         }
		 
         echo implode(" - ", $links); 
						 
						 
				?>
			  </div>
                <table border="0"  cellpadding="0"  id="categorias-table" style="font-size:11px; margin:auto; background-color:#FFF; width:100%; ">
                <thead>
                <tr> <td>
				
        </td> </tr>
				<tr style="background-color:#333; color:#FFF;">
				  	<th >Fecha </th>
                    <th >Procedencia</th>
                    <th >No Doc</th>
                   <th   class="">Ingreso</th>
				  <th   class="">Salida</th>
				  <th   class="">Saldo</th>
                    <th >Concepto</th>
                    <th >Observa<br />ciones</th>
                    <th >No Doc<br />ING</th>
                    <th>Codigo</th>
                     <th >Titulo</th>
                      <th >P.U</th>
                    <th >P.Total</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$total=0; 
				foreach($res as $v){
				$contador++;?><tr>
                
				<td><?php echo $v["fecha"];?></td>
                    <td ><?php echo $v["envia"];?></td>
                    <td><?php echo $v["idegreso"]?></td>
                    <td>&nbsp;</td>
                    <td><?php echo $v["cantidad"];?></td>
                    <td>&nbsp;</td>
                    <td ><?php echo $v["destino"]?></td>
                     <td ></td>
                      <td ></td>
                   <td ><?php echo "'".$v["codigo"]."'"?></td>
                    <td  align="left";><?php echo $v["titulo"]?></td>
                    <td  align="right"><?php $v1=str_replace(".",",",$v["precio_unitario"]);echo $v1;?></td>
                    <td align="right"><?php $total+=$v["precio_total"]; $v2=str_replace(".",",",$v["precio_total"]);echo $v2;?></td>
                   
                   
                    			
				</tr><?php
				}
				?>
               
                </tbody>
                
         <tfoot>
                 <tr style=" font-weight:bold;">
                  <td>&nbsp;</td>
                  <td colspan="2" >Total</td>
                  <td>&nbsp;</td>
                  <td align="right";><?php echo $cant; ?></td>
                  <td>&nbsp;</td>
                  <td >&nbsp;</td>
                  <td ></td>
                  <td ></td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
                  <td >&nbsp;</td>
               
                  <td><?php $v3=str_replace(".",",",$total);echo $v3; ?></td>
                </tr>
                
                </tfoot>
				</table>
				<?php }?> 
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