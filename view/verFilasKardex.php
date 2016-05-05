 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 


<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexVendedor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});

 $('#kardexVendedor-table').dataTable( {
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
		"aaSorting": [ [3,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );

});
</script>

<script type="text/javascript">

	
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre_vendedor").autocomplete({
				source: "ajax/searchVendedores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{
			
			$( "#nombre_vendedor" ).val( ui.item.label );
			$( "#ci_vendedor" ).val( ui.item.valor);
			$( "#id_vendedor" ).val( ui.item.idVendedor );
			
		
			
			return false;
			
		}
		
	  



	

	
	
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
   
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reporteKardexVendedor" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="promotor" name="promotor" <?php if(isset($_POST["nombre_vendedor"])){?>value="<?php  echo $_POST["nombre_vendedor"];?>"<?php }?> />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
  <h1>Kardex Vendedor > <?php echo strtoupper($_GET["tipo"]); ?> NUM> <?php  echo $_GET["id"];?> </h1>
  </div>
<div class="clear">&nbsp;</div>


<div id="table-content">


				<table   border="1" id="kardexVendedor-table" cellpadding="0" cellspacing="0" class="kardex"  >
           
             
				
				<thead style="background-color:#999; font-size:9px;">
				  <th >N&deg;</th>
				  <th>FECHA</th>
				  <th  class="">Num<br />REMI</th>
				  <th >CODIGO</th>
				  <th align="center">TITULO</th>
				  <th class="" >DEBE</th>
				  <th  colspan="2" class="" align="center">HABER</th>
				  <th class="">NOMBRES Y APELLIDOS</th>
				  <th  class="">DEV No</th>
				  <th class="">FECHA<br /> DEVOL.</th>
				  <th  class="">No DE<br/> CTTO.</th>
				  <th  class="">REG. <br /> VENTAS</th>
                  <th  class="">Estado</th>
                  <th>VENDEDOR</th>
                  <!--<th>Borrar</th>-->
				  </thead>
                  <tbody>
                 
                  
				<?php $cont=1; $contRemis=0; $contov=0; $contdev=0; $contdif=0; $contcubie=0; $sumasIguales=0;
				foreach($res as $v){
					
				?>
                <?php if($v["estado_libro"]=="Devuelto"){ $contdev++; $contRemis++;?>
               <?php if ($v["cargo"]==1){?><tr align="center" style="background-color:#FC8F93;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                 
				<td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center">1</td>
                
                
                <td width="23" align="center" >1</td>
                
                
                <td align="center" ></td>
				<td align="center"></td>
                <td align="center"><?php if($v["num_devolucion"]!="0"){?><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["num_devolucion"];?>','500');" rel="nofollow"><?php echo $v["num_devolucion"]; ?></a><?php } ?></td>
                
                <td ><?php if($v["num_devolucion"]!="0") echo $v["fecha_devolucion"]; ?></td>
                <td></td>
                <td></td>
                <td>DEVOLUCION</td>
                <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
                
				</tr>
				
				<?php }
				 if($v["estado_libro"]=="DevueltoObras"){ $contdev++; $contRemis++;?>
				
               <?php if ($v["cargo"]==1){?><tr align="center" style="background-color:#FC8F93;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                <td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center">1</td>
                
                
                <td width="23" align="center" >1</td>
                
                
                <td align="center" >1</td>
				<td align="center"><?php echo $v["nombres_cliente"];?> </td>
                <td align="center"><?php if($v["num_devolucion"]!="0"){?><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verDevolucion&id=<?php echo $v["num_devolucion"];?>','500');" rel="nofollow"><?php echo $v["num_devolucion"]; ?></a><?php } ?></td>
                
                <td ><?php if($v["num_devolucion"]!="0") echo $v["fecha_devolucion"]; ?></td>
                <td><a   style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','500');" rel="nofollow"><?php echo $v["num_contrato"]; ?></a></td>
                <td></td>
                <td>DEV-VENTA</td>
                 <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
				</tr>
				
				<?php }
				
				
				if($v["estado_libro"]=="Diferido"){ $contdif++; $contRemis++;?>
				
               <?php if ($v["cargo"]==1){?><tr align="center" style="background-color:#FC8F93;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                <td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center"  >1</td>
                
                
                <td ></td>
                
                 <td width="30" align="center" >1</td>
                <td align="left"  ><?php echo $v["nombres_cliente"];?>  </td>
				<td align="center"></td>
                <td align="center"></td>
                
                 <td style=""><a   style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','500');" rel="nofollow"><?php echo $v["num_contrato"]; ?></a></td>
                <td></td>
                
                <td>DIFERIDO</td>
                 <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
				</tr>
				
				<?php }
				 if($v["estado_libro"]=="Remitido"){  $contRemis++;?>
               <?php if ($v["cargo"]==1){?><tr align="center" style="background-color:#FC8F93;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                <td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center">1</td>
                
                
                <td width="23" align="center" ></td>
                
                <td align="center" ></td>
				
                <td align="center"></td>
                <td align="center"></td>
                <td> </td>
                <td></td>
                <td></td>
                <td><?php if ($v["cargo"]==1){ ?>CARGO <?php } else {?>REMITIDO<?PHP }?> </td>
              <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
				</tr>
                <?php 
				
				} 
				if($v["estado_libro"]=="Venta"){ $contov++; $contRemis++;?>
				
               <?php if ($v["cargo"]==1){?><tr align="center" style="background-color:#FC8F93;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                <td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center"  >1</td>
                
                
                <td ></td>
                
                
                 <td width="30" align="center" s>1</td>
                <td align="left"  ><?php echo $v["nombres_cliente"];?>  </td>
				<td align="center"></td>
                <td align="center"></td>
                
                <td style=""><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','500');" rel="nofollow"><?php echo $v["num_contrato"]; ?></a></td>
                <td><?php echo $v["reg_ventas"]; ?></td>
                
                <td>OK</td>
                 <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
				</tr>
				
				<?php
				 
				 }
				 
				 
				 if($v["estado_libro"]=="Traspaso"){$contRemis++; ?>
				
               <?php if ($v["cargo"]==10){?><tr align="center" style="background-color:#93E69D;"><?php }?>
                     <?php if ($v["cargo"]==2){?><tr align="center" style="background-color:#CCC;"><?php }?>
                      <?php if ($v["cargo"]==0){?><tr align="center" style=""><?php }?>
                <td><b><?php echo $v["idkardexvendedor"];$cont++;?></b></td>
                
                <td><?php echo $v["fecha_remision"]; ?></td>
                
                <td align="center"><a  style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verRemision&id=<?php echo $v["num_remision"];?>','500');" rel="nofollow"><?php echo $v["num_remision"]; ?></a></td>
                
                
                <td><?php echo "'".$v["cod_libro"]."'"; ?></td>
                
                
                <td align="left"><?php echo $v["titulo_libro"]; ?></td>
                
                <td align="center"  >1</td>
                
                
                <td ></td>
                
                 <td width="30" align="center" >1</td>
                <td align="left"  ><?php echo $v["nombres_cliente"];?>  </td>
				<td align="center"></td>
                <td align="center"></td>
                
                 <td style=""><a   style=" text-decoration:none; color:#000;" href="javascript:popup('<?php echo config::ruta();?>?accion=verContrato&id=<?php echo $v["idcontrato"];?>','500');" rel="nofollow"><?php echo $v["num_contrato"]; ?></a></td>
                <td></td>
                
                <td>TRASP-V</td>
                 <td><?PHP $n=$vendedor->getNombreVendedor($v["vendedores_idVendedores"]); echo $n["nombres"]." ".$n["apellidos"];?></td>
				</tr>
				
				<?php }
				
				}
				
				$contcubie=$contRemis-($contdev+$contdif+$contov);
				$sumasIguales=$contcubie+$contdev+$contdif+$contov;
				
				?>
                </tbody>
                <tfoot>
                 <tr>
                  <td colspan="4">&nbsp;</td>
                  <td><b>SUMAS</b></td>
                  <td colspan="2"><?php echo $contRemis;?></td>
                  <td width="30"></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
                    <tr >
                  <td colspan="4">&nbsp;</td>
                  <td><b>OBRAS REG VENTAS</b></td>
                  <td colspan="2"></td>
                  <td width="30"><?php echo $contov;?></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
                    <tr >
                  <td colspan="4">&nbsp;</td>
                  <td ><b>DEVOLUCIONES</b></td>
                  <td colspan="2"></td>
                  <td width="30"><?php echo $contdev;?></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
                       <tr >
                  <td colspan="4">&nbsp;</td>
                  <td><b>DIFERIDOS</b></td>
                  <td colspan="2"></td>
                  <td width="30"><?php echo $contdif;?></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
                     <tr >
                  <td colspan="4">&nbsp;</td>
                  <td><b>NO CUBIERTOS</b></td>
                  <td colspan="2"></td>
                  <td width="30"><?php echo $contcubie;?></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
             <tr style="font-weight:bold;">
                  <td colspan="4">&nbsp;</td>
                  <td><b>SUMA IGUALES</b></td>
                  <td colspan="2"></td>
                  <td width="30"><?php echo $sumasIguales;?></td>
                  <td colspan="3">&nbsp;</td>
                  <td colspan="2"></td>
                  </tr>
                
              </tfoot>
                 
                 
                  
                
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
