<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=REsumenCargos.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<?php $mes="";switch($_POST["mes"]){
	case '1':$mes="Enero";
	case '2':$mes="Febrero";
	case '3':$mes="Marzo";
	case '4':$mes="abril";
	case '5':$mes="Mayo";
	case '6':$mes="Junio";
	case '7':$mes="Julio";
	case '8':$mes="Aghosto";
	case '9':$mes="septiembre";
	case '10':$mes="Octubre";
	case '11':$mes="Noviembre";
	case '12':$mes="Diciembre";
	
	
	
	}?>
<h1>RESUMEN CARGOS DE VENDEDORES DE <?php echo $mes." De ".$_POST["anio"];?></h1>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>