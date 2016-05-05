 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">

		
		
	
  $(document).ready(function($)
  {
	       $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#producciondiaria").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	  $('#producciondiaria').dataTable( {
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
		
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [0,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
});

 <?php if(isset($_POST["tipo"])&& $_POST["tipo"]=="mensual"){?>
 
  
	       $(".botonExcel").click(function(event) {
    $("#datos_a_enviar").val( $("<div>").append( $("#categorias2-table").eq(0).clone()).html());
     $("#FormularioExportacion2").submit();
});
 
 <?php }?>
 	
  });
 
	   
			
	  
	  
  </script> 
	



<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
 
  <h1>VENTAS > REPORTES > PRODUCCION DIARIA  </h1>

  <hr />
  </div>



<div id="table-content">
<form name="form"   method="post"  action="">
      <fieldset>
   
    <table border="0">
    <tr>
  
    

<th>
<input type="text" class="fechas" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>"/>


</th>
  
                <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="PRODUCCION DIARIA" /></td>
                <td>
                <input type="hidden" name="tipo" value="diaria"/>
               </td>
                  
               
               
             
                
               
               
          </tr>
       
        
              </table>
              
            
                 </fieldset>
               
               </form>
    
               
               
               
             
		<?php
				
				 if(isset($_POST["tipo"])&& $_POST["tipo"]=="diaria"){?>
                 <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=verReporteroduccionDiaria" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
  <input type="hidden" name="fecha" value="<?php echo $_POST["fecha"]; ?>" />
              
</form>
</div>


		<table width="100%" border="1" id="producciondiaria" style="font-size:9px;background-color:#E0FFC1" >
        <thead>
  <tr style="background-color:#BBE9FF; color:#333; font-weight:bolder; text-align:center;">
    <th >EJECUTIVOS DE VENTAS</th>
    <TH>FECHA</TH>
    <th >CANT</th>
    <th >PRECO VENTA</th>
    <th >PRECIO</BR>BASICO</th>
    <th >CUOTA I.</th>
    <th>%</th>
    <th >SALDO</th>
    <th >COMISION</th>
    <th >% COMISION</th>

    </tr>
  
  </thead>
  <tbody>
  <?php $s1=0;$s2=0;$s3=0;$s4=0;$s5=0;$s6=0;$s7=0;
		 
 
  foreach($res as $v){
	 
	  ?>
  <tr style="background-color:#DFDFDF;">
 
    <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]);?></td>
     <td><?php echo $v["fechadoc"]?></td>
    <td><?php $s1+=$v["cont"];echo $v["cont"]?></td>
    <td><?php $s2+=$v["ptotal"];echo $v["ptotal"];?></td>
    <td><?php $s3+=$v["comision"];echo $v["comision"]?></td>
    <td><?php $s4+=$v["cuota"];echo $v["cuota"]?></td>
    <td><?php  $p1=round(($v["cuota"]*100)/$v["ptotal"],2); echo $p1; $s5+=$p1; ?></td>
    <td><?php  $saldo=$v["ptotal"]-$v["cuota"]; echo $saldo; $s6+=$saldo;?></td>
    <td><?php ?></td>
    <td><?php ?></td>
    </tr>
    
    
    <?php 
	}
	
  
				 ?>
                  <tr style="font-size:12px; font-weight:bold; background-color:#E9E9E9">
      <td ><B>TOTALES</B></td>
      <td></td>
      <td><?php echo number_format($s1,2,',','.'); ?></td>
     
      <td><?php echo number_format($s2,2,',','.');?></td>
      <td><?php echo number_format($s3,2,',','.'); ?></td>
      <td><?php echo number_format($s4,2,',','.'); ?></td>
      <td><?php  echo number_format($s5,2,',','.');?></td>
      <td><?php  echo number_format($s6,2,',','.');?></td>
      <td><?php  ?></td>
      <td><?php   ?></td>
     
      </tr>
                 </tbody>
                 <tfoot>
     
    </tfoot>
    
</table>
<?php }?>
		
                
             

				
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
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>