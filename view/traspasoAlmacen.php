 <?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_almacenes"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
   
  <div class="miMenu" >
    <ul >
   
      <li > <B>REGISTRAR NUEVO TRASPASO</B><a href="<?php echo config::ruta();?>?accion=addTraspasoAlmacen"><img src="<?php echo config::ruta();?>images/iconos/add.png" /></a></li>
    </ul>
  </div>
  <h1>Traspasos Almacen > Listar </h1>
       
  <hr />
  </div>


<div id="table-content">

				<!--  start message-yellow -->
				
				<!--  end message-blue -->
			
				<!--  start message-green -->
				
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Acciones</th>
					<th class="">Nº Traspaso </th>
                   
                    <th class="">Fecha</th>
                    <th class="">Recibe</th>
                    <th class="">Envia</th>
                    <th class="">Estado</th>

                    
                   <th class="">Borrar</th>
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr  <?PHP  if ($v["estado"]=="ANULADO"){?> style="background-color:#CCC"<?PHP }?>>
                <td>				<img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verTraspasoAlmacen&id=<?php echo $v["idtraspaso_almacen"];?>');"/></a>
                 <?php if($v["estado"]=="SIN ENVIAR"){ ?>
                  
                 
<img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="enviarRuta('<?php echo config::ruta();?>?accion=addtraspasoAlmacen&id=<?php echo $v["idtraspaso_almacen"];?>&e=n','Se Procesara la nota de Traspaso <b class=resaltar>Numero:<?php echo $v["idtraspaso_almacen"];?></b>');"  width="35" height="35" alt="Enviar Nota" />

                  <a  href="<?php echo config::ruta();?>?accion=addtraspasoAlmacen&e=s&id=<?php echo $v["idtraspaso_almacen"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a>

                  
                  <?php }?>
                </td>
               
               <td><?php echo $v["idtraspaso_almacen"];?></td>
					
					<td><?php echo $v["fecha"];?></td>
                   
                    <td><?php echo utf8_decode($v["nombre_recibe"])?></td>
                    <td><?php echo utf8_decode($v["nombre_envia"])?></td>
                    <td><?php echo $v["estado"]?></td>
                   
                    	<td >
                       
                   <?php if($v["terminado"]==0 && $v["estado"]=="SIN ENVIAR"){?>
                <a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="anular('<?php echo config::ruta();?>?accion=traspasoAlmacen&e=anular&id=<?php echo $v["idtraspaso_almacen"];?>');"/></a>
				  
				  
				  <?php }?>
                  
                   <?php if($v["terminado"]==1 && $v["estado"]=="ENVIADO"){?>
                <a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=traspasoAlmacen&e=anular&id=<?php echo $v["idtraspaso_almacen"];?>','Esta seguro de anular la nota <b class=resaltar>Numero:<?php echo $v["idtraspaso_almacen"];?></b>');"/></a>
				  
				  
				  <?php }?>

					  <?php if(isset($_SESSION["modulo_administracion"])&& $v["estado"]=='ANULADO'){?> 
				   <img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=traspasoAlmacen&e=bt&it=<?php echo $v["idtraspaso_almacen"];?>','Esta seguro de eliminar la nota <b class=resaltar>Numero:<?php echo $v["idtraspaso_almacen"];?></b>');"/></a>
				
					<?php }?>
					

                
					
					</td>

					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				<th class="">Acciones</th>
						<th class="">Nº Traspaso </th>
                    <th class="">Fecha</th>
                    <th class="">Recibe</th>
                    <th class="">Envia</th>
                    <th class="">Estado</th>

                    
                   <th class="">Borrar</th>
                    
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