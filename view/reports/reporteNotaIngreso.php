<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=NotaIngreso-".$_POST["numero"].".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>