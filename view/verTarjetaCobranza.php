 <style type="text/css">
/*
	Web20 Table Style
	written by Netway Media, http://www.netway-media.com
*/

table {
  border-collapse: collapse;
  border: 1px solid #666666;
  font: normal 11px verdana, arial, helvetica, sans-serif;
  color: #363636;
  background: #FFF;
  text-align:left;
  }
caption {
  text-align: center;
  font: bold 16px arial, helvetica, sans-serif;
  background: transparent;
  padding:6px 4px 8px 0px;
  color: #CC00FF;
  text-transform: uppercase;
}
thead, tfoot {
background:url(bg1.png) repeat-x;
text-align:left;
height:30px;
}
thead th, tfoot th {
padding:5px;
}
table a {
color: #333333;
text-decoration:none;
}
table a:hover {
text-decoration:underline;
}
tr.odd {
background: #f1f1f1;
}
tbody th, tbody td {
padding:5px;
}
.negrita{
	font-weight:bold;

	}
		.titulo{ font-size:18px; font-weight:bold; text-decoration:underline; }
 </style>
 <script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>

 <script src="<?php echo config::ruta();?>js/PrintArea.js" type="text/javascript"></script>
  <script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#exportar").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
 <body>


<div >
 <form action="<?php config::ruta();?>?accion=reporteNotaDevolucion" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" width="31" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numeroRemision" name="numero" value="<?php echo $res["iddevolucion"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:650px; margin:auto 10px;">
<table width="631" border="0" id="exportar" >
<tr>
<td width="623">
<table width="516" height="162" border="0" align="center" style="font-family:Calibri; font-size:10px;" >
  <tr>
    <td colspan="2"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="162" height="20"/></td>

  </tr>
  <tr>
    <td style="text-decoration:underline" colspan="4" align="center" ><p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">KARDEX CLIENTE</p>
      </td>
   <td width="99"  style="background-color:#E6E6E6; border:groove;"><span   style="font-size:18px; font-weight:bold;">N&ordm;Cta :<?php echo $res["numcuenta"]; ?></span></td>
  </tr>
  <tr>
    <td height="20" colspan="4"  class="negrita">NOMBRE CLIENTE:     <?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"]; ?></td>
    <td class="negrita">CARNET:<?php echo $res["ci"]; ?></td>
    </tr>
  <tr>
    <td height="20" colspan="2" class="negrita">DOMICILIO:<?php echo $ref["direccion"]; ?></td>
    <td width="118" align="left"> ZONA:<?php echo $ref["zona"]; ?></td>
    <td width="91" class="negrita">BARRIO:<?php echo $ref["barrio"]; ?></td>
    <td class="negrita">TELF:<?php echo $ref["telf"]; ?></td>
    </tr>
  <tr>
    <td colspan="5" class="negrita">LUGAR DE COBRANZA:<?php echo $ref["lugarcobranza"]; ?></td>
  </tr>
  <tr>
    <td width="99" class="negrita">TELF</td>
    <td width="85" class="negrita">CEL:</td>
    <td class="negrita">F.VENTA :<?php echo $res["fechadoc"]?></td>
    <td class="negrita">F.COBRANZA:<?php echo $ref["diacobrar"]?></td>
    <td class="negrita">a Hrs:       </td>
    </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="514" border="1" style="font-family:Calibri; font-size:10px;" align="center" cellspacing="0">
