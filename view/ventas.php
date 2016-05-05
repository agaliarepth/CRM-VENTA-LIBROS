 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">

		
	
	
  $(document).ready(function($)
  {
	       $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#produccion-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
 	  $("#filtro").change(function(){

             if($(this).val()=="MES"){ $("#filtroAnio").css("display","inline-table");$("#filtroMes").css("display","inline-table");$("#filtroFechaAcumulado").css("display","none");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");}
             if($(this).val()=="RANGO"){$("#filtroAnio").css("display","none");$("#filtroFechaInicio").css("display","inline-table"); $("#filtroFechaAcumulado").css("display","none"); $("#filtroFechaFin").css("display","inline-table"); $("#filtroMes").css("display","none");}
             if($(this).val()=="ACUMULADO"){$("#filtroAnio").css("display","none");$("#filtroFechaAcumulado").css("display","inline-table");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");$("#filtroMes").css("display","none");}


             });
              $('#produccion-table').dataTable( {
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
        "bSort":false,
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"

    } );
  });
 
	   
			
	  
	  
  </script> 
	



<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
 
  <h1> VENTAS > REPORTE > PLANILLA DE PRODUCCION </h1>

  <hr />
  </div>



<div id="table-content">
<form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=ventas">
      
    <fieldset > 
    <table border="0">
<tr>
<th>
<label> TIPO DE FILTRO</label>
  <select name="filtro" id="filtro">
  <option value="MES">POR MES</option>
  <option value="RANGO">RANGO DE FECHAS</option>
  <option value="ACUMULADO">ACUMULADO </option>

</select>
</th>
<th id="filtroFechaInicio"  style="display:none">

 <label for="fechainicio">FECHA INICIO</label>
<input type="text" class="fechas" id="fecha" name="fechainicio" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroFechaFin" style="display:none" >
<label for="fechafin"  >FECHA FIN</label>
<input type="text" class="fechas" id="fecha2" name="fechafin" value="<?php echo date("Y-m-d")?>">
</th>


<th id="filtroFechaAcumulado"  style="display:none">

 <label for="fechaacumulado">TODOS HASTA:</label>
<input type="text" class="fechas" id="fecha3" name="fechaacumulado" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroMes"><label for="mes">MES</label>
<select name="mes" >
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
<th id="filtroAnio"><label for="anio">AÑO </label><select name="anio" class="inp2-form">
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
<th><label for="anio">Tipo de Contratos: </label><select name="tipo" class="inp-form">
<option value="DIFERIDO">VENTAS DE DIFERIDOS</option>
<option value="CREDITO">VENTAS DE CREDITO</option>
<option value="CONTADO">VENTAS DE CONTADO</option>
<option value="CONTCRED">VENTAS DE CONTADO/CREDITO</option>



</select>

</th>
<th><label for="anio">Filtro Cobrador </label><select name="cobrador" class="inp-form">
<option value="">---SELECCIONAR---</option>
<?php foreach($res3 as $c){?>
<option value="<?php echo $c["idcobradores"];?>"><?php echo $c["nombres"]." ".$c["apellidos"];?></option>
<?php }?>


</select>

</th>
<th><label for="anio">Filtro Vendedor</label><select name="vendedor" class="inp-form">
<option value="">---SELECCIONAR---</option>
<?php foreach($res4 as $v){?>
<option value="<?php echo $v["idVendedores"];?>"><?php echo $v["nombres"]." ".$v["apellidos"];?></option>
<?php }?>


</select>

</th>
<th><label for="anio">Ordenado por </label><select name="orden" class="inp-form">
<option value="numcontrato">Num Contrato</option>
<option value="numcuenta" selected="selected">Cod Cliente</option>



</select>

</th>





   <td>&nbsp;</td>
                <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
               </td>
          </tr>
         
              </table>
               </fieldset>
               
               </form>
               
               
               
      <!--<form  name="form"   method="post"  action="<?php echo config::ruta();?>?accion=ventas">
               
               <fieldset > 
    <table border="0">
<tr>

<th><label for="mes">Mes</label>
<select name="mes2" class="inp-form">
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
<th><label for="anio">Año</label><select name="anio2" class="inp2-form">
<option value="2013">2013</option>
<option value="2014" selected="selected">2014 </option>
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
<th><label for="anio">Tipo de Contratos: </label><select name="tipo2" class="inp-form">
<option value="DIFERIDO">DIFERIDOS</option>
<option value="VENTA">VENTAS</option>
<option value="Anulado">ANULADOS DIFERIDOS</option>


</select>

</th>

<th>
       <h4><label >Codigo o titulo</label></h4></p>
       <input type="text" name="libro"  class="inp2-form" id="libro" />
       </th>
       <th>
        <h4 ><label >Titulo Libro</label></h4>
        <input type="text" name="titulo" id="titulo" class="inp4-form" />
        
       <input type="hidden" name="idlibro" id="idlibro" /></th>





   <td>&nbsp;</td>
                <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta2" value="consulta2"/>
               </td>
          </tr>
         
              </table>
               </fieldset>
               
               </form>-->
               
               
               
              
      
 
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
 <form action="<?php config::ruta();?>?accion=verReporteContratos" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
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
                <input type="hidden" name="tipoContrato" value="<?php  echo $tipo; ?>"/>
</form>
</div>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" id="produccion-table" style="font-size:8px;">
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <td >N</td>
    <td width="40" >Fecha<br />CTTO</td>
    <td width="40"  >Fecha<br />CTTO<br />C.I.</td>
    <td>NombreVendedor</td>
    <td >NombreChofer</td>
    <td >Nombre Cliente</td>
    <td width="30" >Cod Cl.</td>
    <td >NºCTT</td>
    <td width="10">CANT</td>
    <td width="40">Cod <br />ITEM</td>
    <td width="250" >OBRA</td>
     <td width="25" >P.U.</td>
    <td align="center">Precio <br />Venta</td>
    <td ><p>Precio<br />Basico</p></td>
     <td ><p>Cuota I.</p></td>
    <td >Saldo</td>
    <td>Cuotas</br> Monto</td>
    <td>Cuotas </br>NºC</td>
     <td>% </br>Comision</td>
    <td>Monto</br> Comision</td>
      <td>Importe A</br> Cuenta</td>
    <td >NºREP</td>
      <td >NºRecibos</td>
    <td >Cobrador</td>
    <td >CCosto <br />Unitario</td>
   
   
 
  </tr>
  </thead>
  <tbody>
  <?php $cont=1;
    $scant=0;
		 $spv=0;
		 $scuota=0;
		 $ssaldo=0;
		 $smonto_cuotas=0;
		 $smonto_comision=0;
		 $svalorComisio=0;
		 $sporcentaje_comision=0;
     $scuentacomision=0;
		 $spu=0;
		 
		 
  if(isset($res)){
  foreach($res as $v){
	  $res2=$det->getDetalle($v["idcontratos"]);
	  ?>

    <?php $f=0; foreach($res2 as $r){?>
    <tr  <?php if($f<=0){?> style="background-color:#DFDFDF;"<?php }?>>
    <td><?php echo $cont;?></td>
        <td><?php echo $v["fechacontrato"]?></td>
        <td><?php echo $v["fechadoc"]?></td>
        <td><?php echo $ven->getNombresVendedor($v["idvendedor"]);?></td>
        <td><?php echo $ven->getNombresVendedor($v["idchofer"]);?></td>
        <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"];?></td>
        <td><?php echo $v["numcuenta"]?></td>
        <td><?php echo $v["numcontrato"]?></td>
    <td align="center"><?php  $scant++; echo $r["cantidad"]?></td>
    <td><?php echo "'".$r["codigo"]."'"?></td>
    <td><?php echo $r["titulo"]?></td>

    <td align="right"><?php  $spu=$spu+$r["precio_unitario"];  echo  number_format($r["precio_unitario"], 2, '.', ',')?></td>
        <?php if($f<=0){?>
            <td><?php $spv+=$v["preciototal"]; echo number_format($v["preciototal"], 2, '.', ',');?></td>
            <td><?php $svalorComisio+=$v["valorcomisionable"]; echo number_format($v["valorcomisionable"], 2, '.', ',');?></td>
            <td><?php $scuota+=$v["cuotainicial"]; echo  number_format($v["cuotainicial"], 2, '.', ','); ?></td>
            <td><?php  $ssaldo+=$v["saldo"]; echo number_format( $v["saldo"], 2, '.', ',');?></td>
            <td><?php  $smonto_cuotas+=$v["montocuotas"];echo  number_format($v["montocuotas"], 2, '.', ',');?></td>
            <td><?php echo $v["numcuotas"]?></td>
            <td><?php   $sporcentaje_comision+=$v["porcentajecomision"]; echo number_format($v["porcentajecomision"], 2, '.', ',');?></td>
            <td><?php $smonto_comision+=$v["montocomision"]; echo number_format($v["montocomision"], 2, '.', ',');?></td>
            <td><?php $scuentacomision+=$v["cuentacomision"]; echo number_format($v["cuentacomision"], 2, '.', ',');?></td>
            <td><?php echo $v["numreporte"]?></td>
            <td>
                <?php $listarecibo=$recibo->todosRecibosCredito($v["idcredito"]);?>
                <table border="0" cellpadding="0" cellspacing="0" style="font-size:8px">
                    <tr ><td>Num</td><td>Monto</td><td>Tipo</td></tr>
                     <?php foreach($listarecibo as $row){ ?>
                    <tr align="center" <?php if($row["tipopago"]=='PAGOTOTAL'){ ?> style="font-weight:bold " <?php }?>>
                        <td><?php echo $row["numero"]?></td>
                        <td><?php echo number_format($row["monto"], 2, '.', ',');?></td>
                        <td><?php if($row["tipo"]=="FACTURA") echo "F"; else echo "R";?></td>

                    </tr>
                    <?php  } ?>

                </table>


            </td>
            <td><?php echo $cobra->getNombresCobrador($v['idcobrador']);?></td>
   <td><?php  $prec=$libro->getPrecio($r["codigo"]); echo  number_format($prec["precio_base"], 2, '.', ',')?></td>
              <?php } else {?>

            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td><?php  $prec=$libro->getPrecio($r["codigo"]); echo  number_format($prec["precio_base"], 2, '.', ',')?></td>





        <?php } $f++;?>
   
    </tr>
    
    <?php }
	$cont++;
  }
				 ?>
                 </tbody>
                 <tfoot>
                 <tr style="font-size:9px; font-weight:bold; background-color:#E9E9E9">
      <td>&nbsp;</td>
      <td colspan="2"><B>TOTALES</B></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $scant; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td><?php echo   number_format($spu, 2, '.', ','); ?></td>
      <td><?php echo   number_format($spv, 2, '.', ','); ?></td>
            <td><?php echo   number_format($svalorComisio, 2, '.', ','); ?></td>

      <td><?php echo  number_format($scuota, 2, '.', ','); ?></td>
      <td> </td>
      <td><?php echo number_format( $smonto_cuotas, 2, '.', ','); ?></td>
      <td></td>
      <td><?php ?></td>
      <td><?php echo number_format($smonto_comision, 2, '.', ','); ?></td>
      <td></td>
      
      <td></td>
      <td></td>
      
    </tr>
    </tfoot>
    
</table>
<?php }
				 }
				 
				  if(isset($_POST["consulta2"])){?>
                  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteContratos" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="fecha" value="<?php if(isset($_POST["consulta2"])){
	  
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
                <input type="hidden" name="tipoContrato" value="<?php  echo $tipo; ?>"/>
</form>
</div>
		<table width="100%" border="1" id="categorias2-table" style="font-size:9px;background-color:#E0FFC1" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <td >N</td>
    <td >NombreVendedor</td>
    <td >NombreCobrador</td>
    <td >Nombre Cliente</td>
    <td >Cod Cl.</td>
    <td >NºCTT</td>
    <td>CANT</td>
    <td >Cod Item</td>
    <td >OBRA</td>
    <td >Precio Unitario</td>
     <td >Precio Total</td>
    
    </tr>
  </thead>
  <tbody>
  <?php $cont=1;
         $scant=0;
		 $s1=0;$s2=0;
		 
  if(isset($res)){
	   
  foreach($res as $v){
	  
	  ?>
  <tr >
    <td><?php echo $cont; ?></td>
    <td><?php echo $v["nombrevendedor"]?></td>
    <td><?php echo $v["nombrecobrador"]?></td>
    <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"];?></td>
    <td><?php echo $v["numcuentacontrato"]?></td>
    <td><?php echo $v["numcontrato"]?></td>
    <td><?php $scant+=$v["cantidad"];echo $v["cantidad"]?></td>
    <td><?php echo $v["codigo"]?></td>
    <td><?php echo $v["titulo"]?></td>
    <td><?php $s1+= $v["precio_unitario"];echo $v["precio_unitario"]?></td>
     <td><?php $s2+=$v["precio_unitario"]*$v["cantidad"];echo $v["precio_unitario"]*$v["cantidad"];?></td>
      </tr>
          <?php $cont++;}?> 
              </tbody>

          <tfoot>
          <tr style="font-size:12px; font-weight:bold; background-color:#E9E9E9">
      <td>&nbsp;</td>
      <td colspan="2"><B>TOTALES</B></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><?php echo $scant; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     
      <td><?php echo $s1; ?></td>
      <td><?php echo $s2; ?></td>
      <td></td>
    </tr>
    </tfoot>
</table>
	  <?php }
				  }
				 
				 ?>

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