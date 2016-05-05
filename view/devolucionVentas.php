 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">





<div id="table-content">
	 <form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1> DEVOLUCION DE OBRAS > LISTAR </h1>
  </td>
 <th><label for="mes">MES</label>
<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1 ) {?> selected="selected"<?php }?>>ENERO</option>
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
		
		 
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Nº </th>
                  
                    <th class="">Fecha</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Cliente</th>
                    <th class="">Cobrador</th>
                    <th class="">Vendedor</th>
                    <th class="">Tipo <br />Devolucion</th>

                    <th class="">Estado</th>
                    
                      <th >Opciones</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td><?php echo $v["iddevolucionObras"];?></td>
              
					
					<td><?php echo $v["fecha"];?></td>
                   
                    <td><?php echo $v["num_contrato"]?></td>
                    
                   <td><?php echo $v["cliente"]?></td>
                     <td><?php echo $v["cobrador"]?></td>
                    <td><?php echo $v["vendedor"]?></td>
                    <td><?php echo $v["tipo_devolucion"]?></td>
                    <?php if( $v["estado"]=="admin"){?> 
                      <td >En Administracion</td>
                   <?php }?>
                   <?php if( $v["estado"]=="enviado"){?> 
                      <td >En Almacen</td>
                   <?php }?>
                    <?php if( $v["estado"]=="sin enviar"){?> 
                      <td >Sin Enviar</td>
                   <?php }?>
                   <?php if( $v["estado"]=="aprobado"){?> 
                      <td >Aprovado</td>
                   <?php }?>
                    	<td >
                          <?php if($v["estado"]=="sin enviar"){?>
                        <a ><img src="<?php echo config::ruta();?>images/iconos/download.png" width="35" height="35" alt="Enviar a Almacen" title="Enviar a Almacen" onclick="enviarRuta('<?php echo config::ruta();?>?accion=devolucionVentas&id=<?php echo $v["iddevolucionObras"];?>&e=ae','Se enviara la nota a almacen.?');" /></a>  
     <!-- <a  href="<?php echo config::ruta();?>?accion=anularDiferido&id=<?php echo $v["iddevolucionObras"];?>&e=editar"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a>-->
	  
	 
                       
					
                      <a ><img src="<?php echo config::ruta();?>images/iconos/devolucion.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucionObras&id=<?php echo $v["iddevolucionObras"];?>');"/></a>  
                      <a href="###"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" title="Borrar Devolucion" height="35" onclick="enviarRuta('<?php echo config::ruta();?>?accion=devolucionVentas&e=bc&id=<?php echo $v["iddevolucionObras"];?>','Realmente desea eliminar esta nota?');"/></a>
                    
                    	<?php }else{?>
                        
                                              <a ><img src="<?php echo config::ruta();?>images/iconos/devolucion.png" width="35" height="35" alt="Ver Nota Devolucion" title="Ver Nota Devolucion" onclick="imprimir('<?php echo config::ruta();?>?accion=verDevolucionObras&id=<?php echo $v["iddevolucionObras"];?>');"/></a>  
<?php }?>
					
					
					
				
					
					</td>

					
				</tr><?php
				}
				?>
               
                </tbody>
                <tfoot>
				<tr>
					<th class="">Nº </th>
                  
                    <th class="">Fecha</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Cliente</th>
                    <th class="">Cobrador</th>
                    <th class="">Vendedor</th>
                    <th class="">tipo <br />Devolucion</th>
                     <th class="">Estado</th>
                    
                      <th >Opciones</th>
                  
                  
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