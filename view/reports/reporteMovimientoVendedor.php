<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ResumenMovimientoVendedor.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
    <h1 style=" text-align:center; font-size:14px; text-decoration:underline;  margin:0; ">MOVIMIENTO VENDEDOR </h1>
    <p style=" text-align:LEFT; font-size:14px; "><?php echo $_POST["vendedor"];?></p><p>    DESDE:<?php echo $_POST["f1"]; ?> HASTA:<?php echo $_POST["f2"]; ?></p>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>