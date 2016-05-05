 <?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_cobranzas"])){?>
 <script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<script language="javascript">
$(document).ready(function() {

	 $('#remisiones-table').dataTable( {

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
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"

    } );



});
</script>

<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>

<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">


  <form method="post" action="">
 <table style="background-color:#CCEBF4;width:100% ">
 <tr>
 <td  width="90%">
  <h1>COBRANZAS  > LISTA PAGOS MES  </h1>
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
  <input type="hidden"  name="consulta" value="consulta" />
  </form>
  <hr />
  </div>


<div id="table-content">



				<!--  start message-yellow -->

				<!--  end message-blue -->

				<!--  start message-green -->

				<!--  end message-green -->


				<!--  start product-table ..................................................................................... -->


				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="remisiones-table">
                <thead>
				<tr>

					<th class="">COD</th>

                    <th class="">FECHA</th>
                    <th class="">MONTO</th>
                    <th class="">CLIENTE</th>

                    <th class="">CUENTA</th>
                    <th class="">CUOTA</th>
                   <th class="">RECIBO</th>
                   <th class="">QUIEN COBRO</th>
                   <th class="">OPCIONES</th>


				</tr>
				</thead>
                <tbody>
                <?php
				$cont=1;
				foreach($res as $v){
                    $c1=$cuota->getId($v["credito_idcredito"]);
				?><tr>
                <td><?php echo $v["idpagos"];?></td>
                <td><?php echo $v["fecha"];?></td>
				<td><?php echo $v["monto"];?></td>
                <td><?php echo $v["cliente"];?></td>
                <td><?php $cuenta=$credito->getId($v["credito_idcredito"]); echo $cuenta["numcuenta"];?></td>
                <td><?php echo $c1["numcuota"];?></td>
                <td><?php echo $v["numrecibo"];?></td>
                <td><?php echo $cobrador->getNombresCobrador($v["idcobrador"]);?></td>
                <TD> <a><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="30" height="30" onclick="eliminar('<?php echo config::ruta();?>?accion=listaPagos&id=<?php echo $v["idpagos"];?>&e=bp');"/></a></TD>
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
