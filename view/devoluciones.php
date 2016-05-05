<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > DEVOLUCIONES</h2>
            <div>
                
           
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th class="">Nº Devolucion </th>
                    
                    <th class="">Fecha</th>
                    <th class="">Cliente</th>
                     <th class="">Monto</th>
                     <th class="">Moneda</th>
                    <th class="">Num Ingreso</th>
                    <th>ESTADO</th>
                   
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  <?php if($v["terminado"]==0){ ?>
                  
                 
<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarRuta('<?php echo config::ruta();?>?accion=addDevolucion&id=<?php echo $v["iddevolucion"];?>&e=n','Se hara efectiva la nota de devolucion.?');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>

 <a  href="<?php echo config::ruta();?>?accion=addDevolucion&e=editar&id=<?php echo $v["iddevolucion"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota" /></a>
                  

  	
                  
                  <?php }?>
                  <?php if($v["terminado"]==1){ ?>
                  <img src="<?php echo config::ruta();?>images/eliminar.png" width="35" height="35" onclick="enviarRuta('<?php echo config::ruta();?>?accion=devoluciones&e=borrar&id=<?php echo $v["iddevolucion"];?>','Realmente desea eliminar Este registro.?');"/></a>
                  <?php }?>
                  </td>
                
                				
					<td align="center"><?php echo $v["iddevolucion"];?></td>
                    
                     <td align="center"><?php echo $v["fecha"]?></td>
                    <td align="center"><?php echo $v["cliente"]?></td>
                    <td align="right"><?php echo $v["total"]?></td>
                     <td align="center"><?php echo $v["moneda"]?></td>
                    <td align="center"><?php echo $v["idingreso"]?></td>
                     <td align="center"><?php echo strtoupper($v["estado"]);?></td>
                   
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				
				</tfoot>
                <tbody>
				</table>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>