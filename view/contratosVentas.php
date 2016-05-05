 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<script type="text/javascript">
	
	  
	  
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
   
 
  <form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  width="90%">
  <h1>Contratos Ventas  > Listar  </h1>
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
  <input type="hidden"  name="contratos" value="contratos" />
  </form>
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
                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">Nº </th>
                  <th class="">Fecha Facturado</th>
                    <th class="">Fecha Contrato</th>
                     
                    <th>Tipo Venta</th>
                     <th class="">Num Contrato</th>
                    <th class="">Num Cuenta</th>
                    <th class="">Num Reporte</th>
                    <th class="">Monto Contrato</th>
                    <th class="">Cuota Inicial</th>
                    <th class="">Saldo</th>
                    <th class="">Num Pagos</th>
                    <th class="">Vendedor</th>
                    <th class="">Chofer</th>
                    <th class="">Cobrador</th>
                    <th class="">Nombre Cliente</th>
                   <th class="">A. Paterno cliente</th>
                   <th class="">A. materno Cliente</th>
                    <th class="">Opciones</th>
                    
                    
				</tr>
				</thead>
                <tbody>
                 <?php 
				$cont=1;
				foreach($res as $v){
					
					if($v["tipoventa"]=="CREDITO"){
						$cred=$credito->getPorContrato($v["idcontratos"]);
				?><tr>
                <td><?php echo $cont++;?></td>
              
					<td><?php echo $cred["fechadoc"];?></td>
					<td><?php echo $v["fechacontrato"];?></td>
                    
                    <td><?php echo $v["tipoventa"];?></td>
                   <td><?php echo $v["numcontrato"];?></td>
                    <td><?php echo $cred["numcuenta"]?></td>
                    <td><?php echo $cred["numreporte"]?></td>
                   <td><?php echo $v["preciototal"]?></td>
                     <td><?php echo $cred["cuotainicial"]?></td>
                    <td><?php echo $cred["saldo"]?></td>
                    <td><?php echo $cred["numcuotas"];?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]);?></td>
                      <td><?php echo $vendedor->getNombresVendedor($v["idchofer"]);?></td>
                    <td><?php echo $cobrador->getNombresCobrador($cred["idcobrador"]);?></td>
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                  
                     
                    	<td >
		                         <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["numcontrato"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="20" height="20" /></a>

                    
                    	<img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
                        
                        


                      
					</td>

					
				</tr><?php
				
					}// FIN DE IF
					if($v["tipoventa"]=="CONTADO"){
					$cred=$credito->getPorContrato($v["idcontratos"]);
				?><tr>
                <td><?php echo $cont++;?></td>
              
										<td><?php echo $v["fechadoc"];?></td>

					<td><?php echo $v["fechacontrato"];?></td>
                    <td><?php echo $v["tipoventa"];?></td>
                   <td><?php echo $v["numcontrato"];?></td>
                    <td><?php echo $cred["numcuenta"]?></td>
                    <td><?php echo $cred["numreporte"]?></td>
                   <td><?php echo $v["preciototal"]?></td>
                     <td><?php echo $cred["cuotainicial"]?></td>
                   <td><?php echo $cred["saldo"]?></td>
                    <td><?php echo $cred["numcuotas"];?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]);?></td>
                    <td><?php echo $vendedor->getNombresVendedor($v["idchofer"]);?></td>
                    <td>-----</td>
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                  
                     
                    	<td >
		                         <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["numcontrato"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="20" height="20" /></a>

                    
                    	<img src="<?php echo config::ruta();?>images/iconos/search.png" width="20" height="20" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
                        
                        


                      
					</td>

					
				</tr>
				<?PHP }
				}
				?>
               
                </tbody>
                <tfoot>
				
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