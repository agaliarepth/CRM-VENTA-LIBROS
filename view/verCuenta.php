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
 <form action="<?php config::ruta();?>?accion=reporteRegistroPagos" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="cuenta" name="cuenta" value="<?php echo $res2["numcuenta"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:650px; margin:auto 10px;">
<table width="643" border="0" id="exportar" >
<tr>
<td width="686">
<table width="632" border="0" align="center" style="font-family:Calibri; font-size:10px;" >
  <tr>
    <td colspan="2"><img src="<?php echo config::ruta();?>images/shared/logo.png" width="74" height="20"/></td>
    
  </tr>
  <tr>
    <td style="text-decoration:underline" colspan="3" align="center" > <p style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">&nbsp;</p>
      </td>
    <td width="209" align="center" style="text-decoration:underline" ><span style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">REGISTRO DE PAGOS</span></td>
   <td  style="font-size:12px; font-weight:bold" ><B>NUM CUENTA</B></td>
   <td  style=" border:groove;"><span   style="font-size:18px; font-weight:bold;"><?php echo $res2["numcuenta"]; ?></span></td>
  </tr>
  <tr>
    <td  class="negrita" colspan="2"><B>NOMBRE CLIENTE :<?php echo $res2["nombres"]." ".$res2["apellidopaterno"]." ".$res2["apellidomaterno"]; ?> </B>   </td>
    <td colspan="2"><B>COBRADOR:<?php echo  $cobra->getNombresCobrador($res2["idcobrador"]);?></B></td>
    <td colspan="" class="negrita">NUM CONTRATO</td>
    <td class="negrita"><?php echo $res2["numcontrato"]; ?></td>
  </tr>
  <tr>
    <td height="23" colspan="2" class="negrita">FECHA DEL CONTRATO:<?php echo $res2["fechacontrato"]; ?></td>
    <td colspan="2" align="left"><B>VENDEDOR: <?php echo $vendedor->getNombresVendedor($res2["idvendedor"]); ?></B></td>
    <td width="75" class="negrita">SALDO INICIAL</td>
    <td width="109" class="negrita"><?php echo $res2["saldo"]; ?></td>
  </tr>
  <tr>
    <td class="negrita" colspan="2"><b>MONTO TOTAL:<?php echo $res2["preciototal"]; ?></b></td>
    <td colspan="2" align="left" class="negrita"><b>PAGO INICIAL:<?php echo $res2["cuotainicial"]; ?></b></td>
    
    <td colspan="2" align="LEFT"><b>NUMERO DE PAGOS:<?php echo $res2["numcuotas"]; ?></b></td>
  </tr>
</table>
</td>
</tr>
<tr>
<td>
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
  <?php 
  $saldo=$res2["saldo"];
  $cont =1; foreach($res as $v){ ?>

  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["fecha"];?></td>
    <td><?php echo $v["num_reporte"];?></td>
    <td align="left"><?php echo $v["numrecibo"];?></td>
    <td align="left"><?php echo $v["cliente"];?></td>
    <td align="left"><?php echo $v["monto"];?></td>
    <td><?php
	$saldo-=$v["monto"];
	 echo $saldo;?></td>
    <td><?php echo $v["quiencobro"];?></td>
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  </tfoot>
</table>
</td>
</tr>
<tr>
<td><p>OBSERVACIONES DEL VERIFICADOR COBRADOR :</p>
  <p>.............................................................................................................................................................</p>
  <p>..............................................................................................................................................................</p>
  <p>&nbsp;</p>
  <p  style="margin:auto 0; text-align:center;">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center;">FIRMA DEL CLIENTE</p>
<p  style="margin:auto 0; text-align:center;"><?php echo $res2["nombres"]." ".$res2["apellidopaterno"]." ".$res2["apellidomaterno"]; ?></p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center; font-family:calibri; font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center; font-family:calibri; font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center; font-family:calibri; font-size:10px;">&nbsp;</p>
</td>
</tr>

</table>


 </div><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime">Imprime</a></p>
     <?php } ?>
   
      <p><a href="<?php config::ruta();?>?accion=cuentas">Volver</a></p>
               
<script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</body>
