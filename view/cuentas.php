 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script type="text/javascript">



			$(document).ready(function(){
 $(".botonExcel").click(function(event) {


     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
             $("#filtro").change(function(){

             if($(this).val()=="MES"){ $("#filtroAnio").css("display","inline-table");$("#filtroMes").css("display","inline-table");$("#filtroFechaAcumulado").css("display","none");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");}
             if($(this).val()=="RANGO"){$("#filtroAnio").css("display","none");$("#filtroFechaInicio").css("display","inline-table"); $("#filtroFechaAcumulado").css("display","none"); $("#filtroFechaFin").css("display","inline-table"); $("#filtroMes").css("display","none");}
             if($(this).val()=="ACUMULADO"){$("#filtroAnio").css("display","none");$("#filtroFechaAcumulado").css("display","inline-table");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");$("#filtroMes").css("display","none");}


             });

			});


function enviar(){
	
	window.open("<?php echo config::ruta();?>?accion=crearCuenta");
	
	}
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  
  </div>
 

 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
  <td>  
  <form action="" method="POST">
  <table>
      <tr><td><label for="numcuenta">BUSCAR CUENTA</label><input type="text" name="numcuenta"></td>
<td><input type="submit" name="buscarCuenta" value="Buscar Cuenta" ></td>
      </tr>
    </table>
    </form>
</td>
 
<form method="post" action="">

  <th>

  <label for="filtro">FILTRO POR :</label>
  <select name="filtro" id="filtro" class="inp-form">
  <option value="MES">POR MES</option>
  <option value="RANGO">RANGO DE FECHAS</option>
  <option value="ACUMULADO">ACUMULADO </option>

</select>
</th>
<th id="filtroMes" >
 <label for="mes">MES</label>

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
</select>
</th>



<th id="filtroFechaInicio"  style="display:none">

 <label for="fechainicio">FECHA INICIO</label>
<input type="text" class="fechas" id="fecha" name="fechainicio" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroFechaFin" style="display:none" >
<label for="fechafin"  >FECHA FIN</label>
<input type="text" class="fechas" id="fecha2" name="fechafin" value="<?php echo date("Y-m-d")?>">
</th>


<th id="filtroFechaAcumulado"  style="display:none">

 <label for="fechaacumulado"> HASTA:</label>
<input type="text" class="fechas" id="fecha3" name="fechaacumulado" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroAnio"><label for="anio">AÑO </label><select name="anio" class="inp2-form">
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


<div id="table-content">
		
			<div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteCuentasMes" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
</form>
</div>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="" >N Cuenta</th>
                    <th class="">Vendedor</th>
                    <th class="">Cliente</th>
                    <th class="">Fecha de <br>Venta</th>
                    <th class="">Precio de <br>Venta</th>
                    <th class="">Saldo<br> Inicial</th>

                    <th class="">F.U.P</th>
                    <th class="">Cuota a <br> Cobrar</th>
                    <th class="">Cobrador</th>
                    <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr  <?php if($v["estadocredito"]=="ANULADO"){?> style="background-color:#ED8FA9;"<?php }?>>
					
					  
					<td style="font-weight: bold;"><?php echo "c-".$v["numcuenta"];?></td>
                    <td><?php echo $ven->getNombresVendedor($v['idvendedor']);?></td>
                    <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"];?></td>
                   <td><?php echo $v["fechadoc"];?></td>
                    <td><?php echo $v["preciototal"];?></td>
                    <td><?php echo $v["saldo"];?></td>

                    <td><?php echo $v["fechadoc"];?></td>
                    <td><?php echo $v["montocuotas"];?></td>
                    <td><?php echo $cobra->getNombresCobrador($v["idcobrador"]);?></td>
                     
                                       
                    

					<td  width="150">
                    <?php if($v["estadocredito"]=="ANULADO"){?>
					  <a href=""><img src="<?php echo config::ruta();?>images/iconos/contrato.png" width="25" height="25" alt="Ver Tarjeta Cobranza" title="Ver Tarjeta Cobranza"  onclick="window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id=<?php echo $v["idcredito"];?>', this.target, 'width=700,height=650');"/></a>
					    
				
				        <a href=""><img src="<?php echo config::ruta();?>images/iconos/info.png" width="25" height="25"  title="Ver Pagos de Cuenta" onclick="popup('<?php echo config::ruta();?>?accion=verCuenta&id=<?php echo $v["idcuentas"];?>','800','500');"/></a>
					    <img src="<?php echo config::ruta();?>images/iconos/search.png" width="25" height="25" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','800','500');"/></a>
					
					<?PHP } else{?>

					 <a  href="<?php echo config::ruta();?>?accion=editCuenta&id=<?php echo $v["idcredito"];?>"><img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="25" height="25"  alt="Editar Cuenta" title="Editar Cuenta"  /></a>
                         <a href="###"><img src="<?php echo config::ruta();?>images/iconos/contrato.png" width="25" height="25" alt="Editar" title="Ver Tarjeta Cobranza"  onclick="window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id=<?php echo $v["idcredito"];?>', this.target, 'width=700,height=650');"/></a>
					    

				
				        <a href="###"><img src="<?php echo config::ruta();?>images/iconos/info.png" width="25" height="25"  title="Ver Pagos de Cuenta" onclick="popup('<?php echo config::ruta();?>?accion=verCuenta&id=<?php echo $v["idcredito"];?>','800','500');"/></a>
                                           
           <img src="<?php echo config::ruta();?>images/iconos/search.png" width="25" height="25" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
<?php }?>

					</td>
				</tr><?php
				}
				?>
                </tbody>

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