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
<HEAD>
<title>nota de remision - <?php echo $res["idremision"];?></title>
</HEAD>
 <body>
 <div >
 <form action="<?php config::ruta();?>?accion=reporteNotaRemision" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numeroRemision" name="numeroRemision" value="<?php echo $res["idremision"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:650px; margin:auto 10px;">
 <?php if($res["estado"]=="ANULADO"){?>
<img src=" <?php echo config::ruta();?>images/iconos/ANULADO.png"  style="position:absolute; top:5%; left:10%;">

<?PHP }?>
<table border="0" id="exportar" >
<tr>
<td>
<table width="632" border="0" align="center" style="font-family:Calibri; font-size:10px;" >
  <tr>
    <td colspan="2"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="74" height="20"/></td>
    
  </tr>
  <tr>
    <td style="text-decoration:underline" colspan="4" align="center" > <p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">NOTA DE REMISION</p>
      </td>
   <td  style=" border:groove;"colspan="2"><span   style="font-size:18px; font-weight:bold;">N&ordm;:<?php echo $res["idremision"]; ?></span></td>
  </tr>
  <tr>
    <td width="114"  class="negrita" colspan="2">NOMBRE :    </td>
    <td width="400" colspan="2"> <?php echo utf8_decode($res["nombre_vendedor"]); ?></td>
    <td colspan="" class="negrita">Almacen:</td>
    <td class="negrita"><?php echo $res["almacen"]; ?></td>
  </tr>
  <tr>
    <td class="negrita" colspan="2">FECHA :</td>
    <td colspan="2" align="left"> <?php echo $res["fecha"]; ?></td>
    <td width="51" class="negrita">N Req:</td>
    <td width="47" class="negrita"><?php echo $res["nota_pedido_idnota_pedido"]; ?></td>
  </tr>
  <tr>
    <td class="negrita" colspan="2">Por lo siguiente:</td>
    <td colspan="2" align="left" class="negrita">EN CONSIGNACION</td>
    
    <td colspan="2" align="right">Cochabamba</td>
  </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="630" border="1" style="font-family:Calibri; font-size:10px;" align="center" cellspacing="0">
<thead>
  <tr>
  
    <td align="center" width="25" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center" width="39" class="negrita">CODIGO</td>
    <td align="center" width="51" class="negrita">CANTIDAD</td>
    <td align="center" width="352" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
    <td width="98" align="center" class="negrita">OBS</td>
    
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
    <td><?php echo $v["obs"];?></td>
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td colspan="2" class="negrita" style="font-weight:bold; background-color:#EFEFEF;">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;" align="center"><?php echo $res["cant_total"]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  </tfoot>
</table>
</td>
</tr>
<tr>

<td colspan="0" align="center">
<p  style="margin:auto 0; text-align:left; font-size:8px;">Usuario:<?php echo $res["nombres_usuario"]; ?></p>
<div style=" width:260px; float:left;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>

<p  style="margin:auto 0; text-align:center;margin-left:15px; ">--------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">ENTREGUE  CONFORME</p>
<p style="margin:auto 0; text-align:center; font-size:10px;">ENCARGADO DE ALMACEN</p>
</div>


<div style=" width:260px; float:right;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">RECIBI CONFORME</p>
<p  style="margin:auto 0; text-align:center; font-size:10px;"><?php echo $res["nombre_vendedor"]?></p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
</div>
</td>

</tr>
<tr>
<td colspan="5"><p style="font-family:calibri; font-size:10px;" ><b>obs:</b><?php echo $res["obs"]; ?></p></td>

</tr>
</table>


 </div><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime">Imprime</a></p>
     <?php } ?>
    <?php if(isset($_SESSION["idvendedores"])&& $_SESSION["idvendedores"]!=0  ){?>
      <p><a href="<?php config::ruta();?>?accion=yonotasRemision">Volver</a> </p>
     <?php } else{?>
      <p><a href="<?php config::ruta();?>?accion=notasRemision">Volver a la Lista de Remisiones</a></p><?php }?>
               
<script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</body>
