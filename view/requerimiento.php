 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
		<script language="javascript">
$(document).ready(function() {

	 $('#requerimiento-table').dataTable( {
		  
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
		
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
	
	
    
});
</script>


<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="" style="border: solid 1px #999; margin-bottom:5px;">
    
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=addRequerimiento" class="detalleContrato">
    <table>
    <tr>  
       
       <td>
      <B>LISTA DE ALMACENES </B>
      </td>
      <TD>
       <select  class="styledselect_form_1" name="almacenes">
        <?php foreach($res3 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
			
		</select>
        </td>
        <td>
        <input type="submit"   style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" value="Nueva Nota de Requerimiento"/></td>
        </tr>
        </table>
        </form>
  </div>
 
  
<form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1>Requerimiento Mercaderia   <b>: <?php echo date("M-Y")?></b> > Listar  </h1>
  </td>
 <th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1) {?> selected="selected"<?php }?>>ENERO</option>
<option value="2"  <?php if(date("m")==2) {?> selected="selected"<?php }?>>FEBRERO</option>
<option value="3" <?php if(date("m")==3) {?> selected="selected"<?php }?>>MARZO</option>
<option value="4" <?php if(date("m")==4) {?> selected="selected"<?php }?>>ABRIL</option>
<option value="5" <?php if(date("m")==5) {?> selected="selected"<?php }?>>MAYO</option>
<option value="6" <?php if(date("m")==6) {?> selected="selected"<?php }?>>JUNIO</option>
<option value="7" <?php if(date("m")==7) {?> selected="selected"<?php }?>>JULIO</option>
<option value="8" <?php if(date("m")==8) {?> selected="selected"<?php }?>>AGOSTO</option>
<option value="9" <?php if(date("m")==9) {?> selected="selected"<?php }?>>SEPTIEMBRE</option>
<option value="10" <?php if(date("m")==10) {?> selected="selected"<?php }?>>OCTUBRE</option>
<option value="11" <?php if(date("m")==11) {?> selected="selected"<?php }?>>NOVIEMBRE</option>
<option value="12" <?php if(date("m")==12) {?> selected="selected"<?php }?>>DICIEMBRE</option>



</select></th>
<th><label for="anio">AÑO </label><select name="anio" class="inp2-form">
<option value="2013"   <?php if(date("Y")==2013) {?> selected="selected"<?php }?>>2013</option>
<option value="2014"   <?php if(date("Y")==2014) {?> selected="selected"<?php }?>>2014</option>
<option value="2015"   <?php if(date("Y")==2015) {?> selected="selected"<?php }?>>2015</option>
<option value="2016"   <?php if(date("Y")==2016) {?> selected="selected"<?php }?>>2016</option>
<option value="2017"   <?php if(date("Y")==2017) {?> selected="selected"<?php }?>>2017</option>
<option value="2018"   <?php if(date("Y")==2018) {?> selected="selected"<?php }?>>2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>



</select>

</th>
 <td>
            
              
                
                <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar" /></td>
                <td>
  </tr>
  </table>
  <input type="hidden"  name="consulta" value="consulta" />
  </form>
  <hr />
  </div>


<div id="table-content">
<?php 

if(isset($_GET["m"])){
	
	switch($_GET["m"]){
		case '1': break;
		case '1': break;
		case '3':{ ?>
        <div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Se intento eliminar una Categoria en forma Erronea....</td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		}
	
	}


?>			
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
                
				
				<table border="0" width="100%" cellspacing="0" id="requerimiento-table">
                <thead>
				<tr>
					 <th width="15%" class="">Acciones</th>
					
                    <th width="9%" class="">Num</br> Requerimiento</th>
                    <th width="9%" class="">Fecha</th>
                    <th width="27%" class="">Vendedor</th>
                    <th width="12%" class="">Almacen </th>

                    <th width="24%" class="">Estado</th>
                   <th width="15%" class="">Borrar</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr<?PHP  if ($v["estado"]=="ANULADO"){?> style="background-color:#CCC"<?PHP }?>>
                <td>
				<?php if( $v["estado"]=="SIN REMITIR" && $v["terminado"]==1){?>
					<a href="<?php echo config::ruta();?>?accion=addNotasRemision&id=<?php echo $v["idnota_pedido"];?>"><img src="<?php echo config::ruta();?>images/iconos/refresh.png" alt="Hacer Remision" width="35" height="35" class="buscar" title="Hacer Remision" /></a><?php } ?>
                    
                    <?php if($v["terminado"]==0 && $v["estado"]=="SIN REMITIR"){?>
                 
				 <a href="#"> <img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="enviarRuta('<?php echo config::ruta();?>?accion=addRequerimiento&id=<?php echo $v["idnota_pedido"];?>&e=enviar','Se guardara la nota de Requerimiento.?');"  width="35" height="35" alt="Enviar Nota" /></a>
 <a  href="<?php echo config::ruta();?>?accion=addRequerimiento&e=s&id=<?php echo $v["idnota_pedido"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a>
				  
				  <?php }?>
                    
 
					
				<img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verRequerimiento&id=<?php echo $v["idnota_pedido"];?>');"/></a>
                </td>
                
                				
					<td align="center"><?php echo $v["idnota_pedido"];?></td>
                    
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["nombre_vendedor"]?></td>
                     <td><?php echo $v["desc_almacen"]?></td>

                    <td<?php if( $v["estado"]=="REMITIDO"){?>  class="bannerRojo"<?php }  ?>><?php echo $v["estado"]?></td>
                    	<td >
                      <?php if( $v["terminado"]==0){  ?>
                	 <?php if($v["terminado"]==0 && $v["estado"]=="SIN REMITIR"){?>
                 
				 <a><img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="30" height="30" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasRequerimiento&e=anular&id=<?php echo $v["idnota_pedido"];?>','Desea anular esta nota.?');"/></a>
				  
				  <?php }?>
              
                <?php }?>
					<?php if(isset($_SESSION["modulo_almacenes"])&&$v["terminado"]==1){?> 
					
					 <a><img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="30" height="30" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasRequerimiento&e=anular&id=<?php echo $v["idnota_pedido"];?>','Desea anular esta nota.?');"/></a>
                     
					
					
					<?php }?>
                    <?php if(isset($_SESSION["modulo_almacenes"])&&$v["terminado"]==1 && $v["estado"]=='ANULADO'){?> 
					
					  <a href="###"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasRequerimiento&ia=<?php echo $v["idalmacenes"];?>&e=br&sw=<?php echo $v["estado"];?>&ir=<?php echo $v["idnota_pedido"];?>','Desea eliminar este registro.');"/></a>
					
					
				
                    
					<?php }?>
                    
                    </td>

					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					 <th width="15%" class="">Acciones</th>
					
                    <th width="9%" class="">Num</br> Requerimiento</th>
                    <th width="9%" class="">Fecha</th>
                    <th width="27%" class="">Vendedor</th>
                    <th width="12%" class="">Almacen </th>

                    <th width="24%" class="">Estado</th>
                   <th width="15%" class="">Borrar</th>
				
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