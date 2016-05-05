 <style type="text/css">
/* 
	Web20 Table Style
	written by Netway Media, http://www.netway-media.com
*/

 .recuadro table {
  border-collapse: collapse;
  
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
 
 
 <table border="0">
 <tr>
 <td>
 EXPORTAR
 <form action="<?php config::ruta();?>?accion=reporteNotaIngreso" method="post" target="_blank" id="FormularioExportacion">
 <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" width="35" height="35" />
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numero" name="numero" value="<?php echo $res["idingreso"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</td>
<td>
IMPRIMIR 
 <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/iconos/imprimir.jpg" alt="imprimir" width="35" height="35"></a> </p>
</td>
</tr>
</table>

 <div id="myPrintArea"  style="width:600px; margin:auto 10px;">
  <?php if($res["estado"]=="ANULADO"){?>
<img src=" <?php echo config::ruta();?>images/iconos/ANULADO.png"  style="position:absolute; top:5%; left:10%;">

<?PHP }?>
<table id="exportar" border="0" style="font-family:calibri; font-size:10px;">
<tr>
<td>
<table width="650" border="0" align="center" style="font-family:calibri; font-size:10px; border:1px solid" >
  <tr>
    <td colspan="6"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="74" height="20"/></td>
    </tr>
  <tr>
    <td colspan="5" align="center" > <p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">NOTA DE INGRESO</p>
      </td>
       <td  style=" border:groove;"colspan=""><span   style="font-size:18px; font-weight:bold;">N&ordm;:<?php echo $res["idingreso"]; ?></span></td>
  </tr>
  <tr>
    <td width="122"  class="negrita">RECIBE :    </td>
    <td  colspan="2" width="275" class="negrita"> <?php echo $res["recibe"]; ?></td>
    <td></td>
    <td width="89"  class="negrita">ENVIA:</td>
    <td class="negrita" colspan="2" align="left"><?php echo $res["envia"]; ?></td>
  </tr>
  <tr>
    <td class="negrita">FECHA :</td>
    <td colspan="2" align="left"> <?php echo $res["fecha"]; ?></td>
    <td></td>
    <td class="negrita">CONCEPTO:</td>
    <td class="negrita" colspan="2"><?php echo $res["concepto"]; ?></td>
  </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="650" border="1" style="font-family:calibri; font-size:10px;" cellspacing="0" cellpadding="0" >
<thead>
  <tr>
  
    <td align="center" width="33" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"align="center" width="35" class="negrita">CODIGO</td>
    <td align="center" width="47" class="negrita">CANTIDAD</td>
    <td align="center" width="347" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
    <td width="56" align="center" class="negrita">P/UNITARIO</td>
    <td width="61" align="center" class="negrita">P/TOTAL</td>
     <td width="61" align="center" class="negrita">OBS</td>
    
  </tr>
  </thead>
  <tbody>
  <?php $cont =1; foreach($res2 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["codigo"];?></td>
    <td><?php echo $v["cantidad"];?></td>
    <td align="left"><?php echo $v["titulo"];?></td>
    <td><?php echo $v["volumen"];?></td>
    <td><?php echo $v["precio_unitario"];?></td>
    <td><?php echo $v["precio_total"];?></td>
      <td><?php echo $v["obs"];?></td>
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="CENTER"  colspan="2" class="negrita">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><span class="negrita"><?php echo $res["cant_total"]; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td  style="font-weight:bold; background-color:#EFEFEF;" class="negrita">P/TOTAL :</td>
    <td class="negrita" style="font-weight:bold; background-color:#EFEFEF;"><?php echo $res["precio_total"]; ?></td>
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

<p  style="margin:auto 0; text-align:left; font-size:9px;">Usuario:<?php echo $res["nombre_usuario"]; ?></p>


</td>


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
<?php echo $nom["administrador"]; ?>
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










 </div><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/iconos/imprimir.jpg" alt="imprimir">Imprimir</a> </p>
     <?php } ?>

     
      <p><a href="<?php config::ruta();?>?accion=notasIngreso">Volver </a></p>
      <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</body>
