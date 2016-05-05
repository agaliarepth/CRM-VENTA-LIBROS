<?php if(isset($_SESSION["modulo_ventas"])||isset($_SESSION["modulo_cobranzas"])){?>     

<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>

 <script src="<?php echo config::ruta();?>js/PrintArea.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 


<div id="myPrintArea"  style=" margin:auto 10px;">
  <h1 align="center" style="font-size:14px">CONTRATO DE COMPRA Y VENTA</h1>
   
   <br />
   
	
 
  
    <table  border="1" cellspacing="0" style="text-align:center; margin: auto 20px auto 20px; width:700px; font-size:10px;">
  <thead  style="background-color:#036; color:#FFF">
    <th scope="col">Codigo</th>
    <th scope="col">Cantidad</th>
    <th scope="col" width="200">Detalle</th>
    <th scope="col">Vol</th>
    <th scope="col">PrecioUnit</th>
  
  <th>Precio total</th></thead>
  <tbody>
     <?php 
				$cont=0;
			foreach($res2 as $v){
		
      
				?><tr>
               
                <td><?php echo $v["codigo"];?></td>
                				
					<td class="fecha"><?php  $cont+=$v["cantidad"];echo $v["cantidad"];?></td>
                    
                     <td class="num_remision"><?php echo $v["titulo"];?></td>
                    <td class="cod_libro"><?php echo $v["volumen"];?></td>
                    <td class="cod_libro"><?php echo $v["precio_unitario"];?></td>
                    <td class="cod_libro"><?php  echo ($v["precio_unitario"]*$v["cantidad"]);?></td>
                 </tr><?php
				}
				?>
  
  
  
  </tbody>
  <tr style=" font-size:14px; color:#039;">
    <td><b>Cant total</b></td>
    <td><b><?php echo $cont;?></b></td>
    <td >&nbsp;</td>
    <td></td>
    <td><b>Total Bs</b></td>
   <td><b><?php echo $res["preciototal"];?></b></td>
  </tr>
</table>
 <?php if($res["tipocontrato"]=="ANULADO"){?>
        <img src=" <?php echo config::ruta();?>images/iconos/ANULADO.png"  style="position:absolute; top:5%; left:10%;">

    <?PHP }?>

	<table width="700" border="1" style=" font-size:11px; margin:auto 20px auto 20px;  " cellspacing="0">
        <tr align="center" style="background-color:#036;; color:#FFF;">
    <td colspan="5" scope="col"  >DETALLE CONTRATO</td>
    </tr>
  <tr>
    <td colspan="2" scope="col" ><b>Numero de Contrato:</b> <?php echo $res["numcontrato"];?></td>
    <td scope="col" ><b>Numero de Cuenta</b> <?php echo $res["numcuenta"];?></td>
    <td scope="col"><b>Localidad:</b><?php echo $res["localidad"];?></td>
    <td scope="col"><b>Fecha:</b><?php echo $res["fechacontrato"];?></td>
  </tr>
  <tr>
    <td colspan="2" scope="col" ><b>Numero de Recibo:</b> <?php echo $res["numdocumento"];?></td>
    <td scope="col" ><b>Fecha Recibo: </b><?php echo $res["fechadoc"];?></td>
    <td scope="col"><b>Numero de Reporte</b><?php echo $res["numreporte"];?></td>
    <td scope="col">&nbsp;</td>
  </tr>
  <tr>
    <td><b>Monto del Contrato Bs:</b> <?php echo $res["preciototal"];?></td>
    
    <td><b>Cuaota Inicial Bs:</b><?php echo $res["cuotainicial"];?></td>
    <td><b>Saldo:</b> <?php echo $res["saldo"];?></td>
    <td><b>Num de Pagos:</b><?php echo $res["numcuotas"];?></td>
    <td><b>Monto de Pagos Bs:</b><?php echo $res["montocuotas"];?></td>
  </tr>
   <tr>
    <td><b>Valor ComisionableBs: </b><?php echo $res["valorcomisionable"];?></td>
    
    <td><b>Porcentaje Comision%:</b> <?php echo $res["porcentajecomision"];?></td>
    <td><b>Monto comision Bs: </b><?php echo $res["montocomision"];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b>Nombre del Vendedor:</b><?php echo $vendedor->getNombresVendedor($res["idvendedor"]);?></td>
    <td colspan="2"><b>Nombre del Chofer:</b><?php echo $vendedor->getNombresVendedor($res["idchofer"]);?></td>
    <td colspan="2"><b>Nombre Cobrador:</b><?php echo $cobrador->getNombresCobrador($res["idcobrador"]);?></td>
    </tr>
   <td colspan="2" scope="col" ><b>Nombres de Cliente:</b><?php echo $res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];?></td>
    <td scope="col"><b>Carnet:</b><?php echo $res["ci"];?></td>
        </table>
        
     <!--   
        REFERENCIAS DEL CONTRATO-->
      
   <?php if(isset($res3["idreferencias"])){?>
		<table width="700" border="1" style=" font-size:11px; margin:auto 20px auto 20px; " cellspacing="0">
        <tr align="center" style="background-color:#036;; color:#FFF;">
    <td colspan="4" scope="col"  >REFERENCIAS </td>
    </tr>
    <tr>
    <td colspan="2"><b>dia Cobrar:</b><?php echo $res3["diacobrar"];?></td>
    <td><b>Horas Cobrar:</b><?php echo $res3["horascobrar"];?></td>
    <td colspan="2"><b>Lugar Cobranza:</b><?php echo $res3["lugarcobranza"];?></td>
    </tr>
  <tr>
   
    <td scope="col"><b>Edad:</b><?php echo $res3["edad"];?></td>
  </tr>
  <tr>
    <td><b>Direccion:</b><?php echo $res3["direccion"];?></td>
    <td><b>No:</b><?php echo $res3["dir_num"];?></td>
    <td><b>Telefono:</b><?php echo $res3["telf"];?></td>
    <td><b>Celular:</b><?php echo $res3["cel"];?></td>
  </tr>
  <tr>
    <td><b>Barrio:</b><?php echo $res3["barrio"];?></td>
    <td><b>Zona:</b><?php echo $res3["zona"];?></td>
    <td><b>Tipo: Casa:</b><?php echo $res3["tipocasa"];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Tiempo vivie en el Inmueble:</b><?php echo $res3["tiempovivemes"]."meses y".$res3["tiempoviveanio"]."a&ntilde;os";?></td>
    <td>&nbsp;</td>
    <td><b>contrato vigente hasta:</b><?php echo $res3["fechavigente"];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b>Nombres propietarios inmueble:</b><?php echo $res3["nombrepropietariocasa"];?></td>
    <td colspan="2"><b>Algunos Detalles Inmueble:</b><?php echo $res3["detallecasa"];?></td>
    </tr>
  <tr>
    <td colspan="2"><b>email:</b><?php echo $res3["emailpropietario"];?></td>
    <td colspan="2"><b>telefono:</b><?php echo $res3["telfpropietario"];?></td>
  </tr>
        </table>

		      
<table width="700" align="center" border="1" style=" font-size:11px; margin:auto 20px auto 20px; " cellspacing="0">
  <tr align="center" style="background-color:#036;; color:#FFF;">
    <td colspan="4" scope="col"  >REFERENCIAS DEL CENTRO DE TRABAJO DEL CLIENTE</td>
    </tr>
  <tr>
    <td colspan="2" scope="col" ><b>Centro de Trabajo: </b><?php echo $res3["centrotrabajo"];?></td>
    <td scope="col"><b>Cargo que Ocupa:</b><?php echo $res3["cargoocupa"];?></td>
    <td scope="col"><b>Antiguedad:</b><?php echo $res3["antiguedad"];?> a&ntilde;os</td>
  </tr>
  <tr>
    <td><b>Jefe Inmediato:</b><?php echo $res3["jefeinmediato"];?></td>
    <td colspan="2"><b>Direccion :</b><?php echo $res3["direcciontrabajo"];?></td>
    <td><b>No:</b><?php echo $res3["numtrabajo"];?></td>
  </tr>
  <tr>
    <td><b>Telfono:</b><?php echo $res3["telftrabajo"];?></td>
    <td><b>Barrio:</b> <?php echo $res3["barriotrabajo"];?></td>
    <td><b>Zona: </b><?php echo $res3["zonatrabajo"];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Ingreso que persive Bs:</b><?php echo $res3["ingreso"];?></td>
    <td><b>otros ingresos Bs:</b><?php echo $res3["otrosingresos"];?></td>
    <td><b>total ingresos Bs:</b><?php echo $res3["totalingresos"];?></td>
    <td>&nbsp;</td>
  </tr>
        </table>
<table width="700" align="center" border="1" style=" font-size:11px; margin:auto 20px auto 20px; " cellspacing="0">
  <tr align="center" style="background-color:#036;; color:#FFF;">
    <td colspan="5" scope="col"  >REFERENCIAS FAMILIARES</td>
    </tr>
  <tr>
    <td colspan="3" scope="col" ><b>Nombre de Esposo (a): </b><?php echo $res3["nombrepareja"];?></td>
    <td scope="col"><b>Carnet:</b><?php echo $res3["cipareja"];?></td>
    <td scope="col"><b>Celular:</b><?php echo $res3["celpareja"];?></td>
  </tr>
  <tr>
    <td><b>C. Trabajo:</b><?php echo $res3["trabajopareja"];?></td>
    <td colspan="3"><b>Cargo que ocupa :</b><?php echo $res3["cargopareja"];?></td>
    <td><b>Antiguedad:</b><?php echo $res3["antiguedadpareja"];?> a&ntilde;os</td>
  </tr>
  <tr>
    <td><b>Direccion C. de Trabajo:</b><?php echo $res3["dirtrabajopareja"];?></td>
    <td><b>No:</b> <?php echo $res3["numdirtrabajopareja"];?></td>
    <td><b>Telefono: </b><?php echo $res3["telftrabajopareja"];?></td>
    <td><b>barrio:</b><?php echo $res3["barriotrabajopareja"];?></td>
    <td><b>Zona:</b><?php echo $res3["zonatrabajopareja"];?></td>
  </tr>
  <tr>
    <td><b>Nombre de Hijos:</b><?php echo $res3["nombrehijos1"];?></td>
    <td colspan="2"><b>Curso:</b><?php echo $res3["cursohijos1"];?></td>
    <td><b>Colegio:</b><?php echo $res3["colegiohijos1"];?></td>
    <td><b>Zona:</b><?php echo $res3["zonahijos1"];?></td>
  </tr>
   <tr>
    <td><b>Nombre de Hijos:</b><?php echo $res3["nombrehijos2"];?></td>
    <td colspan="2"><b>Curso:</b><?php echo $res3["cursohijos2"];?></td>
    <td><b>Colegio:</b><?php echo $res3["colegiohijos2"];?></td>
    <td><b>Zona:</b><?php echo $res3["zonahijos2"];?></td>
  </tr>
   <tr>
    <td colspan="4"><b>Otras Referencias:</b><?php echo $res["otrasref"];?></td>
    
  </tr>
        </table>
  
  <table width="700" align="center" border="1" style=" font-size:11px; margin:auto 20px auto 20px; " cellspacing="0">
  <tr align="center" style="background-color:#036;; color:#FFF; ">
    <td colspan="4" scope="col"  >REFERENCIAS DEL GARANTE</td>
    </tr>
  <tr>
    <td colspan="2" scope="col" ><b>Nombre : </b><?php echo $res3["nombregarante"];?></td>
    <td scope="col"><b>Carnet:</b><?php echo $res3["cigarante"];?></td>
    <td scope="col"><b>Expedido:</b><?php echo $res3["expedidogarante"];?></td>
  </tr>
  <tr>
    <td><b>Dir Domicilio:</b><?php echo $res3["dirgarante"];?></td>
    <td colspan="2"><b>Cargo que ocupa :</b><?php echo $res3["cargopareja"];?></td>
    <td><b>Antiguedad:</b><?php echo $res3["antiguedadpareja"];?> a&ntilde;os</td>
  </tr>
  <tr>
    <td colspan="2"><b>Direccion C. de Trabajo:</b></td>
    <td><b>No:</b><?php echo $res3["numgarante"];?></td>
    <td><b>Telefono:</b><?php echo $res3["telfgarante"];?></td>
  </tr>
  <tr>
    <td><b>Celular:</b><?php echo $res3["celgarante"];?></td>
    <td><b>Barrio:</b><?php echo $res3["barriogarante"];?></td>
    <td><b>Zona:</b><?php echo $res3["zonagarante"];?></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td><b>C.Trabajo:</b><?php echo $res3["trabajogarante"];?></td>
    <td colspan="2"><b>Cargo que ocupa :</b><?php echo $res3["cargogarante"];?></td>
    <td><b>Antiguedad:</b><?php echo $res3["antiguedadgarante"];?> a&ntilde;os</td>
  </tr>
   <tr>
    <td colspan="3"><b>Direccion Trabajo:</b><?php echo $res3["dirtrabajogarante"];?></td>
    <td><b>No:</b><?php echo $res3["numtrabajogarante"];?> </td>
  </tr>
   <tr>
     <td><b>Telefono:</b><?php echo $res3["telftrabajogarante"];?></td>
     <td><b>Barrio:</b><?php echo $res3["barriotrabajogarante"];?></td>
     <td><b>Zona:</b><?php echo $res3["zonatrabajogarante"];?></td>
     <td>&nbsp;</td>
   </tr>
        </table>
  
	<?php }?>


	

</div>
 <table>
 <tr><td> <p><a href="javascript:void(0)" id="imprime"><img src="../images/iconos/imprimir.jpg"/>Imprime</a></p>
</td></tr>
 </table>



 
<script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>

<!--  end content -->

<!--  end content-outer -->

 


    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>