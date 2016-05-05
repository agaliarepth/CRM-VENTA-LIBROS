 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_administracion"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>



 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
   
 
  <h1>Devolucion de Obras  > Listar </h1>
<br />
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
                        <?php if($v["procedencia"]=="VENTAS"){?>
                        <a ><img src="<?php echo config::ruta();?>images/iconos/ingreso.png" width="35" height="35" alt="Ver Nota Ingreso" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["idingreso"];?>');"/></a> 
                          <a ><img src="<?php echo config::ruta();?>images/iconos/devolucion.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucionObras&id=<?php echo $v["iddevolucionObras"];?>');"/></a>  
                          
                              <a ><img src="<?php echo config::ruta();?>images/iconos/contrato.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>');"/></a>  
              
                    
                         <a > <img src="<?php echo config::ruta();?>images/iconos/aprovar.png"  onclick="aprobarDevolucionObra('<?php echo config::ruta();?>?accion=devolucionObrasAdmin&id=<?php echo $v["iddevolucionObras"];?>&e=aprobado')";width="40" height="35"  alt="Editar" title="Aprovar"/></a>
                                
                    
                    	
                        
                       <a > <img src="<?php echo config::ruta();?>images/iconos/rechazar.png"  onclick="rechazarDevolucionObra('<?php echo config::ruta();?>?accion=devolucionObrasAdmin&id=<?php echo $v["iddevolucionObras"];?>&e=rechazado')";width="40" height="35"  alt="Editar" title="Rechazar"/></a>
					
					
					<?php }
					if($v["procedencia"]=="COBRANZAS"){?>
                     <a ><img src="<?php echo config::ruta();?>images/iconos/ingreso.png" width="35" height="35" alt="Ver Nota Ingreso" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verIngreso&id=<?php echo $v["idingreso"];?>');"/></a> 
                          <a ><img src="<?php echo config::ruta();?>images/iconos/devolucion.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucionVenta&id=<?php echo $v["iddevolucionObras"];?>');"/></a>  
                          
                              <a ><img src="<?php echo config::ruta();?>images/iconos/contrato.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>');"/></a>  
              
                    
                         <a > <img src="<?php echo config::ruta();?>images/iconos/aprovar.png"  onclick="aprobarDevolucionIngreso('<?php echo config::ruta();?>?accion=devolucionObrasAdmin&id=<?php echo $v["iddevolucionObras"];?>&e=aprobado&pro=c')";width="40" height="35"  alt="Editar" title="Aprovar"/></a>
                                
                    
                    	
                        
                       <a > <img src="<?php echo config::ruta();?>images/iconos/rechazar.png"  onclick="rechazarDevolucionObra('<?php echo config::ruta();?>?accion=devolucionObrasAdmin&id=<?php echo $v["iddevolucionObras"];?>&e=rechazado&pro=c')";width="40" height="35"  alt="Editar" title="Rechazar"/></a>
                    
                    
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