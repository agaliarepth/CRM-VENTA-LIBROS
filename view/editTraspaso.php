<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?>

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


  <script type="text/javascript">
	var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
    var total=0;
   	var date1;
    var date2;

  // var  precio_total=0;
   var array=new Array();
		// esta rutina se ejecuta cuando jquery esta listo para trabajar


			$(function()
		{



			// configuramos el control para realizar la busqueda de los productos

			var i=$("#idenvia").val();
			 <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
    var i=<?php echo $res2["idenvia"];?>

<?php } ?>
			$("#codigoLabel").autocomplete({
				source: "ajax/traspaso.php?id="+i,			/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado1/* esta es la rutina que extrae la informacion del registro seleccionado */

			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + " / " + item.titulo + "</a>" )
    .appendTo( ul );
};
		});


		function productoSeleccionado1(event, ui)
		{

			var i2=$("#idenvia").val();
			var date=$("#fecha").val();
			$( "#libro" ).val( ui.item.titulo );
			$( "#codigoLabel" ).val( ui.item.codigo );

			stock=parseInt(ui.item.stock_disponible);
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();

			$.ajax({

                              type: "POST",
                              url: "ajax/buscarStockRemitidoMes.php?id="+i2+"&fecha="+date,
                              data: "b="+ui.item.codigo,
                              dataType: "html",
                              error: function(){
                                    mensaje("error petición.","error");
                              },
                              success: function(data){

									 $( "#stock" ).val(data);
									  n();



                              }
                  });
			return false;


		}
function ejecutarAccion(texto){


alertify.set({ labels: { ok: "Si", cancel: "No" } });
alertify.confirm("<img src='./images/iconos/warning.png'/>"+texto,function (e) {
if(e){
date1=date2;

limpiar();

    }
    else{
 validar_fecha=0;
    $("#fecha").val(date1);
  alertify.error(" OPERACION CANCELADA");

    }


});

}
 	  function limpiar(){



total=0;
precio_total=0;
nextinput=0;
$("#libro").val('');
$("#stock").val('');
$("#codigoLabel").val('');
$("#num_filas").val(nextinput);
$("#cantidad").val("");
$("#pu").val("");
$("#codigoLabel").focus();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#montototal").val(precio_total);
$("#num_filas").val(nextinput);
$("#campos tr").remove();

	  }

	  function validarFechas(){

	  	  date2=$("#fecha").val();
         var f1 =new Date(date1);
         var f2=new Date(date2);

       if(f1.getMonth()!=f2.getMonth()||f1.getYear()!=f2.getYear()){



        ejecutarAccion("La fecha se ah  cambiado por lo tanto se Borraran los items por Seguridad. Desea continuar?");
        return false;

       }

              else
              return true;


	}


  $(document).ready(function($)
  {
         date1=$("#fecha").val();

 <?php
    if(isset($_GET["e"])&& $_GET["e"]=="s"){

        foreach($res3 as $v){
            echo "addTableRow2($v[cantidad],'".$v["codigo"]."','".$v["titulo"]."','".$v["volumen"]."','".$v["obs"]."',$v[libros_idlibros]);";



        }


    }


    ?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow

		if(validarCantidad() && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}

    // prevenir que el boton redireccione a una nueva pagina

   });
  function addTableRow2( cantidad, codigo, titulo,tomo,obs,id)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp-form"   id="obs' + nextinput + '"  name="obs[]' + nextinput + '" value="'+obs+'" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';

$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$( "#codigoLabel" ).val('');
//$("#pu").val('');
$("#num_filas").val(nextinput);

