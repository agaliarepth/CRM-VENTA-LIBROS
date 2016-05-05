<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>

  <script type="text/javascript">

		var check=false;
		var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
   var  precio_total=0;
    var array=new Array();
     var sw=0;
	 var row=0;

		// esta rutina se ejecuta cuando jquery esta listo para trabajar





  $(document).ready(function($)
  {




	  <?php


  foreach($res3 as $v){

	  $pt=$v["cantidad"]*$v["precio_unitario"];
	  echo "addTableRow2($v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unitario],$pt,$v[libros_idlibros],'".$v["codigo"]."',$v[idkardex]);";
    }
?>


   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo,idkardex)
   {
    campo = '<tr><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td  aling ="left"><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]'+ nextinput + '"  /></td><td ><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><input type="hidden"  id="idkardex' + nextinput + '"  name="idkardex[]' + nextinput + '" value="'+idkardex+'"  /></td><td> <input onchange="chequeo(this);" type="checkbox" id="elegido' + nextinput + '" name="elegido[]'+ nextinput + '"  value="'+nextinput+'" /></td></tr>';

$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#pu").val('');
$("#num_filas").val(nextinput);

var tt=$("#campos tr:last").find("input").eq(0).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
row=nextinput;

   }


  });


	 function validarForm(){
		if(parseInt(row)<parseInt($("#num_filas").val())){
			   if(parseInt(row)>0)
				$("#tipo_devolucion").val("DEVOLUCION PARCIAL");
				else
				$("#tipo_devolucion").val("DEVOLUCION TOTAL");


			if(confirm("Se guardara la Develocion de Venta con fecha <b class='resaltar'>"+$("#fecha").val()+"</b>. Desea continuar?.")){
               return true;

			}
			else
			return false;

		}

			else{

				mensaje("Debe seleccionar  al menos 1 item.","error");
			   return false;
			}



				  }


		 function chequeo(v){
			  if($("#"+v.id).is(':checked')){
			  row-=1;

			   return true;
			  }
			  else{

			   row+=1;
			   return false;
				  }


			 }

  </script>

<!--  start nav-outer-repeat................................................... END -->

 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1>Anulacion de Contrato Diferido </h1>
  <hr />
  
 
  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
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
	
	<table border="0" width="60%" cellpadding="0" cellspacing="0" style="margin:auto;">
	<tr valign="top">
	<td>
	

   

		<!-- start id-form -->
        <form method="POST"   class="contacto"  action="<?php echo config::ruta()."?accion=anularDiferido";?>" name="form" id="wizard"  onsubmit="return validarForm();">
       
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td colspan="2"> <label for="cliente">Cliente:</label>
		
		<input type="text" class="inp4-form" name="cliente"  readonly="readonly" value="<?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?>"/>
		</td>
        <td>
       <label> Num Contrato Anulado:</label>
        
        
         
		<input  type="text" class="inp-form" readonly name="num_contrato"  value="<?php echo $res["numcontrato"];?>"/>
        </td>
        
         <td> <label>Fecha:</label>
           
           <input type="text"   name="fecha" class="fechas" id="fecha" value="<?php echo date("Y-m-d");?>"/>
           
          
            </td>
          
       
       
		</tr> 
        <tr> 
        <td> <label for="cliente">Cobrador:</label>
		
		<input type="text" class="inp-form" name="cobrador" readonly value="<?php echo $cobrador->getNombresCobrador($cred["idcobrador"]);?>" />
		</td>
        <td> <label for="cliente">Vendedor:</label>
		
		<input type="text" class="inp-form" name="vendedor"  readonly="readonly" value="<?php echo $vendedor->getNombresVendedor($res["idvendedor"]);?>"/>
		</td>
       <td> <label for="cliente">Coordinador:</label>
		
		<input type="text" class="inp-form" name="coordinador" />
		</td>
        <td> <label for="cliente">Supervisor:</label>
		
		<input type="text" class="inp-form" name="supervisor" />
		</td>
       
       <td> <label for="cliente">Gerente:</label>
		
		<input type="text" class="inp-form" name="gerente"  />
		</td>
       
       
        </tr>       
      <tr>
       
     
       <td> <label for="cliente">Monto Total Contrato:</label>
		
		<input type="text" class="inp-form" name="preciototal" readonly value="<?php echo $res["preciototal"];?>" />
		</td>
      <td> <label for="cliente">Cuota inicial:</label>
		
		<input type="text" class="inp-form" name="cuotainicial" readonly value="<?php echo $cred["cuotainicial"];?>" />
		</td>
        <td colspan=""> <label for="cliente">Saldo:</label>
		
		<input type="text" class="inp-form" name="saldo" readonly value="<?php echo $cred["saldo"];?>" />
		</td>
      
           
           <td colspan="4">
           <label>Observacion</label>
           <input type="text" class="inp4-form" name="obs"  />
           </td>
           
           </tr>
           
           </thead>
           </table>
           
<hr />
<table cellpadding="0" cellspacing="0" width="70%" id="detalle" border="0">
            
                    <thead>
                  
                    
                  
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                             <th colspan="3" style=" font-weight:bold;" >Seleccionar<br />Devueltos</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                  

        <tr>
		<th>&nbsp;</th>
		<td valign="top">
			
		

	
	</tr>
                </table>	
        <hr />
        <table  style="margin-top:15px;">
        <tr align="center">
		<td valign="center">

                  <input type="submit" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar"/>
                  <input type="hidden" name="enviarDiferido" id="enviarDiferido" value="enviarDiferido" />
                  <input type="hidden" name="idcontrato" value="<?php echo $res["idcontratos"];?>" />
                  <input type="hidden" name="idvendedor" value="<?php echo $res["idvendedor"];?>" />
                  <input type="hidden" name="tipo_devolucion"  id="tipo_devolucion" value="" />
                  <input type="hidden" name="num_filas" id="num_filas" />

		</td>
		<td>
		 <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=contratos','Desea cancelar la operacion actual?.');" />
       </td>
	
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

 	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});

	</script>

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>