<thead>
  <tr>

    <td align="center" width="25" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center" width="39" class="negrita">CODIGO</td>
    <td align="center" width="51" class="negrita">CANTIDAD</td>
    <td align="center" width="352" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
       <td align="center" width="25" class="negrita">P.UNIT</td>
    </tr>
  </thead>
  <tbody>
  <?php $cont =1; $c2=0; $total=0;foreach($res3 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["codigo"];?></td>
    <td><?php  $c2+=$v["cantidad"];echo $v["cantidad"];?></td>
    <td align="left"><?php echo utf8_decode($v["titulo"]);?></td>
    <td><?php echo $v["volumen"];?></td>
     <td><?php $total+=$v["precio_unitario"];echo $v["precio_unitario"];?></td>
    </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td colspan="2" class="negrita" style="font-weight:bold; background-color:#EFEFEF;">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center"><?php echo $c2; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php echo $total; ?></strong></td>
    </tr>
    <tr>
  <td colspan="8"><b>Obs:</b><?php ?></td>
  </tr>
  </tfoot>
</table>
<table width="92%" border="0" style=" font-size:7px;">
  <tr  align="center">
    <td width="18%">&nbsp;</td>
    <td width="18%"><b>PRECIO TOTAL</b></td>
    <td width="17%">CUOTA INICIAL</td>
    <td width="18%">SALDO</td>
    <td width="16%"><b>CONDICIONES</b></td>
    <td width="1%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="background-color:#E6E6E6; border:groove; font-weight:bolder; text-align:center;"><?php echo $res["preciototal"]; ?></td>
    <td style="background-color:#E6E6E6; border:groove; font-weight:bolder; text-align:center;"><?php echo $res["cuotainicial"]; ?></td>
     <td style="background-color:#E6E6E6; border:groove; font-weight:bolder; text-align:center;"><?php echo $res["saldo"]; ?></td>
    <td style="background-color:#E6E6E6; border:groove; font-weight:bolder; text-align:center;"><?php $condi=$cuota->contarCuotas($res["idcredito"]);echo $condi["numcuotas"]." x ".$condi["monto"]; ?></td>
    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td width="1%">&nbsp;</td>
  </tr>

</table>
<table width="100%" border="0"  style="font-size:9px">
  <tr>
    <td width="16%"> <b>Verificador:</b></td>
    <td width="33%"><?php echo $cuenta["verificador"]; ?></td>
    <td width="19%"><b>Transferencia:</b></td>
    <td colspan="3"><?php echo $cuenta["transferencia"]; ?></td>
    </tr>
  <tr>
    <td><b>Vendedor:</b></td>
    <td><?php echo $vendedor->getNombresVendedor($res["idvendedor"]); ?></td>
    <td><b>Sup:</b></td>
    <td width="20%"><?php echo $cuenta["sup"]; ?></td>
    <td width="8%"><b>G.C.:</b></td>
    <td width="4%"><?php echo $cuenta["gc"]; ?></td>
  </tr>
</table>
<table width="627" border="1" style="font-family:Calibri; font-size:10px;" align="center" cellspacing="0">
<thead>
  <tr>

    <td align="center" width="27" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center" width="66" class="negrita">FECHA</td>
    <td align="center" width="43" class="negrita">NUM REPORTE</td>
    <td align="center" width="59" class="negrita">NUM DE RECIBO</td>
    <td align="center" width="215" class="negrita">NOMBRE DEL RECIBO</td>
    <td align="center" width="60" class="negrita">IMOPRTE RECIBO</td>
    <td align="center" width="41" class="negrita">SALDO</td>
    <td width="82" align="center" class="negrita">COBRADOR</td>

  </tr>
  </thead>
  <tbody>
  <?php $cont =1; $sum=0; foreach($res4 as $v){ ?>

  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["fecha"];?></td>
    <td><?php echo $v["num_reporte"];?></td>
    <td align="left"><?php echo $v["numrecibo"];?></td>
    <td align="left"><?php echo $v["cliente"];?></td>
    <td align="left"><?php echo $v["monto"];?></td>
    <td><?php $sum+=$v["monto"];  echo $res["saldo"]-$sum;?></td>
    <td><?php echo $cobrador->getNombresCobrador($v["idcobrador"]);?></td>
  </tr>

  <?php $cont++;}?>
  </tbody>
  <tfoot>
  </tfoot>
</table>

</td>
</tr>


</table>


 </div>
 <p><a href="javascript:void(0)" id="imprime"><img src="<?php echo config::ruta()?>/images/iconos/imprimir.jpg">Imprime</a>/

 <?php if(isset($_GET["acc"])){?><a href="<?php config::ruta() ?>?accion=cuentas"  >Volver</a></p><?php }else{?>
 <a href="" id="imprime" onClick="window.close();">Cerrar</a></p>
 <?php }?>
 <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>




</body>
