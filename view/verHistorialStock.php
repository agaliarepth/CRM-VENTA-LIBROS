<html>
<head>
<title>PanamericanBooks-STOCK</title>
<link rel="stylesheet" href="<?php echo config::ruta();?>css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery-ui.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery.dataTables.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet"  href="<?php echo config::ruta();?>css/default1.css" media="screen" type="text/css" />




<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/zebra_datepicker.js"></script>
<script src="<?php echo config::ruta();?>js/jquery-u-min.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.validate.js" type="text/javascript"></script>
<script>
              $(document).ready(function() {
				  
				   
    $('#categorias-table').dataTable( {
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]]
		
    } );
} );
		</script>
        <script src="<?php echo config::ruta();?>js/PrintArea.js" type="text/javascript"></script>
  <script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
</head>
<body>
<div >
<table>
<tr><td>
 <form action="<?php config::ruta();?>?accion=reporteHistorialStock" method="post" target="_blank" id="FormularioExportacion">
Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" />
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="fecha" name="fecha" value="<?php echo $res3["fecha"];  ?>" />

</form>
</td>
<td><div>
<p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/iconos/imprimir.jpg"  />Imprime</a></p>
 
 <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</div></td>
</tr>
</table>
</div>
<div id="myPrintArea"  style="width:650px; margin:auto 10px;">
<h2 align="center">INVENTARIO - <?php echo $res3["fecha"];?></h2>
<table border="0" width="100%" id="categorias-table"      >
                <thead>
				<tr style="background-color:#BBE9FF; color:#333;">
				
					
                    <th class="">Codigo</th>
                    
                    <th class="">Titulo</th>
                    <th class="">Vol</th>
                                     
                    <th class="">FISICO<br /> </th>
                     <th class="">RESERVADO</th>
                      <th class="">DISPONIBLE</th>
                  </tr>
				</thead>
<tbody>
                <?php foreach($res as $v){ 
				$res2=$li->getLibroStock($v["idlibros"]);?>
                <tr>
                <td><?php echo $res2["codigo"];?></td>
                 <td><?php echo $res2["titulo"];?></td>
                  <td><?php echo $res2["tomo"];?></td>
                   <td><?php echo $v["fisico"]?></td>
                    <td><?php echo $v["reservado"]?></td>
                     <td><?php echo $v["disponible"]?></td>
                    
                
                </tr><?php }?>
                
                </tbody>
<tfoot></tfoot>
</table>
</div>

</body>
</html>