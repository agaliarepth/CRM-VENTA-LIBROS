<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=planillaProduccion.xls");
header("Pragma: no-cache");
header("Expires: 0");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<img type="image" name="imageField5"  src="<?php echo config::ruta();?>images/visual-logo.png" width="169" height="42"  alt="" style="margin-left:20;"/>
<h1 style=" text-align:center; font-size:14px; text-decoration:underline;  margin:0; ">CUADRO VENTAS<br/>
(<?php echo $meses[$_POST["mes"]-1]."-".$_POST["anio"];?> )</h1><br/>
<h6>EJECUTIVO VENTAS : <?PHP echo $_POST["nombrevendedor"];?></h6>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>