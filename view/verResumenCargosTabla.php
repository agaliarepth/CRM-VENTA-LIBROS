

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
 
 
 <?php $mes="";switch($_GET["mes"]){
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
    <table><tr>
    <td>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/iconos/imprimir.jpg" alt="imprimir" width="45" height="46">Imprimir</a> 
      <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script></p></td>
<td>
<form action="<?php config::ruta();?>?accion=reporteResumenCargos" method="post" target="_blank" id="FormularioExportacion">
<p> <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" />Exportar a Excel </p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="mes" name="mes" value="<?php echo $_GET["mes"];  ?>" />
<input type="hidden" id="anio" name="anio" value="<?php echo $_GET["anio"];  ?>" />
</form>
</td>
</tr>
</table>
 <div id="myPrintArea"  style="width:600px; margin:auto 10px;">
<H1>RESUMEN CARGOS DE VENDEDORES  DE <?php echo $mes;?> de <?php echo $_GET["anio"];?></H1>
<table  width="100%" border="1" style="background-color:#E0FFC1; font-size:12px;" id="exportar">

  <tr  style="background-color:#BBE9FF; font-size:9px;"  >
  <td width="54">CODIGO</td>
  <td width="214"  >TITULO</td>
  <?php foreach($res2 as $v){?>
    <td width="17"  class="rotar" ><?php echo $v["nombres"]."".$v["apellidos"];?></td>
   <?php }?>
   <td width="207">TOTAL</td>
  </tr>
  <?php $s2=0;foreach($res3 as $r){?>
  <tr>
  
	
			
    <td style="background-color:#BBE9FF; font-size:9px; font-weight:bold;"> <?php echo $r["cod_libro"];?></td>
     <td style="background-color:#BBE9FF; font-size:9px; font-weight:bold; width:20%"> <?php echo $r["titulo_libro"];?></td>
    <?php $s1=0;$sw=0;
   foreach($res2 as $v){?>
    	 <td align="center"> <?php 
		 $res5=$kv->verRemisionesFila($v["idVendedores"],$r["idlibro"],$_GET["mes"],$_GET["anio"]); echo $res5["suma"]; $s1+=$res5["suma"];
		
		 ?>
        </td>
        
   	<?php }
	
	?>
    <td style="background-color:#FFC; font-weight:bolder; text-align:center;"><?php $s2+=$s1;echo $s1;?></td>
  </tr>
   
  
   <?php }?>
   <tr style="background-color:#FFC; font-weight:bolder; text-align:center;">
    <td></td>
    <td></td>
    <?php $s3=0;
    foreach($res2 as $v){?>
    
    <td><?php $res6=$kv->verTotalColumna($_GET["mes"],$_GET["anio"],$v["idVendedores"]);$s3+=$res6["total"]; echo $res6["total"];?></td>
    <?php }?>
    <td><?php echo "c=".$s3." f=".$s2;?></td>
    </tr>
     
</table>
</div>
