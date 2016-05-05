<!doctype html>


<html>
<head>
    <meta charset="utf-8">
    <title>RESUMEN CARGOS</title>
    <script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

    <script language="javascript">
        $(document).ready(function() {
            $(".botonExcel").click(function(event) {
                $("#datos_a_enviar").val( $("<div>").append( $("#cargos-table").eq(0).clone()).html());
                $("#FormularioExportacion").submit();
            });
        });
    </script>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td> IMPRIMIR<a href="javascript:imprSelec('seleccion')" ><img src="<?php config::ruta();?>images/iconos/impresora.png"  width="55" height="55"/></a></td>
        <TD><form action="<?php config::ruta();?>?accion=verCargoVendedores" method="post" target="_blank" id="FormularioExportacion">
                <p>EXPORTAR  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
                <input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
                <input type="hidden" id="almacen" name="almacen"    value="<?php echo $_POST["almacenes"];?>"/>

            </form></TD>
    </tr>
</table>
<form method="post" action="<?php echo config::ruta();?>?accion=verResumenCargosMes">
    <table style="background-color:#E6E6E6;width:100% ">
        <tr>
            <td  width="90%">

            </td>
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
        </tr>
    </table>
    <input type="hidden"  name="cargos" value="cargos" />
    <input type="hidden"  name="id" value="<?php echo $_GET["iv"]?>" />
</form>
<div id="seleccion">
    <h6> CARGOS DE <?php echo $nombres;?>  MES DE <?php echo $mes ?> - <?php echo $anio ?></h6>
    <table width="553" border="1" style=" font-size:12px; font-family:Calibri;" cellpadding="0" cellspacing="0" id="cargos-table">

        <tr style=" background-color:#333; color:#FFF;">
            <td width="45"><b>Codigo</b></td>
            <td width="395" align="center">Titulo</td>
            <td width="33">Tomo</td>
            <td width="52">Cantidad Remitido</td>
        </tr>
        <?php  $cont=0;foreach($res as $v1){ ?>


            <tr>
                <td><b><?php echo $v1["cod_libro"];?></b></td>
                <td><?php echo $v1["titulo_libro"];?></td>
                <td><?php echo $v1["tomo_libro"];?></td>
                <td><b><?php $cont+=$v1["cant"]; echo $v1["cant"];?></b></td>

            </tr>
        <?php
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td><b><?php echo $cont;?></b></td>
        </tr>
    </table>
</div>

</body>
</html>