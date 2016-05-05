<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_cobranzas"])){?>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">
    var nextinput = 0;
    var montototal=0;
    var saldototal=0;

         function eliminarFila(fila){
          if($("#"+fila.id).parent().parent().find("input").eq(6).val()==2){
              nextinput--;
                 $("#"+fila.id).parent().parent().remove();


          }
         $("#"+fila.id).parent().parent().css({ display: "none"});


         $("#"+fila.id).parent().parent().find("input").eq(6).val(0);

          calculartotales();

         }
         function calculartotales(){
              var total=0;
              var saldo=0;
             $("#campos tr").each(function(){

             if(parseFloat($(this).find("input").eq(6).val())>0){

             total+=parseFloat($(this).find("input").eq(2).val());
             saldo+=parseFloat($(this).find("input").eq(4).val());
             }
             });

            $("#totalcuotas").val(total);
             $("#totalsaldo").val(saldo);
         }
         $(document).ready(function(){

         <?php 

if(isset($_POST["consulta"])){
  foreach($res2 as $v){
     
      $saldo=$v["monto"]-$pagos->saldoCuota($v["idcuotas"]);
      echo 'addFila("'.$v["numcuota"].'","'.$v["monto"].'","'.$v["monto"].'","'.$v["fechavencimiento"].'","'.$saldo.'","'.$v["idcuotas"].'","1");';
     
     
       
    }
}

    ?>

    $("#botonAdd").click(function(){
        addFila("1",$("#montocuota").val(),$("#montocuota").val(),$("#fecha").val(),$("#montocuota").val(),0,2);
    });
        


         //addFila("666/666",1000,1000,"2/2/2015",0);
       function addFila(numcuota,monto_ant,monto,fecha,saldo,id,sw){

                  var fila='<tr><td><input type="text" id="numcuota' + nextinput + '"  name="numcuota[]' + nextinput + '" value="'+numcuota+'"   /></td><td><input type="hidden" id="monto_ant' + nextinput + '"   value="'+monto_ant+'"   /><input type="text" id="monto' + nextinput + '"  name="monto[]' + nextinput + '" value="'+monto+'"   onchange="validarMontos(this);" /></td><td><input type="date" id="fechavencimiento' + nextinput + '"  name="fechavencimiento[]' + nextinput + '" value="'+fecha+'"  onchange="cambioFecha(this);" /></td><td><input type="number"  readonly id="saldo' + nextinput + '"  name="saldo[]' + nextinput + '" value="'+saldo+'"   /><input type="hidden"  id="id' + nextinput + '"  name="id[]' + nextinput + '" value="'+id+'"  /><input type="hidden"  id="sw' + nextinput + '"  name="sw[]' + nextinput + '"  value="'+sw+'"  /></td><td><img src="images/iconos/delete.png"   id="boton' + nextinput + '" onclick="eliminarFila(this);" width="20" heigth="20"/></td></tr>';
         $("#campos ").append(fila);
         nextinput++;
         calculartotales();

                 }

         });// fin  $(document).ready....



	$(function()
		{

			$("#numcuenta").autocomplete({
				source: "ajax/buscarcuenta.php",
				minLength: 1,
				select: cuentaSeleccionada

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
			 $("#idcredito").val(ui.item.idcredito);

			return false;
				}
	  function abrirPop(){
				 var id=$( "#idcreditos" ).val();

				 window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;

				 }

				   function abrirPop2(id){


				 window.open('<?php echo config::ruta()?>?accion=verContrato&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;

				 }


                 function validarMontos(obj){

                   var monto= parseFloat($("#"+obj.id).val());
                   var saldo=parseFloat($("#"+obj.id).parent().parent().find("input").eq(4).val());
                   var monto_ant=parseFloat($("#"+obj.id).parent().parent().find("input").eq(1).val());
                         if(monto<saldo){

                            mensaje("El monto  no puede ser menor al saldo restante.","warning");
                            $("#"+obj.id).val(monto_ant);
                         }
                         else{
                         if(monto!=monto_ant){
                        if($("#"+obj.id).parent().parent().find("input").eq(6).val()!=2)
                        $("#"+obj.id).parent().parent().find("input").eq(6).val(3);
                         }
                         calculartotales();
                         }

                 }


                  function cambioFecha(obj){




                        if($("#"+obj.id).parent().parent().find("input").eq(6).val()!=2)
                        $("#"+obj.id).parent().parent().find("input").eq(6).val(3);





                  }
               function validarForm(){
                $("#numfilas").val(nextinput);
                    alertify.set({ labels: { ok: "Si", cancel: "No" } });
        alertify.confirm("Se procesara el plan de cuentas. Desea continuar?",function (e) {
                if (e) {

                   formCuotas.submit();

                } else {
                    alertify.error("OPERACION CANCELADA");
                }
        });

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
  <h1>COBRANZAS > REFINANCIAMIENTO  </h1>
  </td>
 <td>
 <form name="form"   method="post"  action=""  >
        <label for="nombre_vendedor" > <b>CARNET CLIENTE / NUMCUENTA:</b> </label>
        <input type="text" class="inp4-form" id="numcuenta" name="numcuenta" >
        <input type="hidden" name="idcredito" id="idcredito" />
        <input type="hidden" name="consulta" value="consulta" />
        <input type="submit"  value="BUSCAR CUENTA" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"/>
 </form>
 </td>

  </tr>
  </table>
  <hr />

  </div>
  <?PHP
    if(isset($_REQUEST["idcredito"]) ){?>


        <table  border="0"cellpadding="2" cellspacing="10"  style="background-color:#CCEBF4;width:100%; font-weight:bold" >
            <tr>
                <td> NOMBRES CLIENTE : <strong><?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?></strong></td>
                <td><input  type="button" onClick="abrirPop2(<?php echo $res["idcontratos"];?>);" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"  value="NUMCONTRATO:<?php echo $res["numcontrato"];?>"/> </td>
                <td>CODIGO - CLIENTE :  <strong><?php echo $res["numcuenta"];?></strong> </td>
                <TD>
                    <input type="hidden"  id="idcreditos" value="<?php echo $res["idcredito"]?>"/>
                    <input type="button" value="MOSTRAR EL KARDEX DE CLIENTE POR COBRAR" onClick="abrirPop();" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" /></TD>
            </tr>

        </table>
        </div>


        <div id="table-content">

            <form style="width: 60%;margin: auto" >
                <fieldset><legend>Agregar  Cuota</legend>
                <table border="0" cellpadding="0" cellspacing="0" style="" class="formDetalle">
                 <tr>
                   <td>
                       <label>Monto de cuota</label>
                      <input type="number"  id="montocuota"  value="0" class="inp2-form"/>
                   </td>
                     <td>
                         <label>Fecha de Vencimiento</label>
                         <input type="text"  id="fecha" class="fechas" value="<?php echo date("Y-m-d")?>"/>
                     </td>
                     <td>

                         <a href="###" id="botonAdd"><img src="<?php echo config::ruta()?>/images/iconos/add.png" width="35" heigth="35"/></a>
                     </td>
                 </tr>


                </table>
                    </fieldset>
                    </form>


                    <form action="" method="POST"  id="formCuotas" name="formCuotas">
        <table border="0" width="35%" cellpadding="0" cellspacing="0" id="categorias2-table" style="margin:auto;">
            <thead style="background-color:#666; color:#FFF;">
            <tr>
                <th  align="center"class="" >N &ordm; CUOTA </th>
                <th align="center" class="">MONTO Bs</th>
                <th align="center" class="">FECHA <BR />VENCIMIENTO</th>
                <th align="center">SALDO Bs</th>
                <th width="150">OPCIONES</th>



            </tr>
            </thead>
            <tbody id="campos" align="center">
           
            </tbody>
<tfooter>
    <tr >
        <td><strong>TOTALES</strong></td>
        <td><input type="number" id="totalcuotas" name="totalcuotas" readonly/></td>
        <td></td>
        <td><input type="number" id="totalsaldo" name="totalsaldo" readonly/></td>
        <td></td>

    </tr>


</tfooter>

        </table>
        <table  style="margin:auto">
        <tr style=" margin-top:5px">
        <td ></td>
        <td >
        <input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar"  onclick="validarForm();"/><td>
<td>         <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=refinanciamiento','Desea cancelar la operacion actual?.');" />
</td>
        </tr></table>
        <input type="hidden" name="numfilas" id="numfilas" />
        <input type="hidden" name="idcreditos" id="idcreditos"  value="<?php echo$res["idcredito"]?>" />
        </form>
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