<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script type="text/javascript">



			$(document).ready(function(){
                 $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
             $("#filtro").change(function(){

             if($(this).val()=="MES"){ $("#filtroAnio").css("display","inline-table");$("#filtroMes").css("display","inline-table");$("#filtroFechaAcumulado").css("display","none");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");}
             if($(this).val()=="RANGO"){$("#filtroAnio").css("display","none");$("#filtroFechaInicio").css("display","inline-table"); $("#filtroFechaAcumulado").css("display","none"); $("#filtroFechaFin").css("display","inline-table"); $("#filtroMes").css("display","none");}
             if($(this).val()=="ACUMULADO"){$("#filtroAnio").css("display","none");$("#filtroFechaAcumulado").css("display","inline-table");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");$("#filtroMes").css("display","none");}


             });

			});


function enviar(){

	window.open("<?php echo config::ruta();?>?accion=crearCuenta");

	}
</script>

<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">

<!-- <table><tr><td>
  <h1>Cuentas...</h1></td>
  <td>
    <input type="button"  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" value="Crear Nueva Cuenta" onclick="enviar();" /></td>
    </tr>
   <tr>
				  <td class="blue-left"  colspan="5"> <a href="<?php config::ruta();?>?accion=reporteCuentas&tipo=estadoCancelacion">CUENTAS CANCELADAS</a> </td>
                  <td class="blue-left"  colspan="5"> <a href="<?php config::ruta();?>?accion=reporteCuentas&tipo=cuentasNuevasCobradas">CUENTAS  COBRADAS</a> </td>
                  <td class="blue-left"  colspan="5"> <a href="<?php config::ruta();?>?accion=reporteCuentas&tipo=devoluciones">DEVOLUCIONES</a> </td>
                    <td class="blue-left"  colspan="5"> <a href="<?php config::ruta();?>?accion=cuentasNuevas">CUENTAS NUEVAS</a> </td>



				</tr>
    </table>!-->
  </div>
<form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  WIDTH="">
  <h1>Cobranzas  > Reportes > Relacion Cuentas Nuevas  </h1>
  </td>
  <th>

  <label for="filtro">FILTRO POR :</label>
  <select name="filtro" id="filtro" class="inp-form">
  <option value="MES">POR MES</option>
  <option value="RANGO">RANGO DE FECHAS</option>
  <option value="ACUMULADO">ACUMULADO </option>

</select>
</th>
<th id="filtroMes">
 <label for="mes">MES</label>

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
 <td>



                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
  </tr>
  </table>
  <input type="hidden"  name="consulta" value="consulta" />
  </form>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteRelacionCuentasNuevas" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="tipo" value="
  <?php
    if(isset($_POST["consulta"])){
        if($_POST["filtro"]=="MES") {
            echo $_POST["mes"]."-".$_POST["anio"];

        }
        if($_POST["filtro"]=="RANGO") {

            echo $_POST["fechainicio"]." - ".$_POST["fechafin"];

        }
        if($_POST["filtro"]=="ACUMULADO") {

            echo  "Hasta ".$_POST["fechaacumulado"];


        }
    }


    ?>

  " />

</form>
</div>

<div id="table-content">

				<!--  start message-yellow -->
				<div id="message-yellow">

				</div>

				<div id="message-blue">

				</div>

				<div id="message-green">

				</div>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>

					<th class="" >N Cuenta</th>
                    <th class="">Vendedor</th>
                    <th class="">Cliente</th>
                    <th class="">Fecha de <br>Venta</th>
                    <th class="">Precio de <br>Venta</th>
                    <!--<th class="">Saldo<br> Inicial</th>-->
                    <th class="">Saldo <br>Actual</th>
                    <th class="">Fecha de <br>Cobranza</th>
                    <th class="">F.U.P</th>
                    <th class="">Cuota a <br> Cobrar</th>
                    <th class="">Cobrador</th>


				</tr>
				</thead>
                <tbody>
                <?php

    foreach($res as $v){
        ?><tr  <?php if($v["estadocredito"]=="A"){?> style="background-color:#ED8FA9;"<?php }?>>


        <td style="font-weight: bold;"><?php echo $v["numcuenta"];?></td>
        <td><?php echo $ven->getNombresVendedor($v['idvendedor']);?></td>
        <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"] ;?></td>
        <td><?php echo $v["fechadoc"];?></td>
        <td><?php echo number_format($v["preciototal"], 2, '.', ',');?></td>
        <!--<td><?php //echo $v["saldo"];?></td>-->
        <td><?php $sumPagos=$p->sumPagosCredito($v["idcredito"]);
            echo number_format($v["saldo"]-$sumPagos, 2, '.', ',');?></td>
        <td><?php ?></td>
        <td><?php echo $v["fechadoc"];?></td>
        <td><?php echo number_format($v["montocuotas"], 2, '.', ',');?></td>
        <td><?php echo $cobra->getNombresCobrador($v["idcobrador"]);?></td>





        </tr><?php
    }
    ?>
                </tbody>
                <tfoot>

				</tfoot>
                <tbody>
				</table>
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