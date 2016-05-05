
<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">

var monto;
var monto2=0;
$(document).ready(function($)
{

$("#monto").change(function(){
monto=$(this).val();

});



});//fin document ready


function cambioValor(input){
	var saldo=parseFloat($("#"+input.id).parent().parent().find('td').eq(4).html());
 var valor=parseFloat($("#"+input.id).val());
//recalcularPago();

}
function checkCuota(cb){

var valor=$("#"+cb.id).parent().parent().find('input').eq(1).attr("id");
if(cb.checked)
{
$("#"+cb.id).val("1");
saldo=$("#"+cb.id).parent().parent().find('td').eq(4).html();
$("#"+valor).removeAttr("disabled");
$("#"+valor).val(saldo);
$("#"+valor).focus();

}

else {
$("#"+valor).attr("disabled","disabled");
$("#"+valor).val("");
$("#"+cb.id).val("0");

}
//recalcularPago();
}
function recalcularPago(){
//	monto=parseFloat($("#monto").val())
monto2=0;

$("#campos tr").each(function(){

			 cb=$(this).find("input").eq(0).val();


			 if(cb==1){
				 valor=$(this).find("input").eq(1).val();
 				monto2+=parseFloat(valor);
			 }

});
}



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
			 $(function()
		 	{
		 		// configuramos el control para realizar la busqueda de los productos
		 		$("#cobrador").autocomplete({
		 			source: "ajax/searchCobradores.php", 				/* este es el formulario que realiza la busqueda */
		 			minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
		 			select:cobrador/* esta es la rutina que extrae la informacion del registro seleccionado */

		 		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		 	return $( "<li>" )
		 	.data( "ui-autocomplete-item", item )
		 	.append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
		 	.appendTo( ul );
		 	};
		 	});
		 	function cobrador(event, ui)
		 	{
				$( "#cobrador" ).val( ui.item.label );
		 		$( "#idcobrador" ).val( ui.item.idcobradores );
		 		return false;
		 			}
	 function abrirPop(){
				var id=$( "#idcuentas" ).val();

				window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;

				}

					function abrirPop2(id){


				window.open('<?php echo config::ruta()?>?accion=verContrato&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;

				}
				function enviarForm(){
					recalcularPago();
					var montopago=parseFloat($("#monto").val());
					if(montopago!=monto2){
						mensaje("La suma de los  montos de las cuotas para asignar al pago no coinciden con el monto del Pago.<br>Revise los montos   ","warning");
						if(montopago==0 ||$("#monto").val()==""){
							mensaje("El monto del pago no pude ser 0 .<br> Revise el monto del pago  ","warning");
						}
					}

					else {
							confirmForm($("#wizard"),"Esta guardando el pago con los siguientes datos.<br> Monto del pago: <b class='resaltar'> "+$("#monto").val()+" Bs</b><br>Fecha Pago: <b class='resaltar'>"+$("#fecha").val()+"</b></b><br>Desea continuar?");
					}
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
 <h1>COBRANZAS > REGISTRO DE PAGOS </h1>
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


 <form method="post"   class="contacto"  action="" name="form" id="wizard"   >

<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="85%" class="detalleContrato" style="background-color:#E1F1F7; margin:auto">

<thead>

<tr>
<td colspan="4"> <label for="cliente">A nombre de Quien es el Recibo :</label>

<input type="text" class="inp4-form" name="cliente"  value="<?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?>" />
</td>
<td>
<label> Num Recibo:</label>
<input  type="text" class="inp2-form"  name="numrecibo"  value=""/></td>
<td> <label>Fecha Recibo: </label>
<input type="text"   name="fecha" class="fechas" id="fecha" value="<?php echo date("Y-m-d")?>"/>
</td>
<td  colspan=""style="background:#FF6;"> <label for="cliente">Nombre Cobrador:</label>
<input type="text" class="inp-form" id="cobrador" name="nombre_cobrador" value="<?php echo $cobrador->getNombresCobrador($res['idcobrador']);?>" />
</td>
</tr>
<tr>

<!--<td> <label for="cliente">Saldo Anterior:</label>
<input type="text" class="inp2-form" name="saldo_anterior"  id="saldoini" readonly value="" />
</td>-->
<td> <label for="cliente">Saldo Actual:</label>

<input type="text" class="inp2-form" name="saldo" id="saldo" value="<?php echo $res["saldo"]-($pagos->sumPagos($res["idcredito"])+$devob->sumMontoDevueltos($res["numcuenta"]))?>"   />
</td>
<td> <label for="cliente">Monto del Pago Bs:</label>
<input type="text" class="inp2-form" name="monto"  id="monto" value="0" />
</td>
<td> <label for="cliente">Numero Reporte:</label>

<input type="text" class="inp2-form" name="num_reporte" value=""   />
</td>
<td colspan="3"> <label for="cliente">Observaciones:</label>

<textarea name="obs" rows="1" cols="25"></textarea></td>
<td ></td>
</tr>
</thead>
</table>


<div id="table-content">
			 <table border="0" width="50%" cellpadding="0" cellspacing="0" id="categorias2-table" style="margin:auto;">
							 <thead style="background-color:#666; color:#FFF;">
			 <tr>
				 <th  align="center"class="">N &ordm; CUOTA </th>
									 <th align="center" class="">MONTO Bs</th>
									 <th align="center" class="">FECHA <BR />VENCIMIENTO</th>
									 <th  align="center"class="">DIAS MORA<BR />DIAS COBRO</th>
									 <th align="center">SALDO Bs</th>
									 <th width="150">Seleccionar</th>
									 <th>Monto</th>
			 </tr>
			 </thead>
							 <tbody align="center" id="campos">
							 <?php
							 $i=0;
			 foreach($res2 as $row){

				 $saldo=$row["monto"]-$cuotasPagos->sumPagosCuotas($row["idcuotas"]);
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

					<?php } else{ echo $dias;}?>
										</td>
							 <td><?php echo $saldo?></td>
							 <td><input type="checkbox" name="check[]"id="c-<?php echo $i?>" value="0" onchange="checkCuota(this);"/></td>
							 <td>
								 <input type="number"  name="montocuota[]" disabled style="width:80px" id="num-<?php echo $i; ?>" value="" onchange="cambioValor(this);"/>

								 <input type="hidden" name="idcuotas[]" value="<?php echo $row["idcuotas"] ?>">
								 <input type="hidden" name="pos[]" value="<?php echo $i; ?>">

							 </td>
							 </tr>
								<?php } ?>
							 <?php $i++; }?>
							 </tbody>
			 </table>
			 <hr/>
				<table  style="margin:auto">
				<tr align="center">
				<td align="center">
						 <input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="enviarForm();" />
						 <input type="hidden" name="envio" id="envio" value="envio"  />

							<input type="hidden" name="credito_idcredito" value="<?php echo $res["idcredito"];?>" />
						 <input type="hidden" name="idcobrador" id="idcobrador"  value="<?php echo $res["idcobrador"];?>" />
							<input type="hidden" name="numfilas" value="<?php echo $i;?>">
						 <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=addPago','Desea cancelar la operacion actual?.');" />
	</td>
	</tr>
	</table>

							 <?php }?>
			 <!--  end product-table................................... -->

		 </div>
		 </form>
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
