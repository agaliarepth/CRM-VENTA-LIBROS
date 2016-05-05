<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?> 


<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

	
		<script language="javascript">
		

		
		
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexVendedor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});

 $('#gestion-table').dataTable( {
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
		"aaSorting": [ [3,'desc'] ],
        "bInfo": true,
        "bAutoWidth": true,
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );

});


	function pasarTodosCargos(mes, anio){
       ruta="<?php echo config::ruta();?>?accion=gestionCargos&mes="+mes+"&anio="+anio+"&todos=todos";
           alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/warning.png'/>Se pasaran los cargos del Mes:"+mes+" del "+anio+" al siguiente mes . Desea continuar?",function (e) {
              $.ajax({

                  type:"GET",
                  dataType:"html",
                  url:ruta,
                  data:{},
                  success:function(){

                     $(document).reload(true);
                  }



              });

});


	}
	  


 function pasarCargos(mes,anio,id){

                ruta="<?php echo config::ruta();?>?accion=gestionCargos&mes="+mes+"&anio="+anio+"&id="+id;
alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/warning.png'/>Se pasaran los cargos del Mes:"+mes+" del "+anio+" al siguiente mes . Desea continuar?",function (e) {
              $.ajax({

                  type:"GET",
                  dataType:"html",
                  url:ruta,
                  data:{},
                  success:function(){

                     $(document).reload(true);
                  }



              });

});

	//	enviarRuta("<?php echo config::ruta();?>?accion=gestionCargos&mes="+mes+"&anio="+anio+"&id="+id,"Se pasaran los cargos del Mes:"+mes+" del "+anio+" al siguiente mes . Desea continuar?");

		 }
		 

	
	
</script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
    <div class="" style="border: solid 1px #999; margin-bottom:20px;">
        <form method="post" action="<?php echo config::ruta() ?>?accion=gestionCargos">
            <table style="background-color:#E6E6E6;width:100% ">
                <tr>
                    <td  WIDTH="70%">
                        <h1>Almacenes  > Gestion de cargos  </h1>
                    </td>

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




                    <th id="filtroAnio"><label for="anio">AÑO </label>
                    <select name="anio" class="inp2-form">
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


  </div>


<div id="table-content">

                
				<?php if(isset($_POST["consulta"])){ ?>



    <table id="gestion-table" width="50%">
        <thead>

        <tr>
            <th>Vendedor</th>
            <th>Diferidos</th>
            <th>Remitidos</th>
            <th>Total <br>Cargos</th>
            <th>Opciones</th>

        </tr>
        <!--<tr>
            <td colspan="4"></td>
            <td><button class="botonRojo" onclick="pasarTodosCargos('<?php echo $_POST["mes"]?>','<?php echo $_POST["anio"]?>');">PASAR TODOSLOS CARGOS</button></td>
        </tr>!-->
        </thead>
        <tbody>
        <?php $sumtotal = 0;
        foreach ($res as $r) { $sumre=0; $sumdif=0; $suma=0;?>


            <tr>
                <td><?php
                    $vendedor = $v->getNombreVendedor($r["vendedores_idVendedores"]);
                    echo $vendedor["nombres"] . " " . $vendedor["apellidos"]; ?></td>
                <td><?php $sumre = $k->contarCargosVendedor($_POST["mes"], $_POST["anio"], "Diferido", $r["vendedores_idVendedores"]);
                    echo $sumre; ?></td>
                <td><?php $sumdif = $k->contarCargosVendedor($_POST["mes"], $_POST["anio"], "Remitido", $r["vendedores_idVendedores"]);
                    echo $sumdif; ?></td>
                <td><?php $suma=$sumre + $sumdif; echo $suma ?></td>
                <td>
                    <?php if($suma>0){?>
                    <button class="botonAmarillo" onclick="pasarCargos('<?php echo $_POST["mes"]?>','<?php echo $_POST["anio"]?>','<?php echo $r["vendedores_idVendedores"]?>');">PASAR CARGOS >>></button></td>
                     <?php }?>
            </tr>

        <?php }?>



                       </tbody>


                   </table>
<?php }?>
				<!--  end product-table................................... --> 
				
      </DIV>
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
