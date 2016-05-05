 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?>


<script language="javascript">
$(document).ready(function() {



     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#produccion-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();



});






$('#produccion-table').dataTable( {
	 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#produccion-table body ');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = "";
            for (var i = 0; i < nTrs.length; i++) {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData[0];
                if (sGroup != sLastGroup) {
                    var nGroup = document.createElement('tr');
                    var nCell = document.createElement('td');
                    nCell.colSpan = iColspan;
                    nCell.className = "group";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild(nCell);
                    nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
                    sLastGroup = sGroup;
                }
            }
        },
		"fnFooterCallback": function (nRow, aasData, iStart, iEnd, aiDisplay) {

            var columnas = [1,4]; //the columns you wish to add
            for (var j in columnas) {
                var columnaActual = columnas[j];
                var total = 0;
                for (var i = iStart; i < iEnd; i++) {
                    total = total + parseFloat(aasData[aiDisplay[i]][columnaActual]);
                }
                $($(nRow).children().get(columnaActual)).html(total.toFixed(2));

            } // end

        }, // end footercallback

        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"

        },


        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [1,'asc'] ],
        "bInfo": true,
        "bAutoWidth": true,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"


        });
});

</script>
<script type="text/javascript">
				// esta rutina se ejecuta cuando jquery esta listo para trabajar
		var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function()
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#libro").autocomplete({
				source: "ajax/searchProductos.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */

			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + ":" + item.titulo + "</a>" )
    .appendTo( ul );
};
		});

		function productoSeleccionado(event, ui)
		{

			$( "#libro" ).val( ui.item.codigo );
			$( "#titulo" ).val( ui.item.titulo);
			$( "#idlibro" ).val( ui.item.id);




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
<h1>VENTAS > COBRO CUOTAS INICIALES </h1>
  <hr />
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="">
      <table>
         <tr>
           <td>

                <table width="75%">
                  <tr>

                 <th> <label><b>FECHA INICIAL</b></label>
              <input  type="text" name="fecha_ini" class="fechas" id="fecha" value="<?php echo date("Y-m-d")?>"/>

              </th>
              <TH><label>AL</label></TH>

               <th> <label><b>FECHA FINAL</b></label>
              <input  type="text" name="fecha_fin" class="fechas" id="fecha2" value="<?php echo  date("Y-m-d")?>"/>

              </th>
              <th> <label><b>FECHA REFERENCIA</b></label>
             <input  type="text" name="fecha_ref" class="fechas" id="fecha3" value="<?php echo  date("Y-m-d")?>"/>

             </th>


               <th>
               <input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" />
                 </th>
                 </tr>

               </table>
           </td>
         </tr>
         </table>
      </form>
  </div>
  <div style="float:right;">
  <?php if(isset($_POST["consulta"])){?>
 <form action="<?php config::ruta();?>?accion=reporteCuotasIniciales" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="codigo" name="codigo" value="<?php  echo $_POST["libro"];?>"/>
<input type="hidden" id="titulo_libro" name="titulo_libro" value="<?php  echo $_POST["titulo"];?>"/>

</form>
<?php }?>
</div>


</div>


<div id="table-content">




				<?php if(isset($_POST["consulta"])){?>
                <div style="width:100%">
				<table  width="100%"   id="produccion-table"  border="1" cellpadding="0" cellspacing="0"  style=" font-size:9px;">


				      <thead style="background-color:#999; font-size:9px;">
                      <tr >
                      <th colspan="4" style="text-align:center;" >LISTA DE COBROS DE CUOTAS INICIALES
                      <?PHP
					  if($_POST["fecha_ini"]==$_POST["fecha_fin"])
					  echo date("d-M-Y",strtotime($_POST["fecha_ini"]));
                       else
					   echo " DE ".date("d-M-Y",strtotime($_POST["fecha_ini"]))." AL ".date("d-M-Y",strtotime($_POST["fecha_fin"]));
					  ?>
           </th>
           <th colspan="4"  aling="center">
             Fecha referencia:<?php echo $_POST['fecha_ref'] ?>
           </th>


                      </tr>

				        <tr>
                    <th width="75"  >Fecha</th>
				          <th width="75"  >Vendedor</th>
 				          <th width="200" >Cliente</th>
                          <th width="50"  class="">CTO</th>
              			<th width="10"  class="">7</th>
                        <th width="10"  class="">15</th>
                       <TH width="10">30</TH>
                        <TH width="10">+</TH>





				</tr>
                </thead>
                <tbody>
					<?php
					  foreach($listaCuotas as $v){
									  ?>
                      <tr>
                     <td><?php echo date("d-m-Y",strtotime($v["fechacontrato"]));?></td>
                     <td><?php echo $vendedor->getNombresVendedor($v["idvendedor"]); ?></td>
                     <td><?php echo $v["nombres"]." ".$v["apellidopaterno"]." ".$v["apellidomaterno"]; ?></td>
                    <td><?php echo $v["numcontrato"] ?></td>
                    <?php
                    					  $dias=Helpers::dias_transcurridos($v["fechacontrato"],$_POST['fecha_ref']);
                                //echo $dias;
                    					  ?>

                      <td><?php if(abs($dias)<8  )  echo "1"?></td>
                      <TD><?php if(abs($dias)<16 && abs($dias)>6)  echo "1"?></TD>
                      <TD><?php if(abs($dias)<31 && abs($dias)>29)   echo "1"?></TD>
                      <TD><?php if(abs($dias)>30)                    echo "1"?></TD>




                      <?php }?>





			          </tbody>
				      <tfoot>


			          </tfoot>
			        </table>



				<?php }?>
                </div>
				<!--  end product-table................................... -->
				<!--  end content -->
<div class="clear">&nbsp;</div>
<!--  end content-outer -->



<div class="clear">&nbsp;</div>


<!-- start footer -->
<?php require_once("footer.php");?>
<!-- end footer -->
</div>
</div>
</div>


</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>
