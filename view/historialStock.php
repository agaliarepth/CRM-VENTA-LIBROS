 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script language="javascript" type="text/javascript">
    
    </script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  
  <div class="" style="border: solid 1px #999; margin-bottom:20px;">
  
     
  </div>
  <h1>HISTORIAL STOCK </h1>
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
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="69%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					  <th width="14%" class="">Acciones</th>
					<th width="36%" class="">ALMACEN</th>
                    
                    <th width="50%" class="">FECHA</th>
                   
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>
                <a href=""><img src="<?php echo config::ruta();?>images/iconos/search.png" width="35" height="35"  title="Ver Stock" onclick="popup('<?php echo config::ruta();?>?accion=verHistorialStock&id=<?php echo $v["idstock"];?>','800','500');"/></a>
                
                <a><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" title="Borrar Contrato" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=historialStock&id=<?php echo $v["idstock"];?>');"/></a
                
                </td>
                <td> <?php  $res2=$al->getId($v["almacen"]);echo$res2["descripcion"];?></td>
                <td> <?php echo $v["fecha"];?></td>
				</tr>
				<?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
                  <th class="">Acciones</th>
					<th class="">ALMACEN</th>
                    
                    <th class="">FECHA</th>
                  
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