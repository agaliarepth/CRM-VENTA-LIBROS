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
<option value="2014">2014</option>
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

<td><label>Cobradores</label><select class="inp-form" name="filtro">
<option value="todos">Todos </option>
<?php foreach($res2 as $r){?>
<option value="<?php echo $r['idcobradores'];?>"><?php echo $r['nombres']." ".$r['apellidos'];?></option>

<?php }?>

</select></td>


<td><label>ordenado Por</label><select class="inp-form" name="orden">
<option value="num_cuenta">Codigo Cliente </option>
<option value="nombre_cobrador">Nombre Cobrador </option>
<option value="nombre_cliente">Nombre Cliente </option>
<option value="nombre_vendedor">Nombre Vendedor </option>
<option value="fecha_contrato">Fecha Venta </option>
<option value="monto_total">Precio Venta</option>



</select></td>

 <TD>&nbsp; </TD>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteCuentas&tipo=reporteCuentasCanceladas" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="fecha" name="fecha" value="<?php echo $fecha;?>" />
</form>
</div>
  <h1>CUENTAS CANCELADAS ><?php if(isset($_POST['consulta'])) echo $mes."-".$anio;?> </h1>
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
				<table width="1555"   border="1" cellpadding="0" cellspacing="0" class="kardex" id="categorias-table"  style="background-color:#E0FFC1" >
           
             
				
				<thead style="background-color:#BBE9FF; font-size:9px;">
				  
				  <th align="left">No</th>
				  <th>CUENTA</th>
				  <th class="">VENDEDOR</th>
				  <th align="center">CLIENTE</th>
				  <th class="" align="center">FECHA</br>VENTA</th>
				  <th class="" align="center">PRECIO</br>VENTA</th>
				  <th class="">SALDO </th>
				  <th  class="">FECHA DE</br> COBRANZA</th>
				  <th class="">F.U.P</th>
				  <th  class="">CUOTA</br> A COBRAR</th>
				  <th  class="">MONTO</br>COBRADO </th>
                   <th  class="">FECHA  <br />DE PAGO</th>
                    <th  class="">SALDO <br />FINAL</th>
                    <th  class="">COBRADOR</th>
                   
                  
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
                 <td><?php echo $v['nombre_vendedor']; ?></td>
                 <td><?php echo $v['nombre_cliente'];?></td>
                 <td><?php echo $v['fecha_creacion']; ?></td>
                 <td><?php echo $v['monto_total'];?></td>
                
                 <td><?php $t1=$p->getCancelado($v['idcuentas']); echo $t1['monto'];?></td>
                 <td><?php echo $v['diacobranza']; ?></td>
                 <td><?php
				$t2=$p->getUltimoPago1($v['idcobrador'],$mes,$anio,$v['idcuentas']);
				 if(count($t2)==0 || !isset($t2[1]['fecha']))
				 echo $v['fecha_creacion'];
				 else
				   echo $t2[1]['fecha'];?></td>
                 <td><?php $su8+=$v['cuotamensual'];
				 echo $v['cuotamensual'];?></td>
                 <td><?php
				 $su9+=$t1['monto'];
				 echo $t1['monto']; ?></td>
                 <td><?php echo $t1['fecha'];	?></td>
                  
                   <td>0</td>
                 <td><?php echo $v['nombre_cobrador']; ?></td>
                
                                   
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
               <td><?php echo $su8;?></td>
               <td><?php echo $su9;?></td>
               <td>&nbsp;</td>
               <td><?php echo $su11;?></td>
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