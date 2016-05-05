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
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numeroRemision" name="numero" value="<?php echo $res["iddevolucion"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:650px; margin:auto 10px;">
<table border="0" id="exportar" >
<tr>
<td>
<table width="632" border="0" align="center" style="font-family:Calibri; font-size:10px;" >
  <tr>
    <td colspan="2"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="74" height="20"/></td>
    
  </tr>
  <tr>
    <td width="73" align="center" style="text-decoration:underline" ><p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">&nbsp;</p>
      </td>
    <td width="22" align="center" style="text-decoration:underline" >&nbsp;</td>
    <td colspan="5" align="center" style="text-decoration:underline" ><span style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">DEVOLUCION CONTRATO</span></td>
    <td></td>
    <td  style=" border:groove;"colspan="3"><span   style="font-size:18px; font-weight:bold;">N&ordm; Cont :<?php echo $res["num_contrato"]; ?></span></td>
  </tr>
  <tr>
    <td  class="negrita" colspan="2">NOMBRE CLIENTE:    </td>
    <td colspan="5"> <?php echo $res["cliente"]; ?></td>
      <td class="negrita"><?php echo $res["fecha"]; ?></td>


    <td colspan="2" class="negrita">NUM NOTA:<?php echo $res["iddevolucionObras"]; ?></td>
  </tr>
  <tr>
    <td class="negrita" colspan="2">COBRADOR</td>
    <td colspan="2" align="left"> <?php echo $res["cobrador"]; ?></td>
    <td width="55" align="left"><B>VENDEDOR:</B></td>
    <td colspan="2" class="negrita"><?php echo $res["vendedor"]; ?></td>
    <td class="negrita">CHOFER:</td>
    <td colspan="2" class="negrita"><?php echo $ven->getNombresVendedor($vendedorChofer["idchofer"]); ?></td>
  </tr>
  <tr>
    <td class="negrita" colspan="2">COORDINADOR</td>
    <td colspan="2" align="left" class="negrita"><?php if( $res["coordinador"]=="") echo "NINGUNO"; else echo  $res["coordinador"]; ?></td>
    <td align="left" class="negrita">SUPERVISOR</td>
    
    <td colspan="2" ><?php echo $res["supervisor"]; ?></td>
    <td width="55" ><b>GERENTE</b></td>
    <td colspan="2" ><?php echo $res["gerente"]; ?></td>
  </tr>
  <tr>
  <td>
  <b>MONTO TOTAL :</b>
  </td>
  <td><?php echo $res["monto_total"]; ?></td>
  <td width="74"><b>CUOTA INICIAL:</b></td>
  <td width="70"><?php echo $res["cuota_inicial"]; ?></td>
   <td><b>SALDO:</b></td>
   <td width="61"><?php echo $res["saldo"]; ?></td>
   <td width="55"><B>PAGO CUENTA</B></td>
  <td></td>
  <td width="70"><B>VALOR DE VOLUMEN</B></td>
  <td width="53"></td>
  </tr>
  
</table>
</td>
</tr>
<tr>
<td>
<table width="630" border="1" style="font-family:Calibri; font-size:10px;" align="center" cellspacing="0">
<thead>
<tr>
  <td colspan="12" align="center"  ><span style="font-size:14px; font-family:calibri; font-weight:bold; ">DETALLE</span></td>
  </tr>
  <tr>
  
    <td align="center" width="25" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center" width="39" class="negrita">CODIGO</td>
    <td align="center" width="51" class="negrita">CANTIDAD</td>
    <td align="center" width="352" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
    <td align="center" width="25" class="negrita">PU</td>
    <td align="center" width="25" class="negrita">PT</td>
    
  </tr>
  </thead>
  <tbody>
  <?php  $cont2=0;$cont =1; $cont3=0; $pt=0; foreach($res2 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["codigo"];?></td>
    <td><?php $cont2+=$v["cantidad"];echo $v["cantidad"];?></td>
    <td align="left"><?php echo $v["titulo"];?></td>
    <td><?php echo $v["volumen"];?></td>
    <td><?php echo $v["precio_unitario"]; $pt+=($v["cantidad"]+$v["precio_unitario"]); ?></td>
    <td><?php $cont3+=$v["precio_total"]; echo $v["precio_total"];?></td>
    
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td colspan="2" class="negrita" style="font-weight:bold; background-color:#EFEFEF;">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center"><?php echo $cont2; ?></td>
    <td>&nbsp;</td>
    <td colspan="2">Total</td>
    <td><?php echo $cont3;?></td>
    
    </tr>
    <TR>
    <td colspan="8"><b><?php echo $res["tipo_devolucion"]; ?></b></td></TR>
  </tfoot>
</table>
</td>
</tr>
<tr>
<td>

<p  style="margin:auto 0; text-align:left; font-size:8px;">Usuario:<?php echo $res["nombre_usuario"]; ?></p>

<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center; font-family:calibri; font-size:10px;">Firma Cliente</p>
<p  style="margin:auto 0; text-align:center; font-family:calibri; font-size:10px;"><?php echo $res["cliente"]; ?></p>
</td>

</tr>
<tr>
<td colspan="5"><p style="font-family:calibri; font-size:10px;" ><b>obs:</b><?php echo $res["obs"]; ?></p></td>

</tr>

</table>


 </div>
 <p><a href="javascript:void(0)" id="imprime">Imprime</a></p>
 <p><a href="<?php echo config::ruta();?>?accion=devolucionObras" id="imprime">Volver</a></p>
 <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>




</body>
