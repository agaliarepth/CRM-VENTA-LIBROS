 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script>

function rechazarDevolucion(id){

 enviarRuta("<?php echo config::ruta();?>?accion=devolucionObras&id="+id+"&e=rechazar","Se rechazara la nota a ventas . Desea continuar?");


}

</script>


 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
   
 <table><tr>
 <td>
  <h1>ALMACEN > DEVOLUCION DE CONTRATOS DIFERIDOS</a> </h1>
  </td>
  

  </tr>
  </table>
  <hr />
  </div>


<div id="table-content">
	
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Nº </th>
                  
                    <th class="">Fecha</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Cliente</th>
                    <th class="">Cobrador</th>
                    <th class="">Vendedor</th>
                     <th class="">Procedencia</th>
                    
                      <th >Opciones</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td><?php echo $v["iddevolucionObras"];?></td>
              
					
					<td><?php echo $v["fecha"];?></td>
                   
                    <td><?php echo $v["num_contrato"]?></td>
                    
                   <td><?php echo $v["cliente"]?></td>
                     <td><?php echo $v["cobrador"]?></td>
                    <td><?php echo $v["vendedor"]?></td>
                   <td><?php echo $v["procedencia"]?></td>
                    	<td >
						<?php if($v["estado"]=="enviado" && $v["procedencia"]=="VENTAS" ){?>
                        <a  href="<?php echo config::ruta();?>?accion=addDevolucionContratos&id=<?php echo $v["iddevolucionObras"];?>"><img src="<?php echo config::ruta();?>images/iconos/download.png" width="35" height="35" alt="Enviar a Almacen" title="Enviar a Almacen"  /></a>



                    	
                        <a href="###" onclick="rechazarDevolucion(<?php echo $v["iddevolucionObras"];?>);"> <img src="<?php echo config::ruta();?>images/iconos/rechazar.png" width="40" height="35"  alt="Editar" title="Rechazar"/></a>
                 
					
					<?php }?>
                    
                    <?php if($v["estado"]=="enviado" && $v["procedencia"]=="COBRANZAS" ){?>
                        <a href="<?php echo config::ruta();?>?accion=addIngresoVenta&id=<?php echo $v["iddevolucionObras"];?>" ><img src="<?php echo config::ruta();?>images/iconos/download.png" width="35" height="35" alt="Enviar a Almacen" title="Enviar a Almacen" /></a>  
                         
				
                    
                    	
                        <a href="<?php echo config::ruta();?>?accion=devolucionObras&id=<?php echo $v["iddevolucionObras"];?>&e=rechazar"> <img src="<?php echo config::ruta();?>images/iconos/rechazar.png" width="40" height="35"  alt="Editar" title="Rechazar"/></a>
          
					
					
					<?php }?>
				
					
					</td>

					
				</tr><?php
				}
				?>
               
                </tbody>
                <tfoot>
				<tr>
					<th class="">Nº </th>
                  
                    <th class="">Fecha</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Cliente</th>
                    <th class="">Cobrador</th>
                    <th class="">Vendedor</th>
                      <th class="">Procedencia</th>
                      <th >Opciones</th>
                  
                  
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