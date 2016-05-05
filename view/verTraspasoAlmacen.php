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
 <form action="<?php config::ruta();?>?accion=reporteNotaTraspaso" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numero" name="numero" value="<?php echo $res["idtraspasos"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:600px; margin:auto 10px;">
<table id="exportar" border="0" style="font-family:calibri; font-size:10px;">
<tr>
<td>
<table width="650" border="0" align="center" style="font-family:calibri; font-size:10px;">
  <tr>
    <td colspan="6"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="74" height="20"/></td>
    </tr>
  <tr>
    <td colspan="5" align="center"  ><p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;"> NOTA DE TRASPASO DE ALMACEN</p>
      </td>
    <td align="center" style="border:groove;"  ><span   style="font-size:18px; font-weight:bold; ">N&ordm; :<?php echo $res["idtraspaso_almacen"]; ?></span></td>
  </tr>
  <tr>
    <td width="122"  class="negrita">ALMACEN ENVIA :    </td>
    <td  colspan="2" width="275" class="negrita"> <?php echo utf8_decode( $res["nombre_envia"]); ?></td>
    <td></td>
    <td width="89"  class="negrita">FECHA:</td>
    <td class="negrita" colspan="2" align="left"><?php echo $res["fecha"]; ?></td>
  </tr>
  <tr>
    <td class="negrita">ALMACEN  RECIBE:</td>
    <td colspan="2" align="left"> <?php echo utf8_decode( $res["nombre_recibe"]); ?></td>
    <td></td>
    <td class="negrita">&nbsp;</td>
    <td class="negrita" colspan="2">&nbsp;</td>
  </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="650" border="1" style="font-family:calibri; font-size:10px;"  cellspacing="0">
<thead>
  <tr>
  
    <td align="center" width="33" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"align="center" width="35" class="negrita">CODIGO</td>
    <td align="center" width="47" class="negrita">CANTIDAD</td>
    <td align="center" width="347" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
    <td align="center" class="negrita">Obs</td>
    </tr>
  </thead>
  <tbody>
  <?php $cont =1; foreach($res2 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["codigo"];?></td>
    <td><?php echo $v["cantidad"];?></td>
    <td align="left"><?php echo utf8_decode($v["titulo"]);?></td>
    <td><?php echo $v["volumen"];?></td>
    <td><?php echo utf8_decode($v["obs"]);?></td>
    </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="CENTER"  colspan="2" class="negrita">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><span class="negrita"><?php echo $res["total"]; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="negrita"  style="font-weight:bold; background-color:#EFEFEF;">&nbsp;</td>
    </tr>
  </tfoot>
</table>

</td>
</tr>
<tr>
<td>
<table width="100%" border="0">
<tr>
<td >

<p  style="margin:auto 0; text-align:left; font-size:9px;">Usuario:<?php echo $res["usuario"]; ?></p>


</td>
<td>

<p  style="margin:auto 0; text-align:left; font-size:9px;">&nbsp;</p>
</td>
<td><p  style="margin:auto 0; text-align:left; font-size:9px">&nbsp;</p></td>

</tr>
<tr>
<td colspan="3" align="center">
<div style=" width:260px; float:left;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;margin-left:15px; ">--------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">RECIBI CONFORME</br>
<?php // echo $nom["administrador"]; ?>
</br>ENCARGADO DE ALMACEN</p>
</div>

</td>
<td>
<div style=" width:260px; float:right;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">ENTREGUE CONFORME</p>
<p  style="margin:auto 0; text-align:center; font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
</div>
</td>
</tr>
<tr>
<td colspan="5"><p style="font-family:calibri; font-size:10px;" ><b>obs:</b><?php echo $res["obs"]; ?></p></td>

</tr>

</table>
</td>
</tr>
</table>










 </div>
 <?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/iconos/imprimir.jpg" alt="imprimir">Imprimir</a> </p>
      <p><a href="<?php echo config::ruta();?>?accion=traspasoAlmacen" id="imprime">Volver</a></p>

     <?php } ?>

     
     
      <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
 
 
 
</body>
