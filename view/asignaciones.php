 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 


<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
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
			
			$( "#nombre_cobrador" ).val( ui.item.label );
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
       <th>
       <h4><label for="nombre_vendedor">Nombre Cobrador o  Carnet</label></h4></p>
       <input type="text" name="nombre_cobrador"  class="inp-form" id="nombre_cobrador" />
       </th>
       <th>
        <h4 ><label for="ci_vendedor">Carnet</label></h4>
        <input type="text" name="ci_vendedor" id="ci_vendedor" class="inp-form" />
        
       <input type="hidden" name="id" id="id" /></th>



<th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1 ) {?> selected="selected"<?php }?>>ENERO</option>
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


 <TD><label>Fecha Referencial</label><input type="text" class="fechas" id="fecha"  name="atraso" value="<?php echo date("Y-m-d")?>"/> </TD>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"  value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteAsignaciones" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="cobrador" name="cobrador" value="<?php echo $_POST['nombre_cobrador'];?>" />
<input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha;?>" />
<input type="hidden"  name="asignaciones" value="asignaciones" />

</form>
</div>
  <h1>ASIGNACIONES COBRANZA ></h1>
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">

				<!--  start product-table ..................................................................................... -->
                
				<?php if(isset($_POST["consulta"])){?>
                
               <!-- <input  type="button" value="PASAR  CARGOS  AL SIGUIENTE MES" onclick="pasarCargos('<?php echo $mes;?>','<?php echo $anio; ?>','<?php echo $id;?>');" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/><input type="button" value="VER REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>-->
				<table width="1555"   border="1" cellpadding="0" cellspacing="0" id="categorias-table" style="background-color:#E0FFC1"  >
           
             
				
				<thead style="background-color:#BBE9FF; font-size:9px;">
				<tr>
				 <td colspan="18"></td>
				 <td><?php echo $_POST["atraso"];?></td>
				</tr>
				<tr>
				  <th >N&deg;</th>
				  <th>COD CLI</th>
                  <th  class="">COBRADOR</th>
				  <th  class="">VENDEDOR</th>
				  <th class="">NOMBRE CLIENTE</th>
				  <th align="center">FECHA<BR />VENTA</th>
				  <th class="" align="center">VALOR DE<BR />LA VENTA</th>
				  <th class="" align="center">SALDO<BR /><?php //echo $fecha2;?></th>
				  <th class="">DIA DE <br />COBRANZA</th>
				  <th  class="">F.U.P.</th>
				  <th class="">CUOTA <br />MENSUAL</th>
				  <th  class="">IMPORTE<br/> 
				    COBRANDO.</th>
				  <th  class="">FECHA<br />COBRANZA</th>
                   <th  class="">SALDO<br /><?php //echo $fecha1;?></th>
                    <th  class="">%</th>
                    <th  class="">OBSERV.</th>
                     <th  class="">N&deg;RECIBO</th>
                    <th  class="">N&deg;REPORTE</th>
                    <th  class="">DIAS <BR />ATRASO</th>
                  </tr>
				  </thead>
                  <tbody>
                 <?php $cont=1;
				       $valorVenta=0;
					   $saldoAnterior=0;
					   $cuotaMensual=0;
					   $cobrado=0;
					   $saldo=0;
					   $porcentaje=0;
				    	$cad;
				
				foreach($res as $v){
				
				$cad=explode("-",$v["fechadoc"]);
				$mes2;
				$anio2;
				if($mes==1){
				$mes2=12;
				$anio2=$anio-1;
				}
				else{
				$mes2=$mes-1;
				$anio2=$anio;
				}
		?>
                 <tr>
                 
                <td><?php echo $cont;?></td>
                 <td><?php echo $v["numcuenta"];?></td>
                 <td><?php echo $cobrador->getNombresCobrador($v["idcobrador"]);?></td>
                 <td><?php echo $ve->getNombresVendedor($v["idvendedor"]);?></td>
                 <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"];?></td>
                 <td><?php echo $v["fechadoc"];?></td>
                 <td><?php  $valorVenta+=$v["preciototal"]; echo  number_format($v["preciototal"], 2, ',', '.');?></td>
                 <td><?php $saldo_ant=$v["saldo"]-$p->sumPagosCreditoAcumulado($v["idcredito"],$mes2,$anio2); echo  number_format($saldo_ant, 2, ',', '.');?></td>
				 <td><?php $ref1=$ref->getReferenciaPorCredito($v["idcredito"]); echo $ref1["diacobrar"];?></td>			
                 <td><?php $up=$p->getListaUltimosPagos($v["idcredito"],$mes2,$anio2); echo $up["fecha"];  ?></td>
                 <td><?php echo  number_format($v["montocuotas"], 2, ',', '.'); ?></td>
                 <td><?php echo  number_format($up["monto"], 2, ',', '.');?></td>
                 <td><?php echo $up["fecha"]; ?></td>
                 <td><?php echo   number_format($saldo_ant-$up["monto"], 2, ',', '.');?></td>
                 <td><?php $por=0;
                     if($up["monto"]>=($v["montocuotas"]*0.75))
                     {
                     
                        if($up["monto"]<($v["montocuotas"]*0.5))
                        {
                     
                          if($up["monto"]=($v["montocuotas"]*0.5))
                          {
                     
                             if($up["monto"]<($v["montocuotas"]*0.75))
                             {
                                $por=0.5;
                            }
                            $por=0.5;
                        }
                        $por=0;
                    }
                    $por=1;
                }

                     echo $por;

                  ?></td>
                  <td><?php  ?></td>
                  <td><?php echo $up["numrecibo"]; ?></td>
                  <td><?php echo $up["num_reporte"]; ?></td>
                  <td><?php 
                        if(isset($up["fecha"]))
                  echo Helpers::dias_transcurridos($_POST["atraso"], $up["fecha"]); ?></td>
                             </tr>
									<?php  
									 
									
								   $cont++;}?>
								   
								
								  
                  
				
                </tbody>
                <tfoot>
                <tr style=" font-weight:bolder">
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>TOTALES.</td>
                <td>&nbsp;</td>
               <td><?php echo   $valorVenta;?></td>
               <td><?php echo    $saldoAnterior;?></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td><?php echo      $cuotaMensual;?></td>
                 <td><?php echo      $cobrado;?></td>
                <td>&nbsp;</td>
                <td><?php echo      $saldo;?></td>
                <td><?php echo      $porcentaje;?></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
           
                
                
                
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