var tt=$("#campos tr:last").find("input").eq(0).attr("value");
//var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
////precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
//$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);

   }

   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp-form" id="obs' + nextinput + '"  name="obs[]"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/iconos/delete.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';

	if(typeof(codigo)=="undefined"){
	alert("este codigo de libro no es valido");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){


	mensaje("!!!Ya existe este Item en la Lista.","warning");
	nextinput++;

	}
	else{
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$( "#codigoLabel" ).val('');
$("#stock").val('');

$("#num_filas").val(nextinput);
$("#codigoLabel").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
//var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
//precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
//$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });



   function eliminarFila(b ){



	      var tt=$("#"+b.id).parent().parent().find("input").eq(0).val();
	  	 // var pt=$("#"+b.id).parent().parent().find("input").eq(5).val();
            var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);



	  nextinput =nextinput -1;


	  if(nextinput==0){
		  total=0;
		  precio_total=0;
		 $("#cant_total").val(total);
	 // $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);

		  }

		else{

	total=total-parseInt(tt);

	  //precio_total=precio_total-parseFloat(pt);

	  $("#cant_total").val(total);
	 // $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);
		}

$("#"+b.id).parent().parent().remove();
	  }

 function borrarFilas(){

		  $("#campos").remove();

		  }

	    function validarCantidad(){
			 var patron = /^\d*$/;

				if($( "#cantidad" ).val()==""){
				mensaje("Ingrese un cantidad","warning");
				return false;
	             }


           if ( !patron .test($( "#cantidad" ).val())) {

               mensaje("La Cantidad no es Correcta","warning");
			   return false;
		   }
				else
				return true;

			}


 function dos_decimales(cadena){
var expresion=/^\d+(\.\d{0,2})?$/;
var resultado=expresion.test(cadena);
return resultado;
}
function verificaPrecio(){
var campo = document.getElementById('pu');
if(dos_decimales(campo.value) !== true){
alert('formato no valido en el campo Precio');
return false;
}
else
return true;
}
	  function validarDisponible(){
		var dis=$("#stock").val();
		var cant=$("#cantidad").val();
		if(parseInt(dis)==0)
		 {
			 mensaje ("no hay Stock Suficiente","warning");
			 return false;
			 }
			 else{
				 if(parseInt(cant)>parseInt(dis)){
					  mensaje ("no hay Stock Suficiente","mensaje");
			 return false;

					 }

				 }

			return true;
		  }
 function validarCierre(){
					 var anio=$("#fecha").val().slice(0,4);
					 var mes=$("#fecha").val().slice(5,7);
					 var modulo=1;
					 var sw;

					  $.ajax({

                              type: "GET",
                              url: "ajax/validarCierre.php?anio="+anio+"&mes="+mes,
                              data: "modulo="+modulo,
                              dataType: "html",
							  async:false,

                              error: function(){
                                    mensaje("Error petición ","error");
                              },
                              success: function(data){

									if(data==1)
								     sw=false;
									else
									sw=true;




                              }
                  });

				   return sw;

					 }
		   function validarEnvio(){

				if(nextinput==0){
					mensaje("No existen items para enviar ","warning");


					}


				else {

					if($("#recibeVendedor").val()=="")
					alert("Debe ingresar vendedor que recibe");
					else{
					if(validarFechas())
					confirmForm($("#traspasoForm"),"Se hara efectiva la nota de Traspaso en fecha <b class='resaltar'><br>"+$("#fecha").val()+"</b>. <br>Desea continuar?.");


				}
				}
			}

       function validarStock(){

				 if($("#stock").val()==""){
				 alert("no selecciono un Libro");
				 return;
				 }
				 else return true;

				 }

				  function verRemisiones(){

					 var id;
					 <?php if(isset($_GET["e"])&& $_GET["e"]=="s"){?>
        id=<?php echo $res2["idenvia"];?>
    <?php } else{?>
        id=<?php echo $cad[0];?>
    <?php }?>


	window.open('<?php echo config::ruta()?>?accion=verResumenCargos&iv='+id,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=600, height=400");


	}
		function verRemisionesMes(){
	var date=$("#fecha").val();
	var idenvia=$("#idenvia").val();

	window.open('<?php echo config::ruta()?>?accion=verResumenCargosMes&iv='+idenvia+'&fecha='+date,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=500, width=600, height=400");


	}
  </script>

<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Nota Trapaso > Editar </h1>



  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table" style="padding-bottom:-15px;">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">

	<table border="0" width="65%" style="margin:auto" cellpadding="0" cellspacing="0">
	<tr >
	<td>


		<!--  start step-holder -->

		<!--  end step-holder -->
	<br />


           <form method="post"   class="contacto"  action="" name="form" id="traspasoForm"  >

		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" style="background-color:#E1F1F7">
     	<tr>
     		<td>  <input type="button" value="VER REMISONES DEL MES" onclick="verRemisionesMes();" style=" background-color:#CF0; color:#000; margin-left:5px; font-size:12px; font-family:calibri; height:35px;"/>
</td>
<td><input type="button" value="VER REMISONES" onclick="verRemisiones();" style=" background-color:#CF0; color:#000; margin-left:5px; font-size:12px; font-family:calibri; height:35px;"/></td>

     	</tr>


     	<tr>
               <td colspan="2" > <label>ENVIA </LABEL><input  class="inp-form" type="text" readonly name="nombre_vendedor" value=" <?php echo $res2["envia"];?>" /></td>




           <td colspan="2"> <label>RECIBE</LABEL>
          <select  class="inp4-form" id="nombre_vendedor" name="recibeVendedor" >
            <?php foreach($res4 as $v){?>
        <option value="<?php echo $v["idVendedores"]."||".$v["nombres"]." ".$v["apellidos"]."||".$v["carnet"];?>" <?php if($v["idVendedores"]==$res2["idrecibe"]){ ?>selected="selected" <?php }?>><?php echo $v["apellidos"]." ".$v["nombres"];?></option><?php }?>
            </select>
           </td>






            <td valign="top"> <label>FECHA</LABEL>
			<input type="text" readonly class="fechas"  name="fecha" id="fecha" value="<?php echo $res2["fecha"];?>"/>
          </td>



             <td><label>OBSERVACIONES</label>
			<input name="obs2" class="inp-form" type="text"  value="<?php echo $res2["obs"]?>" />
             </td>


        </tr>
      </table>
      <table>


        <tr>


       <td>
   <label for="codigoLabel" >CODIGO: </label>
   <input id="codigoLabel" size="5" class="inp2-form"  />
   </td>

     <td colspan="">

     <label for="libro" size="50" readonly="readonly">TITULO DEL LIBRO :</label>
  <input id="libro"   class="inp4-form"/></td>
  <td>
   <label for="libro" >Stock Remitido: </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
   </td>


    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>


   <td>
  <img src="<?php config::ruta(); ?>images/iconos/add.png" width="40" height="40" id="adicionar" style="cursor:pointer;"/>
	</td>
    </tr>
	</table>
<hr />
<table cellpadding="0" cellspacing="0" width="100%" id="detalle">

                    <thead>

                     </thead>
                       <tr  style="background-color:#50BBDA; color:#333F;" >

                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>Obs<th>
                             <th ></th>

                        </tr>

                    <tbody  id="campos">



                    </tbody>
                    <tr><td>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /><label for="pu" >CANT TOTAL </label></td>

   </tr>
                     <tr>
		<th>&nbsp;</th>

        <tr>
		<th>&nbsp;</th>
		<td valign="top">

                <input type="button" id="bEnviar" value="Enviar" class="form-submit" name="bEnviar" onclick="validarEnvio();" />



				 <input type="hidden" name="editar" id="editar" value="editar" />
                <input type="hidden" name="num_filas" id="num_filas" />
                <input type="hidden" name="envia" id="envia" value="<?php echo $res2["envia"];?>"/>
                <input type="hidden" name="idenvia" id="idenvia" value="<?php echo $res2["idenvia"];?>"/>
                  <input type="hidden" name="idtraspaso" id="idtraspaso" value="<?php echo $res2["idtraspasos"];?>"/>




		</td>
		<td><input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=traspasoVendedores','Desea cancelar la operacion actual?.');" /></td>
	</tr>
                </table>
                 </form>
	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">

		<!--  start related-act-top -->

		<!-- end related-act-top -->

		<!--  start related-act-bottom -->
		<div id="related-act-bottom">

			<!--  start related-act-inner -->

			<!-- end related-act-inner -->
			<div class="clear"></div>

		</div>
		<!-- end related-act-bottom -->

	</div>
	<!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
<div class="clear"></div>



</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
  </div>
<div class="clear">&nbsp;</div>

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
<?php }
else{
    header("Location:".config::ruta()."?accion=error&m=2");
}
?>