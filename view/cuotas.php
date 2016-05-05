 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">
				
	
 
	$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#numcuenta").autocomplete({
				source: "ajax/buscarcuenta.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: cuentaSeleccionada/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.num_cuenta + " ::" + item.nombre_cliente + "</a>" )
    .appendTo( ul );
};
		});
		
		function cuentaSeleccionada(event, ui)
		{	
			$( "#numcuenta" ).val(ui.item.num_cuenta + " ::" + ui.item.nombre_cliente );
			 $("#idcuenta").val(ui.item.idcredito);


			return false;
				}
	  function abrirPop(){
				 var id=$( "#idcuentas" ).val();
				 
				 window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;
				 
				 }
				 
				   function abrirPop2(id){
				
				 
				 window.open('<?php echo config::ruta()?>?accion=verContrato&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;
				 
				 }
	 
  </script> 

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 <div class="" style=" ">
<table style="width:100% ">
 <tr style="background-color:#CCEBF4;">
 <td  >
  <h1>COBRANZAS > PAGOS CUOTAS  </h1>
  </td>
 <td>
 <form name="form"   method="post"  action=""  >
      
      
       
        <label for="nombre_vendedor" > <b>CARNET CLIENTE / NUMCUENTA:</b> </label>
        <input type="text" class="inp4-form" id="numcuenta" name="numcuenta" >
          
             
                       
       <input type="hidden" name="idcuenta" id="idcuenta" />

             

        <input type="hidden" name="consulta" value="consulta" />

        
                <input type="submit"  value="BUSCAR CUENTA" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
        </form>
 
 </td>

  </tr>
  </table>
  <hr />
       
  </div>
  <?PHP 
    if(isset($_REQUEST["idcuenta"]) ){?>

  
  <table  border="0"cellpadding="2" cellspacing="10"  style="background-color:#CCEBF4;width:100%; font-weight:bold" >
  <tr>
   <td> NOMBRES CLIENTE : <strong><?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?></strong></td>
  <td><input  type="button" onClick="abrirPop2(<?php echo $res["idcontratos"];?>);" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"  value="NUMCONTRATO:<?php echo $res["numcontrato"];?>"/> </td>
  <td>CODIGO - CLIENTE :  <strong><?php echo $res["numcuenta"];?></strong> </td>
  <TD>
  <input type="hidden"  id="idcuentas" value="<?php echo $res["idcredito"]?>"/>
  <input type="button" value="MOSTRAR EL KARDEX DE CLIENTE POR COBRAR" onClick="abrirPop();" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" /></TD>
  </tr>
  
  </table>
  </div>


<div id="table-content">
	
				
				<table border="0" width="50%" cellpadding="0" cellspacing="0" id="categorias2-table" style="margin:auto;">
                <thead style="background-color:#666; color:#FFF;">
				<tr>
					<th  align="center"class="">N &ordm; CUOTA </th>
                    <th align="center" class="">MONTO Bs</th>
                    <th align="center" class="">FECHA <BR />VENCIMIENTO</th>
                    <th  align="center"class="">DIAS MORA<BR />DIAS COBRO</th>
                    <th align="center">SALDO Bs</th>
                    <th width="150">OPCIONES</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody align="center">
                <?php 
				foreach($res2 as $row){
					$saldo=$row["monto"]-$pagos->saldocuota($row["idcuotas"]);
				?>
                 <?php if($saldo>0){?>
                <tr>
                <td><?php echo $row["numcuota"]?></td>
                <td><?php echo $row["monto"]?></td>
                <td><?php echo $row["fechavencimiento"]?></td>
                <td><?php
				$dias=Helpers::dias_transcurridos($row["fechavencimiento"],date("Y-m-d"));
				 if($dias<0){?>
					 
					 <span style="color:#F00;font-weight:bold;"><?php echo $dias;?></span>
					 
					 <?php } else{ echo $dias; }?>
                     </td>
                <td><?php echo $saldo?></td>
                <td>
               
                
               
				<a href="<?php config::ruta()?>?accion=addPago&id=<?php echo $row["idcuotas"]?>">REGISTRAR PAGO</a>
                
                </td>
                </tr>
                 <?php } else{?>
                 <tr style="background-color:#9C3">
                <td><?php echo $row["numcuota"]?></td>
                <td><?php echo $row["monto"]?></td>
                <td><?php echo $row["fechavencimiento"]?></td>
                <td><?php ?></td>
                <td><?php echo $saldo?></td>
                <td>
               <H4>CANCELADO</H4>                         
				               
                </td>
                </tr>
                 <?php }?>
                <?php }?>	
					
					
			
                
               
                </tbody>
              
              
				</table>
                <?php }?>
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