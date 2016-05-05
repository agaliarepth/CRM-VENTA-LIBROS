 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script type="text/javascript">
function enviar(){
	
	window.open("<?php echo config::ruta();?>?accion=crearCuenta");
	
	}
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  
 
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
					
					<th class="">N Cuenta</th>
                    <th class="">Cliente</th>
                    <th class="">Monto total</th>
                     <th class="">Saldo Inicial</th>
                    <th class="">Saldo Actual</th>
                     <th class="">Cobrador</th>
                      <th class="">Vendedor</th>
                      
                    
                      <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr  <?php if($v["estado"]=="ANULADO"){?> style="background-color:#ED8FA9;"<?php }?>>
					
					  
					<td><?php echo "c-".$v["num_cuenta"];?></td>
                    <td><?php echo $v["nombre_cliente"];?></td>
                   <td><?php echo $v["monto_total"];?></td>
                    <td><?php echo $v["saldo"];?></td>
                     <td><?php echo $v["saldo_actual"];?></td>
                      <td><?php echo $v["nombre_cobrador"];?></td>
                   <td><?php echo $v["nombre_vendedor"];?></td>
                
                               
                                       
                    

					<td  width="150">
                    <?php if($v["estado"]=="Sin Enviar"){?>
										<a><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" title="Borrar Contrato" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=cuentasNuevas&e=bc&ic=<?php echo $v["idcuentas"];?>');"/></a>

					      <a href="<?php echo config::ruta();?>?accion=crearCuenta&id=<?php echo $v["idcuentas"];?>&estado=editar"> <img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="Editar" title="editar"/></a>
                          
                          	<img src="<?php echo config::ruta();?>images/iconos/aprovar.png" width="30" height="30" onclick="crearCuenta('<?php echo config::ruta();?>?accion=cuentasNuevas&estado=aprobar&id=<?php echo $v["idcuentas"];?>','<?php echo $v["numcontrato"]?>','<?php echo $v["num_cuenta"]?>');" title="CrearCuenta"/></a>
				
				      
                        
                        
					    <img src="<?php echo config::ruta();?>images/iconos/search.png" width="25" height="25" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','800','500');"/></a>
					
					<?PHP } 
				}
					
					
				?>
                </tbody>
                <tfoot>
				<th class="">N Cuenta</th>
                    <th class="">Cliente</th>
                    <th class="">Monto total</th>
                     <th class="">Saldo Inicial</th>
                    <th class="">Saldo Actual</th>
                     <th class="">Cobrador</th>
                      <th class="">Vendedor</th>
                     
                    
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