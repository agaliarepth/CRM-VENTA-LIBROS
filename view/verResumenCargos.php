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
<div id="seleccion">
<h6> CARGOS DE <?php echo $nombres;?> HASTA( <?PHP echo date("d-m-Y")?>)</h6>
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