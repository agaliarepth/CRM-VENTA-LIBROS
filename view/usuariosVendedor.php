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
      
      <li ><a href="<?php echo config::ruta();?>?accion=addUsuarioVendedor"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
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
					
				
                    <th class="">Codigo</th>
                    <th class="">Nombre Apellido</th>
                    <th class="">carnet</th>
                    <th class="">Telefono</th>
                     <th class="">Email</th>
                      <th class="">direccion</th>
                        <th class="">Estatus</th>
                    <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					  <td><?php echo $v["codigo"]; ?></td>
				
                    <td><?php echo $v["nombres"]; echo " ".$v["apellidos"]; ?></td>
                   <td><?php echo $v["carnet"];?></td>
                    <td><?php echo $v["telefono"];?></td>
                     <td><?php echo $v["email"];?></td>
                      <td><?php echo $v["direccion"];?></td>
                       <td><?php echo $v["estatus"];?></td>
               
                   
                    

					<td class="options-width">
                    <?php if($v["estatus"]=="Pasivo"){ ?> 
					<a href="<?php echo config::ruta();?>?accion=addUsuarioVendedor&id=<?php echo $v["idVendedores"];?>" title="Nuevo Usuario" ><img  width="25" height="25" src="<?php echo config::ruta();?>images/iconos/user.png" /></a>
					<?php }?>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
			
                   <th class="">Codigo</th>
                    <th class="">Nombre Apellido</th>
                    <th class="">carnet</th>
                    <th class="">Telefono</th>
                     <th class="">Email</th>
                      <th class="">direccion</th>
                        <th class="">Estatus</th>
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