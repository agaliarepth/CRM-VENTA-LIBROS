<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=RelacionNotasRemision.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<img type="image" name="imageField5"  src="<?php echo config::ruta();?>images/shared/logo.png" width="169" height="42"  alt="" style="margin-left:20;"/>
<h1 style=" text-align:center; font-size:14px; text-decoration:underline;  margin:0; ">RELACION DE NOTAS DE REMISION  - <?php echo $_POST["fecha"];?><br/>
</h1>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>