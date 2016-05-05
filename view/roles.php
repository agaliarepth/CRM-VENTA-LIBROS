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
      
      <li ><a href="<?php echo config::ruta();?>?accion=addPerfil"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
 
  <h1>Roles de Usuario </h1>
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
					
					<th class="">ID </th>
                    <th class="">Descripcion</th>
                    	                      
					
					
					<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idperfiles"];?></td>
                    <td><?php echo $v["descrip"];?></td>
                   
                    

					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=editPerfil&e=ep&ip=<?php echo $v["idperfiles"];?>" title="Editar" class="icon-1 info-tooltip"></a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=roles&e=bp&ip=<?php echo $v["idperfiles"];?>');"></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<<th class="">ID </th>
                    <th class="">Descripcion</th>
                    	
                        
					
					
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