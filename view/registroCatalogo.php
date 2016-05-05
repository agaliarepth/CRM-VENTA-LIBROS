<?php require_once("head.php");?>

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>



	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#catalogo-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});


$('#catalogo-table').dataTable( {
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
		
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth":true,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
});
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


  <div style="float:right;">
  <table>
  <tr>
   <td> IMPRIMIR<a href="javascript:imprSelec('seleccion')" ><img src="<?php config::ruta();?>images/iconos/impresora.png"   width="55" height="55"/></a></td>
  <td>
 <form action="<?php config::ruta();?>?accion=reporteLibros" method="post" target="_blank" id="FormularioExportacion">
<p>EXPORTAR  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
</form>
</td>

</tr>
</table>
</div>
<div id="table-content">
	 		<div id="seleccion">
                <h1 style="font-size:14; text-aligN:center; " >CATALOGO</h1>
                <hr />
				<table border="0"  width="70%" cellpadding="0" cellspacing="0" id="catalogo-table" style="font-size:9px;">
                <thead>
				<tr>
					
					<th class="">ID </th>
                    <th  align="center"class="">Codigo</th>
                    <th width="600" class="">Titulo</th>
                    <th align="center" class="">Tomo</th>
                    <th align="center" class="">Editorial</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
				
					
					<td><?php echo $v["idlibros"];?></td>
                    <td  align="center" style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                       <td><?php echo $v["titulo"]?></td>
                    <td align="center"><?php echo $v["tomo"]?></td>
                    <td  align="center"><?php echo $v["nombre_editorial"]?></td>
                    
                      

					
				</tr><?php
				}
				?>
                </tbody>
                
            
				</table>
            </div>
				<!--  end product-table................................... --> 
				
			</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
