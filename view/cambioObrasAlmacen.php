 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">
<div id="page-heading">
   
 <table><tr>
 <td>
  <h1>ALMACEN > CAMBIO OBRAS COBRANZA</a> </h1>
  </td>
  

  </tr>
  </table>

  </div>


<div id="table-content">
	
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Nº </th>
                    <th class="">Fecha</th>
                    <th class="">Num Cuenta</th>
                    <th class="">Cliente</th>
                    <th >Opciones</th>
                  
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
					$res2=$credito->getCreditoContratoId($v["credito_idcredito"]);
				?><tr>
                <td><?php echo $v["idcambioObra"];?></td>
              
					
					<td><?php echo $v["fecha"];?></td>
                   
                     <td><?php echo $res2["numcuenta"]?></td>
                <td><?php echo $res2["nombres"]." ".$res2["apellidopaterno"]." ".$res2["apellidomaterno"]?></td>
                     
                    	<td >
						
                    
                  
                        <a  href="<?php echo config::ruta();?>?accion=addCambioObrasAlmacen&id=<?php echo $v["idcambioObra"]?>"><img src="<?php echo config::ruta();?>images/iconos/download.png" width="35" height="35" alt="Enviar a Almacen" title="Enviar a Almacen"/> </a>  
                         
				
                    
                    	
                        <a href="<?php echo config::ruta();?>?accion=cambioObrasAlmacen&id=<?php echo $v["idcambioObra"];?>&e=rechazar"> <img src="<?php echo config::ruta();?>images/iconos/rechazar.png" width="40" height="35"  alt="Editar" title="Rechazar"/></a>
          
					
					
					
				
					
					</td>

					
				</tr><?php
				}
				?>
               
                </tbody>
                
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