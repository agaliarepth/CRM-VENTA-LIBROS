<?php if(isset($_SESSION["modulo_ventas"])||isset($_SESSION["modulo_cobranzas"])){?>     
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?PHP echo  SUCURSAL;?></title>
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/alertify.core.css" />
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/alertify.default.css" id="toggleCSS" />
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/bootstrap.min.css" id="toggleCSS" />


<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/alertify.min.js"></script>
<script src="<?php echo config::ruta();?>js/functions.js"></script>


<script type="text/javascript">
	$(document).ready(function(){


  $("#cancelar-btn").click(function(){

   alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("Se anulara los items de la nota de  devolucion  en el kardex para volver a editarlos. Desea continuar?",function (e) {
				if (e) {
					$("#cancelar").val("cancelar");
					$("#consulta").val("0");
					$("#enviarForm").submit();
				} else {
					alertify.error(" OPERACION CANCELADA");
				}
		});
  });

	});



</script> 

</head>
<body>
<div id="myPrintArea"  style=" margin:auto 10px;">
  <h1 align="center" style="color:red;font-size:16px">AH OCURRIDO UN ERROR DE CARGA DE DATOS - KARDEX VENDEDOR!!!</h1>
   
   <br />
   
	
<TABLE  border="1" cellspacing="0" style="text-align:center; margin: auto 20px auto 20px; width:700px; font-size:12px;">
	<tr  style="background-color:#036; color:#FFF"><td colspan="6">DETALLES DEL CONTRATO</td></tr>
	<tr>
		<td><strong>NUM DEVOLUCION:</strong></td><td><?php echo $devolucion["iddevolucion"] ?></td>
		<td><strong>FECHA</strong></td><td><?php echo $devolucion["fecha"] ?></td>
		<td><strong>VENDEDOR</strong></td><td><?php echo $devolucion["nombre_vendedor"]?></td>

	</tr>
	
</TABLE>
  
    <table  border="1" cellspacing="0" style="text-align:center; margin: auto 20px auto 20px; width:700px; font-size:10px;">
  <thead  style="background-color:#036; color:#FFF; text-aling:center">
    <th scope="col">Codigo</th>
    <th scope="col">Cantidad</th>
    <th scope="col" width="200">Detalle</th>
    <th scope="col">Vol</th>
  </thead>
  <tbody>
     <?php 
				$cont=0;
				$t=0;
			foreach($detalle as $v){
		
      
				?><tr>
               
                <td><?php echo $v["codigo"];?></td>
                <td class="fecha"><?php  $cont+=$v["cantidad"];echo $v["cantidad"];?></td>
                <td class="num_remision"><?php echo $v["titulo"];?></td>
                <td class="cod_libro"><?php echo $v["volumen"];?></td>
                   
                 </tr><?php
				}
				?>
  
  
  
  </tbody>
  <tr style=" font-size:14px; color:#039;">
    <td><b>Cant total</b></td>
    <td><b><?php echo $cont;?></b></td>
    <td colspan="2" >&nbsp;</td>
   
  </tr>
</table>
<br>
<table  border="1" cellspacing="0" style="text-align:center; margin: auto 20px auto 20px; width:700px; font-size:10px;">
	
	<thead style="background-color:#036; color:#FFF">
	<tr>
		<th colspan="15" align="center">
			KARDEX DE VENDEDOR
		</th>

	</tr>
				  <th >N&deg;</th>
				  <th>FECHA</th>
				  <th  class="">Num<br />REMI</th>
				  <th >CODIGO</th>
				  <th align="center">TITULO</th>
				 
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
                 
                 
				<?php 

				foreach($filaskardex as $v){
					
				?>
                   <tr <?php if($v["estado_libro"]=='Traspaso') {?> style="background-color:#93E69D;"<?php } ?>>
                   	<td><?php echo $v["idkardexvendedor"] ?></td>
                   	<td><?php echo $v["fecha_remision"] ?></td>
                   	<td><?php echo $v["num_remision"] ?></td>
                   	<td><?php echo $v["cod_libro"] ?></td>
                   	<td><?php echo $v["titulo_libro"] ?></td>
                  
                   	<td><?php echo $v["nombres_cliente"] ?></td>
                   	<td><?php echo $v["num_devolucion"] ?></td>
                   	<td><?php echo $v["fecha_devolucion"] ?></td>
                   	<td><?php echo $v["num_contrato"] ?></td>
                   	<td>0<?php echo $v["reg_ventas"] ?></td>
                   	<td><?php echo $v["estado_libro"] ?></td>
                   	<td><?php  echo $ve->getNombresVendedor($v["vendedores_idVendedores"]);?></td>


                   </tr>

				<?php } ?>
				</tbody>

</table>
<br>
<form method="POST" action="" id="enviarForm">
	<table style="margin:auto" style="table table-hover">
		<tr>
				<td>
				  <input type="hidden" name="iddevolucion"  id="iddevolucion"value="<?php echo $devolucion["iddevolucion"]?>" />
				 
				  <input type="hidden" name="idvendedor"  id="idvendedor"value="<?php echo $devolucion["vendedores_idVendedores"]?>" />
				  <input type="hidden" name="fecha"  id="fecha"value="<?php echo $devolucion["fecha"]?>" />
                  <input type="hidden" name="consulta"  id="consulta"  value="consulta" />
                  <input type="hidden" name="cancelar" id="cancelar"  value="0" />

                   <?php 
                     $cont1=0;
                     $cont2=0;
                  
                   foreach ($error1 as $key => $value) {?>
                <input type="hidden" name="error1_codigo[]" value="<?php echo $value['codigo']?>" />
                 <input type="hidden" name="error1_cant[]" value="<?php echo $value['cantidad']?>" />
               
                   <?php   $cont1++; } 
                 
                    foreach ($error2 as $key => $value) {?>
                <input type="hidden" name="error2_codigo[]" value="<?php echo $value['codigo']?>" />
                 <input type="hidden" name="error2_cant[]" value="<?php echo $value['cantidad']?>" />

                   <?php   $cont2++;} ?>

                 

                <input type="hidden" name="cont1" value="<?php echo $cont1;?>" />
                <input type="hidden" name="cont2" value="<?php echo $cont2;?>" />
              
				<button  type="submit" id="procesar" class="btn btn-success" >VOLVER A CARGAR LOS DATOS  AL KARDEX</button>
				</td>
				<td>
					<button  type="button" id="cancelar-btn" class="btn btn-danger">CANCELAR Y EDITAR NOTA DEVOLUCION</button>
				</td>
		</tr>
	</table>

</form>
		

</div>


 


    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>