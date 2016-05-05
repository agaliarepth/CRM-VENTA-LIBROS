 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<script type="text/javascript">
var sw_addfila;
$(document).ready(function($)
  {
$("#tipodoc").change(function(){
	
	if($(this).val()=="FACTURA"){
		$("#tablafactura").css({ display: "block"});
		$("#tablarecibo").css({ display: "none"});
	
		}
	
	if($(this).val()=="RECIBO"){
		$("#tablafactura").css({ display: "none"});
		$("#tablarecibo").css({ display: "block"});
		
		}
		
		if($(this).val()=="SINDOC"){
		$("#tablafactura").css({ display: "none"});
		$("#tablarecibo").css({ display: "none"});
		
		}
		});
		
		
		$("#tipodocventa").change(function(){
	
	if($(this).val()=="FACTURA"){
		$("#tablafacturaventa").css({ display: "block"});
		$("#tablareciboventa").css({ display: "none"});
	
		}
	
	if($(this).val()=="RECIBO"){
		$("#tablafacturaventa").css({ display: "none"});
		$("#tablareciboventa").css({ display: "block"});
		
		}
		
		if($(this).val()=="SINDOC"){
		$("#tablafacturaventa").css({ display: "none"});
		$("#tablareciboventa").css({ display: "none"});
		
		}
		});
		
		$("#monto").change(function(){
			
			if(parseFloat($(this).val())>parseFloat($("#saldo").val())){
				
				mensaje("El monto no pude ser mayor al saldo restante","warning");
				$(this).val(0);
				
				}
			
			});
		
		//CONDICIONES INICIALIES
		if(parseFloat($("#saldo").val())<=0){
			
			
			$("#wizard").css({display:"block"});
			}
			
			
		$("#tablafactura").css({ display: "none"});
		$("#tablarecibo").css({ display: "none"});
		
		$("#tablafacturaventa").css({ display: "none"});
		$("#tablareciboventa").css({ display: "none"});
		
	
  });
				function validarFacturacion(){
					
					
					var f=$("#fecha2").val();
					var m=$("#montoventa").val();
					if($("#tipodocventa").val()=="SIN DOCU")
					{
						mensaje("ERROR:: Eliga un documento para facturar.","error");
						return false;
						}
						else{
							if($("#tipocuota").val()=='cc'){
					
					
					  confirmForm($("#wizard"),"Esta facturando con los siguientes datos.<br> <b class='resaltar'> Monto :"+m+"(Bs)<br> fecha: "+f+"</b><br>Desea continuar?");
							}
							if($("#tipocuota").val()=='sc'){
					 
					 confirmForm($("#wizard"),"Esta facturando con los siguientes datos.<br> <b class='resaltar'>  fecha: "+f+"</b><br>Desea continuar?");
							}
							
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
       
  </div>
 
  </div>


<div id="table-content">

		
      <table border="1" class="tabla">
      <tr class="modo2" style="background-color:#9BECF4; font-weight:bold">
      <td>NUM CONTRATO</td>
      
      <TD width="280">CLIENTE</TD>
      
      <TD>MONTO <br /> CONTRATO</TD>
      <TD>MONTO <BR />CUOTA INICIAL</TD>
      <td>SALDO ACTUAL<BR />CUOTAINICIAL</td>
      
      
      </tr>
      <tr>
      <td><?php echo $cont["numcontrato"];?></td>
      <TD><?Php echo $cont["nombres"]." ".$cont["apellidopaterno"]." ".$cont["apellidomaterno"]?></TD>
      <td><?php echo $cont["preciototal"];?></td>
      <td><?php echo $cred["cuotainicial"];?></td>
      <td><input  id="saldo" size="7" readonly value="<?php if($pago->sumPagos($cred["idcredito"])<=0){ echo $cred["cuotainicial"];} else { echo $cred["cuotainicial"]-$pago->sumPagos($cred["idcredito"]); }?>"/></td>
      </tr>
      </table>
      <?php if($cred["cuotainicial"]>0){?>
      <form method="post" action="" name="FORM" id="form">
      <fieldset><legend>Registro de Pagos a cuenta de la Cuota Inicial</legend>
      <table class="detalleContrato" border="0" cellpadding="0" cellspacing="0">
      <tr>
      <td><label>MONTO</label>
      <input type="text"  name="monto" size="10" id="monto"/>
      </td>
      <td><label>FECHA</label><input type="text" id="fecha" class="fechas" name="fecha" value="<?PHP echo date("Y-m-d");?>"/></td>
      <td>
      <label>TIPO DOC</label><select name="tipodoc" id="tipodoc">
      <option value="SINDOC" selected="selected">SIN DOCUMENTO</option>
      
      <option value="RECIBO" >RECIBO</option>
      <option value="FACTURA">FACTURA</option>
      
      </select>
      
      </td>
      <td>
      <table id="tablarecibo">
      <tr> 
      <TD><label>NUM RECIBO</label><input type="text"  name="numrecibo" id="numrecibo" size="12"/></TD>
      <TD><label>NOMBRE</label><input type="text"  name="nombresrecibo" id="nombresrecibo" size="20" /></TD>
       <TD><label>DESCRIPCION</label><input type="text"  name="descripcionrecibo" id="descripcionrecibo" size="20"/></TD>
       </tr>
       </table>
       </td>
       <td>
       <table id="tablafactura" style="display:none">
       <tr>
       <TD ><label>NUM FACTURA</label><input  type="text"  name="numfactura" id="numfactura" size="12"/></TD>
      <TD ><label>NOMBRES</label><input  type="text"  name="nombresfactura" id="nombresfactura" size="20"/></TD>
       <TD><label>CARNET</label><input type="text"  name="carnetfactura" id="carnetfactura" size="12"/></TD>
       <TD ><label>DESCRIPCION</label><input type="text"  name="descripcionfactura" id="descripcionfactura" size="20"/></TD>
       </tr>
      
      </table>
      </td>
      <TD>
      <label>&nbsp;</label><input type="submit" value="GUARDAR" />
      <input  type="hidden" name="enviar" value="enviar"/>
       <input  type="hidden" name="credito_idcredito" value="<?php echo $cred["idcredito"];?>"/>
       <input  type="hidden" name="idcontrato" value="<?php echo $cred["contratos_idcontratos"];?>"/>
      </TD>
      </tr>
      </table>
      
     </fieldset>
      
      </form>
      
      
      <table border="1">
      <thead>
      <tr style="background-color:#9BECF4; font-weight:bold">
      <th>Num</th>
      <th>Descripcion</th>
      <th>Documento</th>
      <th>Num Documento</th>
      <th>Fecha</th>
      <th>Monto</th>
      <th>Opciones</th>
      
      </tr>
      </thead>
      <tbody>
      
      <?php
	  if(count($listaPagos)>0){
	  $c=1;
	   foreach($listaPagos as $v){
		   if($v["tipo"]=="FACTURA" ){ $doc=$factura->getPorDocumento($v["idcuota_inicial"]);?>
			   
			    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $doc["descripcion"];?></td>
      <td><?php echo $v["tipo"];?></td>
      <td><?php echo $doc["numero"];?></td>
      <td><?php echo $v["fecha"];?></td>
      <td><?php echo $v["monto"];?></td>
      <td> <a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagoContratos&id=<?php echo $v["idcuota_inicial"];?>&e=borrar&idcred=<?php echo $v["credito_idcredito"] ?>');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="25" height="25"/></a></td>
      </tr>
			   
			   <?php }
				  
		   if($v["tipo"]=="RECIBO"){
		   $doc=$recibo->getPorDocumento($v["idcuota_inicial"]);
		   ?>
      <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $doc["descripcion"];?></td>
      <td><?php echo $v["tipo"];?></td>
      <td><?php echo $doc["numero"];?></td>
      <td><?php echo $v["fecha"];?></td>
      <td><?php echo $v["monto"];?></td>
      <td> <a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagoContratos&id=<?php echo $v["idcuota_inicial"];?>&e=borrar&idcred=<?php echo $v["credito_idcredito"] ?>');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="25" height="25"/></a></td>
      </tr>
      <?php } $c++; 
	  
	  if($v["tipo"]=="SINDOC"){?>
		  
		    <tr>
      <td><?php echo $c;?></td>
      <td>-------------</td>
      <td><?php echo $v["tipo"];?></td>
      <td>------------</td>
      <td><?php echo $v["fecha"];?></td>
      <td><?php echo $v["monto"];?></td>
      <td> <a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagoContratos&id=<?php echo $v["idcuota_inicial"];?>&e=borrar&idcred=<?php echo $v["credito_idcredito"] ?>');"><img src="<?php echo config::ruta();?>images/iconos/delete.png" width="25" height="25"/></a></td>
      </tr>
		  
		  <?php }
	  
	  
	  }
	  }//fin de if?>
      
      </tbody>
      
      </table >
     
        <form method="post"   class="contacto"  action="" name="form" id="wizard" style="display:none"   >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
		<td style="background:#FFC;" colspan="2"><label>Nombres Cobrador :</label>
			  <input type="text"  size="35" id="nombrecobrador" name="nombrecobrador" value="<?php $co=$cobrador->getId($cred["idcobrador"]); echo $co["nombres"]." ".$co["apellidos"];?>" />
          
            </td>
			
		
		<td ><label>Carnet Cobrador :</label></th>
			<input type="text"  readonly="readonly"  id="cicobrador" name="cicobrador" value="<?php echo $co["carnet"];?>" />
             
            </td>
            <td ><label>Nombre Vendedor :</label></th>
			<input type="text"  id="cicobrador" size="38" name="cicobrador" value="<?php echo $vendedor->getNombresVendedor($cont["idvendedor"]);?>" />
             
            </td>
            
            <td  colspan="2"><label>Nombre Cliente :</label></th>
			<input type="text"  id="cicobrador" size="38" name="nombre_cliente" value="<?php  $nombreCompleto="".strtoupper($cont["nombres"])." ".strtoupper($cont["apellidopaterno"])." ".strtoupper($cont["apellidomaterno"]);echo $nombreCompleto;?>"  readonly="readonly"/>
             
            </td>
            
            </tr>
           </table>
           <table>
            
            <tr>
			
		
			<td><label>NUM DE CUENTA</label>
            
			<input type="text"   readonly="readonly"  class="validate[required]" style="width:90px;"id="numcuenta" name="numcuenta" value="<?php echo $credito->getNumCuenta()+1; ?>"/>
            
           </td>
			
           
		
		
			
            </td>
		
			<td><label>MONTO</label>
            
			<input type="text" required class="validate[required]" style="width:90px; " id="montoventa" name="montoventa" value=""/>
            
           </td>
			
           <td>
            <td><label>FECHA REG. CONTRATO</label><input type="text" id="fecha2" class="fechas" name="fechaventa" value="<?PHP echo date("Y-m-d");?>"/></td>
           
           </td>
       
			 <td>
      <label>TIPO DOC</label><select name="tipodocventa" id="tipodocventa" class="inp-form">
      <option value="SIN DOCU">SIN DOCUMENTO</option>
      <option value="RECIBO" >RECIBO</option>
      <option value="FACTURA">FACTURA</option>
      
      </select>
      
      </td>
      <td>
     
      <table id="tablareciboventa">
      <tr> 
      <TD><label>NUM RECIBO</label><input type="text"  name="numreciboventa" id="numrecibo" size="12"/></TD>
      <TD><label>NOMBRE</label><input type="text"  name="nombresreciboventa" id="nombresrecibo" size="20" value="<?php  $nombreCompleto="".strtoupper($cont["nombres"])." ".strtoupper($cont["apellidopaterno"])." ".strtoupper($cont["apellidomaterno"]);echo $nombreCompleto;?>" /></TD>
       <TD><label>DESCRIPCION</label><input type="text"  name="descripcionreciboventa" id="descripcionrecibo" size="20" value="PAGO CUOTA INICIAL"/></TD>
       <td><label>NUM REPORTE</label>
			  <input type="text" size="15" id="numreporte" name="numreporterecibo" />
            
            </td>
       </tr>
       
      </table>
      </td>
      <td>
       <table id="tablafacturaventa" style="display:none">
       <tr>
       <TD ><label>NUM FACTURA</label><input  type="text"  name="numfacturaventa" id="numfactura" size="12"/></TD>
      <TD ><label>NOMBRES</label><input  type="text"  name="nombresfacturaventa" id="nombresfactura" value="<?php  $nombreCompleto="".strtoupper($cont["nombres"])." ".strtoupper($cont["apellidopaterno"])." ".strtoupper($cont["apellidomaterno"]);echo $nombreCompleto;?>"size="20"/></TD>
       <TD><label>CARNET</label><input type="text"  name="carnetfacturaventa" id="carnetfactura" size="12"/></TD>
       <TD ><label>DESCRIPCION</label><input type="text"  name="descripcionfacturaventa" id="descripcionfactura" size="20" value="PAGO CUOTA INICIAL"/></TD>
       <td><label>NUM REPORTE</label>
			  <input type="text" size="15" id="numreporte" name="numreportefactura" />
            
            </td>
       </tr>
       </table>
			
		</td>
      </tr>
      </table>
      
      
       
       
      
      
		<table style="margin:auto">
        
       	<tr>
				<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="validarFacturacion();" />
            <input type="hidden" name="id" value="enviar"/>
             <input type="hidden" name="regVenta" value="regVenta"/>
              <input  type="hidden" name="tipocuota" id="tipocuota" value="cc"/>
            <input type="hidden" name="idcobrador" value="<?php echo $cred["idcobrador"];?>"/>
              <input type="hidden" name="idcredito" value="<?php echo $cred["idcredito"];?>"/>
				<input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=contratos','Desea cancelar la operacion actual?.');" />
		</td>
	
	</tr>
	</table>
	</fieldset>
</form>
         <?php } else
		 {?>
         <form method="post"   class="contacto"  action="" name="form" id="wizard" style="display:none"   >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
       	
		<tr>
		<td style="background:#FFC;" colspan="2"><label>Nombres Cobrador :</label>
			  <input type="text"  size="35" id="nombrecobrador" name="nombrecobrador" value="<?php $co=$cobrador->getId($cred["idcobrador"]); echo $co["nombres"]." ".$co["apellidos"];?>" />
          
            </td>
			
		
		<td ><label>Carnet Cobrador :</label></th>
			<input type="text"  readonly="readonly"  id="cicobrador" name="cicobrador" value="<?php echo $co["carnet"];?>" />
             
            </td>
            <td ><label>Nombre Vendedor :</label></th>
			<input type="text"  id="cicobrador" size="38" name="cicobrador" value="<?php echo $vendedor->getNombresVendedor($cont["idvendedor"]);?>" />
             
            </td>
            
            <td  colspan="2"><label>Nombre Cliente :</label></th>
			<input type="text"  id="cicobrador" size="38" name="nombre_cliente" value="<?php  $nombreCompleto="".strtoupper($cont["nombres"])." ".strtoupper($cont["apellidopaterno"])." ".strtoupper($cont["apellidomaterno"]);echo $nombreCompleto;?>"  readonly="readonly"/>
             
            </td>
            
            </tr>
           </table>
           <table>
            
            <tr>
			
		
			<td><label>NUM DE CUENTA</label>
            
			<input type="text"   readonly="readonly"  class="validate[required]" style="width:90px;"id="numcuenta" name="numcuenta" value="<?php echo $credito->getNumCuenta()+1; ?>"/>
            
           </td>
			
           
		
		
			
            </td>
		
		
			
           <td>
            <td><label>FECHA REG. CONTRATO</label><input type="text" id="fecha2" class="fechas" name="fechaventa" value="<?PHP echo date("Y-m-d");?>"/></td>
           
           </td>
       
			
     
       </tr>
       
     
      </td>
    
      </tr>
      </table>
      
      
       
       
      
      
		<table style="margin:auto">
        
       	<tr>
				<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar"  onclick="validarFacturacion();"/>
            <input type="hidden" name="id" value="enviar"/>
             <input type="hidden" name="regVenta" value="regVenta"/>
            <input type="hidden" name="idcobrador" value="<?php echo $cred["idcobrador"];?>"/>
            <input  type="hidden" name="tipocuota" id="tipocuota" value="sc"/>
              <input type="hidden" name="idcredito" value="<?php echo $cred["idcredito"];?>"/>
			<input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=contratos','Desea cancelar la operacion actual?.');" />
		</td>
	
	</tr>
	</table>
	</fieldset>
</form>
         
         
         <?php }?>
        		
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