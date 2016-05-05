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
      
      <li ><a href="<?php echo config::ruta();?>?accion=addUsuario"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
 
  <h1>Usuarios</h1>
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
                    <th class="">Nombres</th>
                    <th class="">Nombre Usuario</th>
                     <th class="">Contraseña</th>
                    <th class="">Rol de Usuario</th>
                     <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idusuarios"];?></td>
                    <td><?php echo $v["nombres"];?></td>
                   <td><?php echo $v["username"];?></td>
                    <td><?php echo $v["password"];?></td>
                    <td><?php $des=$p->getDescripcion($v["perfiles_idperfiles"]);echo $des["descrip"];?></td>
                   
                    

					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=editUsuario&e=eu&iu=<?php echo $v["idusuarios"];?>" title="Editar"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="30" height="30" /></a>
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=usuarios&e=bu&iu=<?php echo $v["idusuarios"];?>');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" /></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<th class="">ID </th>
                    <th class="">Nombres</th>
                    <th class="">Nombre Usuario</th>
                     <th class="">Contraseña</th>
                    <th class="">Rol de Usuario</th>
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