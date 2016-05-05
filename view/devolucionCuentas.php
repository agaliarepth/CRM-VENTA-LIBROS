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
<th><label for="anio">Año</label><select name="anio" class="inp2-form">
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

<td><label>Cobradores</label>
<select class="inp-form" name="filtro">
<option value="todos">Todos </option>
<?php foreach($res2 as $r){?>
<option value="<?php echo $r['idcobradores'];?>"><?php echo $r['nombres']." ".$r['apellidos'];?></option>

<?php }?>

</select></td>

<td><label>FILTRO</label><select class="inp-form" name="tipoDevolucion">
<option value="DEVOLUCION TOTAL"> DEVOLUCION TOTALES </option>
<option value="DEVOLUCION PARCIAL">DEVOLUCION PARCIALES </option>




</select></td>

 <TD>&nbsp; </TD>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteCuentas&tipo=reporteDevolucion" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo" value="<?php  echo $_POST["tipoDevolucion"];?>"<?php ?> />
<input type="hidden" id="fecha" name="fecha" value="<?php  echo $_POST["mes"]."-".$_POST["anio"]; ?>"  />
</form>
</div>
  <h1>DEVOLUCIONES ><?php if(isset($_POST['consulta'])) echo $_POST["mes"]."-".$_POST["anio"];?> </h1>
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">

				
                
				<?php if(isset($_POST["consulta"])){?>
                
               <!-- <input  type="button" value="PASAR  CARGOS  AL SIGUIENTE MES" onclick="pasarCargos('<?php echo $mes;?>','<?php echo $anio; ?>','<?php echo $id;?>');" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/><input type="button" value="VER REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; marginleft:15px; font-size:16px; font-family:calibri; height:35px;"/>-->
				<table width="1555"   border="1" cellpadding="0" cellspacing="0" class="kardex" id="categorias-table"  style="" >
           
             
				
				<thead style="background-color:#BBE9FF; font-size:9px;">
				  
				  <th align="left">No</th>
				  <th>COD CL</th>
				  <th class="">FECHA DEVOL.</th>
				  <th align="center">COBRADOR</th>
				  <th class="" align="center">DETALLE</th>
				  <th class="" align="center">DOC NI</th>
				  <th class="">NOMBRE DEL CLIENTE</th>
				  <th  class="">VENDEDOR</th>
				  <th class="">FECHA DE VENTA</th>
				  <th  class="">PRECIO DE VENTA</th>
				  <th  class="">C.I. </th>
                   <th  class="">SALDO</th>
                    <th  class="">COND.</th>
                    <th  class="">PAGOS A CUENTA</th>
                     <th  class="">VALOR DE LA DEVOL.</th>
                    <th  class="">SALDO</th>
                   
                  
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
                 <td align="left"><?php echo $cont;?></td>
                 <td><?php echo $v['num_cuenta'];?></td>
                 <td><?php echo $v['fecha']; ?></td>
                 <td><?php echo $v['cobrador'];?></td>
                   <td><?php echo $v['tipo_devolucion']; ?></td>
                 <td><?php echo $v['idingreso']; ?></td>
                 <td><?php echo $v['cliente'];?></td>
                 <td><?php echo $v['vendedor'];?></td>
                 <td><?php
				 
				 $res3=$cred->getCuentasPorNumCuenta2($v['num_cuenta']);
				  echo $res3['fechadoc'];?></td>
                 
                
                 <td><?php $su1+=$res3['preciototal']; echo $res3['preciototal'];?></td>
                 <td><?php $su2+=$res3['cuotainicial'];echo $res3['cuotainicial']; ?></td>
                 <td><?php $su3+=$res3['saldo'];echo $res3['saldo']; ?></td>
                 <td><?php echo $res3['numcuotas']."*".$res3["montocuotas"];?></td>
                 <td>
                 <?php 

				  $t1=$pago->sumPagosCredito($res3["idcredito"]);
				  $su4+=$t1;
				 echo $t1+0; 

				 ?>

				 </td>

                 <td><?php 
				 if($_POST["tipoDevolucion"]=="DEVOLUCION PARCIAL"){
					 $t2=$v['pago_cuenta'];
				 echo $t2;
				 $su5+=$t2;
					 
					 }
					 else{
				 $t2=$v['saldo']-$t1;
				 echo $t2;
				 $su5+=$t2;
				 }	?></td>
                 <td><?php $su6+=$v['saldo']-$t1-$t2; echo $v['saldo']-$t1-$t2;  ?></td>
                
                                   
                             </tr>
                             <?php $cont++;}?>  
                  
				
                </tbody>
                <tfoot>
                <tr style=" font-weight:bold">
                 <td>TOTALES</td>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td><?php echo $su1;?></td>
               <td><?php echo $su2;?></td>
               <td><?php echo $su3;?></td>
               <td>&nbsp;</td>
               <td><?php echo $su4;?></td>
                <td><?php echo $su5;?></td>
                 <td><?php echo $su6;?></td>
                               
                
                
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