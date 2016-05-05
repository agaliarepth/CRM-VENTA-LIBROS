 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  
 <?php if(count ($res)>0){?>
  <h1>Pagos ><span style=" color:#F30;">CUENTA Nº:: <?php  echo $res2["num_cuenta"];?></span></h1>
<br />
  <hr />
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">
		
				<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				
				<div id="message-blue">
				
				</div>
				
				<div id="message-green">
				
				</div>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">Monto </th>
                    <th class="">N Recibo</th>
                    <th class="">Fecha</th>
                     <th class="">Cliente</th>
                    <th class="">Num Reporte</th>
                     <th class="">Cobrador</th>
                  
                    
                      <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["monto"];?></td>
                    <td><?php echo $v["numrecibo"];?></td>
                   <td><?php echo $v["fecha"];?></td>
                    <td><?php echo $v["cliente"];?></td>
                     <td><?php echo $v["num_reporte"];?></td>
                      <td><?php echo $v["quiencobro"];?></td>
                   
                     
                                       
                    

					<td >
                 
                  
                 


 <img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=historialpagos&id=<?php echo $v["idpagos"];?>&e=borrar');"/></a>





             
				
  	
                  
                  
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<th class="">Monto</th>
                    <th class="">N Recibo</th>
                    <th class="">Fecha</th>
                     <th class="">Cliente</th>
                    <th class="">Num Reporte</th>
                     <th class="">Cobrador</th>
                   
                     
                      <th class="">Opciones</th>
				</tfoot>
                <tbody>
				</table>
				<!--  end product-table................................... --> 
				<?php } else {?>
           <h1><span style=" color:#F30;">NO EXISTEN PAGOS REGISTRADOS PARA ESTA CUENTA........</span><a href="<?php config::ruta();?>?accion=cuentas">Volver</a></h1>

                
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