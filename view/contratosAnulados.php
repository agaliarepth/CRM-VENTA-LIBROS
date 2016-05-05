 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
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
  </script>





<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">

      <hr />
<form method="post" action="">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  WIDTH="">
  <h1>Contratos Anulados  > Listar  </h1>
  </td>
  <th>

  <label for="filtro">FILTRO POR :</label>
  <select name="filtro" id="filtro" class="inp-form">
  <option value="MES">POR MES</option>
  <option value="RANGO">RANGO DE FECHAS</option>
  <option value="ACUMULADO">ACUMULADO </option>

</select>
</th>
<th id="filtroMes">
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

 <label for="fechaacumulado">TODOS HASTA:</label>
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
  <input type="hidden"  name="contratos" value="contratos" />
  </form>
  <hr />
   <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteContratosAnulados" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
</form>
</div>
  </div>



<div id="table-content">

                
				
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Nº </th>
                  
                    <th class="">Fecha Contrato</th>
                    <th class="">Num Contrato</th>
                
                    <th class="">Monto Contrato</th>
                   
                    <th class="">Vendedor</th>
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
					$credito=$cred->getPorContrato($v["idcontratos"]);
				?><tr>
                <td><?php echo $cont++;?></td>
              
					
					<td><?php echo $v["fechacontrato"];?></td>
                   
                    <td><?php echo $v["numcontrato"]?></td>
                    
                   <td><?php echo $v["preciototal"]?></td>
            
                    <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]);?></td>
                   
                    <td><?php echo $v["nombres"]?></td>
                    <td><?php echo $v["apellidopaterno"]?></td>
                    <td><?php echo $v["apellidomaterno"]?></td>
                    	<td >
                        
                      
                        <?php if($v["terminado"]==1){?>
                      
                           <a href="###"><img src="<?php echo config::ruta();?>images/iconos/search.png" width="35" height="35"  title="Ver Contrato" onclick="popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontratos"];?>','800','500');"/></a>
                            <a href="<?php echo config::ruta();?>?accion=verFilasKardex&id=<?php echo $v["numcontrato"];?>&tipo=contrato" target="_blank"><img src="<?php echo config::ruta();?>images/iconos/searchkardex.png" width="20" height="20" /></a>

                        <?php }else{?>
                    
                    	  <img src="<?php echo config::ruta();?>images/iconos/download.png" onclick="enviarContrato('<?php echo config::ruta();?>?accion=addContrato&id=<?php echo $v["idcontrato"];?>&e=n');"  width="35" height="35" alt="Confirmar Contrato"  title="confirmar Contrato"/>
                        
                       <a href="<?php echo config::ruta();?>?accion=editContrato&id=<?php echo $v["idcontrato"];?>"> <img src="<?php echo config::ruta();?>images/iconos/editar.jpg" width="35" height="35"  alt="Editar" title="editar"/></a>
					
					<a><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="35" title="Borrar Contrato" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=contratos&e=bc&ic=<?php echo $v["idcontratos"];?>');"/></a>
					
				<?php }?>
					
					</td>

					
				</tr><?php
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