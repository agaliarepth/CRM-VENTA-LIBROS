 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/tinybox.js" type="text/javascript"></script>


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
  
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=addEgreso">
  <table><tr>
  <td>  
    
       <h4 style=" float:left; font-weight:bold;">LISTA DE ALMACENES:</h4></td>
       <td>
       <select  class="styledselect_form_1" name="almacenes">
        <?php foreach($res3 as $row){?>
			  <option value="<?php echo $row["idalmacenes"]."/".$row["descripcion"];?>"> <?php echo $row["descripcion"];?></option><?php }?>
			
		</select></td>
        <td>
        
        <input  style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"type="submit"  value="Nueva Nota de Egreso " /></td>
        </tr>
        </table>
        </form>
  </div>
  <form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1>NOTAS DE EGRRESO > LISTAR  </h1>
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


		
				<!--  start message-yellow -->
				<div id="message-yellow">
				
				</div>
				
				<div id="message-blue">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
				  <td class="blue-left" ><a href="<?php echo config::ruta();?>?accion=reporteEgreso" >Relacion Notas Egreso</a> </td>
                
					
				</tr>
                
				</div>
				
				<div id="message-green">
				
				</div>
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					  <th class="">Acciones</th>
					<th class="">Nº Egreso</th>
                    
                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Destino</th>
                   <th class="">Almacen</th>
                   <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr  <?PHP  if ($v["estado"]=="ANULADO"){?> style="background-color:#CCC"<?PHP }?>>
                <td>  <?php if($v["estado"]=="Sin Enviar"){ ?>
                  
                 
<img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="enviarRuta('<?php echo config::ruta();?>?accion=addEgreso&id=<?php echo $v["idegreso"];?>&e=n','Se procesara la nota de egreso <b class=resaltar>Numero:<?php echo $v["idegreso"];?>.</b> Desea continuar.?');"  width="35" height="35" alt="Enviar Nota" />
  	
                  
                  <?php }?>
                  <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=addEgreso&e=s&id=<?php echo $v["idegreso"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="editar"  /></a><?php }?>
                  
                  
 
 
  	<img src="<?php echo config::ruta();?>images/iconos/imprimir.jpg" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verEgreso&id=<?php echo $v["idegreso"];?>');"/></a></td>
               
                				
					<td><?php echo $v["idegreso"];?></td>
                    
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["envia"]?></td>
                    <td><?php echo $v["recibe"]?></td>
                    <td><?php echo $v["destino"]?></td>
                    <td><?php echo $v["nombre_almacen"]?></td>
                       <td><?php echo $v["estado"]?></td>
                  <td>
				  
				    <?php if(isset($_SESSION["modulo_almacenes"])&& $v["estado"]=='ANULADO'){?> 
				  <a ><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasEgreso&e=bi&sw=<?php echo $v["estado"];?>&ii=<?php echo $v["idegreso"];?>','Esta seguro de eliminar la nota <b class=resaltar>Numero:<?php echo $v["idegreso"];?></b>');"/></a>
				
					<?php }?>
					
					
				 <?php if($v["estado"]=="Enviado"){?>
				<a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasEgreso&e=anular&id=<?php echo $v["idegreso"];?>','Esta seguro de anular la nota <b class=resaltar>Numero:<?php echo $v["idegreso"];?></b>');"/></a>
				
					<?php }?>
			<?php if($v["estado"]=="Sin Enviar"){ ?>
                  
                 
	<a> <img src="<?php echo config::ruta();?>images/iconos/nulo.gif" width="35" height="35" onclick="eliminarRegistro('<?php echo config::ruta();?>?accion=notasEgreso&e=anular&id=<?php echo $v["idegreso"];?>','Esta seguro de anular la nota <b class=resaltar>Numero:<?php echo $v["idegreso"];?></b>');"/></a>
  	
                  
                  <?php }?>
                  </td>
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
                   <th class="">Acciones</th>
				<th class="">Nº Egreso</th>
                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Destino</th>
                   <th class="">Almacen</th>
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