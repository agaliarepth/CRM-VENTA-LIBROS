<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_administracion"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="miMenu" >
    <ul >
      
      <li ><a href="<?php echo config::ruta();?>?accion=addComisionContrato"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  
  <h1>Comisiones Contratos   </h1>
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">
		<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				<!--  end message-yellow -->
				
				<!--  start message-red -->
				
				<!--  end message-red -->
				
				<!--  start message-blue -->
				<div id="message-blue">
				
				</div>
				<!--  end message-blue -->
			
				<!--  start message-green -->
				<div id="message-green">
				
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class=""></th>
					<th class="">ID </th>
                    	<th class="">Cantidad de Meses</th>
					
					<th class="">Porcentaje Comision %</th>
					<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					<td><input  type="checkbox"/></td>
					
					<td><?php echo $v["idcomisionesContratos"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["meses"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["porcentaje"];?></td>

					<td class="options-width">
					
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=comisionContratos&e=bc&ic=<?php echo $v["idcomisionesContratos"];?>');"></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					<th class=""></th>
					<th class="">ID </th>
                    	<th class="">Cantidad de Meses</th>
					
					<th class="">Porcentaje Comision %</th>
					<th class="">Opciones</th>
				</tr>
				</tfoot>
                <tbody>
				</table>
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
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>