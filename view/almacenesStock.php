<?php require_once("head.php");?>

<?php if(isset($_SESSION["modulo_almacenes"])){?>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    
  
  <h1>EDITAR STOCK   </h1>
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
                
				
				<table border="0"  cellpadding="0" cellspacing="0" id="categorias-table" style="font-size:9px;">
                <thead>
				<tr>
					
                    <th class="">Codigo</th>
                 
                    <th  width="250" class="">Titulo</th>
                    <th class="">Tomo</th>
                  
                    <th class="">Stock </th>
                  
                     <th class="">Stock Reservado</th>
                      <th class="">Stock disponible</th>
                  
                   	<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $r){
					$v=$li->getId($r["libros_idlibros"]);
				?><tr>
					
					
				
                    <td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                   
                    <td><?php echo $v["titulo"]?></td>
                    <td><?php echo $v["tomo"]?></td>
                   
                  
                
                      <td ><?php echo $r["stock"]?></td>
                    <td ><?php echo $r["stock_reservado"]?></td>
                    <td ><?php echo $r["stock_disponible"]?></td>
          
                      

					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=editStock&il=<?php echo $v["idlibros"];?>&ia=<?php echo $r["almacenes_idalmacenes"];?>" title="Editar" class="icon-1 info-tooltip"></a>
					
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					 <th class="">Codigo</th>
                 
                    <th  width="250" class="">Titulo</th>
                    <th class="">Tomo</th>
                  
                    <th class="">Stock </th>
                  
                     <th class="">Stock Reservado</th>
                      <th class="">Stock disponible</th>
                  
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