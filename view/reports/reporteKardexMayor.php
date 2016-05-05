<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=KardexMayor.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<img type="image" name="imageField5"  src="<?php echo config::ruta();?>images/shared/logo.png" width="169" height="42"  alt="" style="margin-left:20;"/>
<h1 style=" text-align:center; font-size:14px; text-decoration:underline;  margin:0; ">KARDEX MAYOR</h1>
<p style=" text-align:LEFT; font-size:14px; ">CODIGO:<?php echo $_POST["codigo"]."  ".$_POST["titulo_libro"];?></p>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>