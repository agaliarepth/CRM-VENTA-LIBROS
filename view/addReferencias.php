<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_ventas"])|| isset($_SESSION["modulo_cobranzas"])){?> 
<style type="text/css">
.elegido { background-color:#F00; display:none; }

</style>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>
	
   
	
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
    <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});
            
	</script>


 <script type="text/javascript">
 
 var sw=0;
$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#numContrato").autocomplete({
				source: "ajax/searchContratoCliente.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: contratoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.numcontrato + " - " + item.nombres +" "+item.apellidopaterno+" "+item.apellidomaterno+ "</a>" )
    .appendTo( ul );
};
		});
		
		function contratoSeleccionado(event, ui)
		{	$( "#numContrato" ).val( ui.item.numcontrato );
			$( "#idcontratos" ).val( ui.item.idcontratos);
			$( "#idcredito" ).val( ui.item.idcredito);
			
			rellenarContrato();
     		rellenarReferencias();
			return false;
				}
				
			
				function rellenarContrato(){
					
					 $.ajax({
					 
                              type: "POST",
                              url: "ajax/getContrato.php",
                              data: "id="+$("#idcontratos").val(),
                              dataType: "json",
                              error: function(){
                                    mensaje("ERROR EN LA PETICION","error");
                              },
                              success: function(data){
								  
								    if(data==false){
										mensaje("No hay ningun contrato.","error")
									}
									else
									{
										
										$("#numcontrato").val(data.numcontrato);
									    $("#fecha").val(data.fechacontrato);
										$("#montototal").val(data.preciototal);
										$("#cuota_inicial").val(data.cuotainicial);
										$("#num_pagos").val(data.numcuotas);
										$("#monto_pagos").val(data.montocuotas);
										$("#valorcomisionable").val(data.montocomision);
										$("#porcentajeComnision").val(data.porcentajecomision);
										$("#nombres").val(data.nombres);
										$("#apellido_materno").val(data.apellidomaterno);
										$("#apellido_paterno").val(data.apellidopaterno);
										$("#carnet").val(data.ci);


										}
							  }
					 });
					
					}
	function rellenarReferencias(){
	 
		
		
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/buscarReferencias.php",
                              data: "id="+$("#idcredito").val(),
                              dataType: "json",
                              error: function(){
                                    mensaje("ERROR EN LA PETICION ","error");
                              },
                              success: function(data){
								  
								    if(data==false){
										
                                  alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/help.png'/>No existen referencias para este contrato.Desea registrar las referencias..?",function (e) {
				if (e) {
					  $("#tabla-referencias").css( "display", "block");
										   	$( "#nuevo").val(1);
				} else {
						$( "#numContrato" ).val("");
									    $( "#numContrato" ).focus();
										$( "#idcontratos" ).val(0);
										$( "#nuevo" ).val(0);
				}
		});

	                                    }
										else
										{
											
											  $("#tabla-referencias").css( "display", "block");
											  rellenarContrato();
											$( "#nuevo" ).val(0);	
											$("#nombres").val(data.nombres);
											$("#apellido_materno").val(data.apellidomaterno);
											$("#apellido_paterno").val(data.apellidopaterno);
											$("#edad").val(data.edad);
											$("#carnet").val(data.ci);
											$("#expedido_ci").val(data.expedidoci);
											$("#nit").val(data.nit);
											$("#direccion").val(data.direccion);
											$("#nit").val(data.nit);
											$("#dir_num").val(data.dir_num);
											$("#telf").val(data.telf);
											$("#cel").val(data.cel);
											$("#barrio").val(data.barrio);
											$("#zona").val(data.zona);
											switch(data.tipocasa){
												
												case 'casa propia':{$("#tipocasa_propia").attr("checked","true"); break;}
												case 'anticretico':{$("#tipocasa_anticretico").attr("checked",1); break;}
												case 'alquiler':{$("#tipocasa_alquiler").attr("checked",1); break;}
												case 'casa de padres':{$("#tipocasa_padres").attr("ckecked",1); break;}
												case 'alquila habitacion':{$("#tipocasa_habitacion").attr("ckecked",1); break;}
												case 'encargado':{$("#tipocasa_encargado").attr("ckecked",1); break;}
												
												}
												
												$("#tiempo_vive_mes").val(data.tiempovivemes);
												$("#tiempo_vive_anio").val(data.tiempoviveanio);
												$("#fecha2").val(data.fechavigente);
												$("#nombre_propietario_casa").val(data.nombrepropietariocasa);
												$("#detalle_casa").val(data.detallecasa);
												$("#telf_propietario").val(data.telfpropietario);
												$("#email_propietario").val(data.emailpropietario);
												$("#centro_trabajo").val(data.centrotrabajo);
												$("#cargo_ocupa").val(data.cargoocupa);
												$("#antiguedad").val(data.antiguedad);
												$("#jefe_inmediato").val(data.jefeinmediato);
												$("#direccion_trabajo").val(data.direcciontrabajo);
												$("#num_trabajo").val(data.numtrabajo);
												$("#telf_trabajo").val(data.telftrabajo);
												$("#barrio_trabajo").val(data.barriotrabajo);
												$("#zona_trabajo").val(data.zonatrabajo);
												$("#ingreso").val(data.ingreso);
												$("#otros_ingresos").val(data.otrosingresos);
												$("#total_ingresos").val(data.totalingresos);
												$("#nombre_pareja").val(data.nombrepareja);
												$("#ci_pareja").val(data.cipareja);
												$("#cel_pareja").val(data.celpareja);
												$("#trabajo_pareja").val(data.trabajopareja);
												$("#cargo_pareja").val(data.cargopareja);
												$("#antiguedad_pareja").val(data.antiguedadpareja);
												$("#dir_trabajo_pareja").val(data.dirtrabajopareja);
												$("#num_dir_trabajo_pareja").val(data.numdirtrabajopareja);
												$("#telf_trabajo_pareja").val(data.telftrabajopareja);
												$("#barrio_trabajo_pareja").val(data.barriotrabajopareja);
												$("#zona_trabajo_pareja").val(data.zonatrabajopareja);
												$("#nombre_hijos1").val(data.nombrehijos1);
												$("#colegio_hijos1").val(data.colegiohijos1);
												$("#curso_hijos1").val(data.cursohijos1);
												$("#zona_hijos1").val(data.zonahijos1);
												$("#nombre_hijos2").val(data.nombrehijos2);
												$("#colegio_hijos2").val(data.colegiohijos2);
												$("#curso_hijos2").val(data.cursohijos2);
												$("#zona_hijos2").val(data.zonahijos2);
												$("#otras_ref").val(data.otrasref);
												$("#nombre_garante").val(data.nombregarante);
												$("#ci_garante").val(data.cigarante);
												$("#expedido_garante").val(data.expedidogarante);
												$("#dir_garante").val(data.dirgarante);
												$("#num_garante").val(data.numgarante);
												$("#telf_garante").val(data.telfgarante);
												$("#cel_garante").val(data.celgarante);
												$("#barrio_garante").val(data.barriogarante);
												$("#zona_garante").val(data.zonagarante);
												$("#trabajo_garante").val(data.trabajogarante);
												$("#cargo_garante").val(data.cargogarante);
												$("#antiguedad_garante").val(data.antiguedadgarante);
												$("#dir_trabajo_garante").val(data.dirtrabajogarante);
												$("#num_trabajo_garante").val(data.numtrabajogarante);
												$("#telf_trabajo_garante").val(data.telftrabajogarante);
												$("#barrio_trabajo_garante").val(data.barriotrabajogarante);
												$("#zona_trabajo_garante").val(data.zonatrabajogarante);
												$("#dia_cobrar").val(data.diacobrar);
												$("#horas_cobrar").val(data.horascobrar);
												$("#observaciones").val(data.observaciones);
												$("#lugarcobranza").val(data.lugarcobranza);
												$("#idreferencias").val(data.idreferencias);
												
												
												switch(data.lugarcobranza){
												
												case 'domicilio':{$("#lc_domicilio").attr("checked",1); break;}
												case 'CTrabajo':{$("#lc_trabajo").attr("checked",1); break;}
												case 'desc planilla':{$("#lc_planilla").attr("checked",1); break;}
												case 'otro':{$("#lc_otro").attr("ckecked",1); break;}
																								
												}
											
											}

										
											  n();

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
  
  <table style="margin:auto">
  <tr>
  <td><label><strong>BUSCAR POR NUM DE CONTRATO</strong> </label><input type="text" class="fechas" name="numContrato" id="numContrato"  size="10" style="font-size:18px"/></td>
  <td></td>
  </tr>
  </table>
  <hr/>
		</div>


<DIV id="tabla-referencias" style="display:none">

<form method="post" action="">
<table style="background-color:#DDE8EE; width:80%; margin:auto; "  border="0"  class="detalleContrato" >
       
        <tr style="background-color:#333; color:#FFF; font-size:20px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; height:30px; text-align:center;">
          <td colspan="7">DATOS DEL CONTRATO</td>
          </tr>
        <tr>
			
			<td><label>Numero de Contrato :<span>*</span></label><input type="text"  disabled="disabled" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:27px" id="numcontrato" name="numcontrato" value="" readonly  /> </td>
            <td><label>Localidad del contrato: <span> * </span></label><input type="text" class="validate[required] text-input" data-prompt-position="topRight:-70" disabled="disabled" style="width:150px; height:27px"id="localidad_contrato" name="localidad_contrato" value="cbba"/> </td>
            <td colspan="2"><label>Fecha Contrato :<span> * </span></label><input type="text" class="fechas"  name="fecha_contrato"  id="fecha" disabled="disabled"/>
           </td>
            
		</tr>
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
        <td colspan="7" ><b>MODO DE  PAGO</b></td>
        </tr>
        <tr>
        <td><label>Monto total del contrato Bs :<span> * </span></label><input type="text" readonly disabled="disabled" class="validate[required] text-input" data-prompt-position="topRight:-70" style="width:150px; height:27px" id="montototal" name="montototal" value=""/> </td>
             	 <td><label>Cuota Inicial Bs:<span> * </span> </label><input type="text"  id="cuota_inicial" name="cuota_inicial"  disabled="disabled" value=""/></td>
                
            <td><label>Numero de Pagos :<span> * </span></label><input type="text"  disabled="disabled" class="validate[custom[integer]]" style="width:70px; height:27px;"  id="num_pagos" name="num_pagos" value=""/> </td> 
                  <td><label>Monto por Pago Bs : <span> * </span></label><input type="text"  disabled="disabled" class="validate[custom[number]]" style="width:75px; height:27px" id="monto_pagos" name="monto_pagos"   value=""/> </td> 
                   
			</tr>
            <tr>
        <td><label>Monto Comisionable Bs:<span> * </span></label><input type="text"  class="validate[required,custom[number]] text-input" data-prompt-position="topRight:-70" disabled="disabled" style="width:100px; height:27px; " id="valorcomisionable" name="valorcomisionable" value=""/> </td>
             	 <td><label>Porcentaje Comision</label>
                 <input type="text"  name="comisionContrato"   id="porcentajeComnision" disabled="disabled" readonly>
              
                 </td>
         
			</tr>
        <tr style="text-align:center; background-color:#F2F9FD; color:#333;">
        <td colspan="7"><b>COBRANZA</b></td>
        </tr>
		
		</tr>
        <tr>
        
          
            <td colspan="1"><label><br />Donde se cobra?: </label>
            <input type="radio"    id="lc_domicilio" name="lugar_cobranza" value="domicilio" checked><b> Domicilio</b>
             <input type="radio"  id="lc_trabajo" name="lugar_cobranza" value="CTrabajo" ><b>C.Trabajo </b>
             <input type="radio"  id="lc_planilla" name="lugar_cobranza" value="desc planilla" ><b> Desc. por Planilla</b>
             <input type="radio" id="lc_otro" name="lugar_cobranza" value="otro" ><b>otro </b>
             
                </td>
             
        
        
        
         <td colspan="4">Cobrar preferentemente  los dias:<input type="text" class="inp3-form"  id="dia_cobrar" name="dia_cobrar"   value=""/>  de cada mes a horas: <input type="text" class="inp2-form"  id="horas_cobrar" name="horas_cobrar" value=""/></td>
         <td colspan=""></td>
         
         <td></td>
        </tr>
        <tr>
        <td><label>Lugar Cobranza</label><input type="text" id="lugarcobranza" name="lugarcobranza"/></td>
         <td colspan="2"><label>Algunos Observaciones: </label><input type="text" class="inp4-form"   id="observaciones"name="observaciones" value=""/></td>
         <td colspan="2"></td>
       </tr>
        <td></td>
        <tr> <td>&nbsp;</td></tr>
        
       
     
	</table>
		

       <table border="0" style="background-color:#CEDDF2; width:80%; margin:auto; "  class="detalleContrato" >
       
        <tr style="background-color:#333; color:#FFF; font-size:20px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; height:30px; text-align:center;">
          <td colspan="7">DATOS DEL CLIENTE </td>
          </tr>
     
        
        
        </table>
        
        
        <table  border="0" style="background-color:#CEDDF2; width:80%; margin:auto;  " id="tablaClientes" class="detalleContrato"><tr>
          <td>&nbsp;</td>
      
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
			
			<td><label>Nombres Cliente :<span> * </span></label><input disabled="disabled" type="text"  style="width:220px; height:27px" id="nombres" name="nombres" value=""/> </td>
            <td><label>A.Paterno : <span> * </span></label><input type="text"  disabled="disabled" style="width:220px; height:27px" id="apellido_paterno" name="apellido_paterno" value=""/> </td>
            <td><label>A.Materno :<span> * </span></label><input type="text" disabled="disabled" style="width:220px; height:27px" id="apellido_materno" name="apellido_materno" value=""/> </td>
            <td><label>Edad :</label><input type="text"  disabled="disabled" class="inp2-form" id="edad" name="edad" value=""/> </td>
                <td><label>Carnet :</label><input type="text" style="width:75px; height:27px"  id="carnet" name="carnet" value=""/> </td>
			
              <td><label>CI. Expedido en:</label><input type="text" class="inp2-form" id="expedido_ci" name="expedido_ci" value=""/> </td>
               <td><label>Nit:</label><input type="text" class="inp2-form" id="nit" name="nit" value=""/> </td>
		</tr>
        <tr>
        <td><label>Direccion :<span> * </span></label><input type="text" class="inp-form" id="direccion" name="direccion" value=""/> </td>
             	 <td><label>No: </label><input type="text" class="inp-form" id="dir_num" name="dir_num" value=""/></td>
                  <td><label>Telefono :</label><input type="text" class="inp-form" id="telf" name="telf" value=""/> </td> 
                  <td><label>Celular :</label><input type="text" class="inp2-form" id="cel" name="cel" value=""/> </td> 
			
		
		</tr>
        <tr>
         <td><label>Barrio: </label><input type="text" class="inp-form" id="barrio" name="barrio" value=""/></td>
           <td><label>Zona: </label><input type="text" class="inp-form" id="zona" name="zona" value=""/></td>
            <td colspan="5"><label>Tipo Casa: </label></BR>
            <input type="radio"  id="tipocasa_propia" name="tipo_casa" value="casa propia" checked><b> Propia</b>
             <input type="radio"  id="tipocasa_anticretico" name="tipo_casa" value="anticretico" ><b>Anticretico </b>
             <input type="radio"  id="tipocasa_alquiler" name="tipo_casa" value="alquiler" ><b> Alquiler</b>
             <input type="radio"  id="tipocasa_padres" name="tipo_casa" value="casa de padres" ><b>Casa de sus Padres </b>
              <input type="radio"  id="tipocasa_habitacion" name="tipo_casa" value="alquila habitacion" ><b> Alquila Habitacion</b>
             <input type="radio" id="tipocasa_encargado" name="tipo_casa" value="encargado" ><b>Encargado (a) </b>
                </td>
             
        
        </tr>
        <tr>
         <td><label>Tiempo que vive Inmueble meses/años: </label>
         <input type="text" class="inp3-form"   id="tiempo_vive_mes" name="tiempo_vive_mes" value=""/>/<input type="text" class="inp3-form"   id="tiempo_vive_anio" name="tiempo_vive_anio" value=""/></td>
        <td><label>Contrato vigente hasta Fecha: </label><input type="text" class="fechas" id="fecha2"  name="fecha_contrato_vigente" value=""/>
              
        </td>
         <td colspan="2"><p><label>Nombre de los propietarios del  Inmueble: </label><input type="text" class="inp-form"  name="nombre_propietario_casa" id="nombre_propietario_casa"   value=""/></p></td>
         <td colspan="2"><label>Email: </label><input type="text" class="inp-form"  name="email_propietario"  id="email_propietario" value=""/></td>
         <td><label>Telefono: </label><input type="text" class="inp2-form"  name="telf_propietario"  id="telf_propietario"value=""/></td>
         
        </tr>
        <tr>
         <td colspan="2"><label>Algunos Detalles del Inmueble: </label><input type="text" class="inp4-form"  name="detalle_casa"  id="detalle_casa" value=""/></td>
       </tr>
        <td></td>
        <tr> <td>&nbsp;</td></tr>
        
       
     
	</table>
  
        <table border="0"  style="background-color:#E4E7F8; width:80%; margin:auto; " id="tablaTrabajo" class="detalleContrato">
        
	
       
        <tr style="background-color:#333; color:#FFF; font-size:20px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; height:30px; text-align:center;">
          <td colspan="5">REFERENCIAS DEL CENTRO DE TRABAJO DEL CLIENTE</td>
          </tr>
        <tr>
			
			<td colspan="2"><label>Centro de Trabajo:</label><input type="text" class="inp-form" id="centro_trabajo" name="centro_trabajo" value=""/> </td>
            <td ><label>Cargo que Ocupa: </label><input type="text" class="inp-form" id="cargo_ocupa" name="cargo_ocupa" value=""/> </td>
            <td><label>Antiguedad :</label><input type="text" class="inp-form" id="antiguedad" name="antiguedad" value=""/> </td>
             <td><label>Jefe Inmediato:</label><input type="text" class="inp-form" id="jefe_inmediato" name="jefe_inmediato" value=""/> </td>
			 
		</tr>
        <tr>
			
			<td><label>Direccion:</label><input type="text" class="inp-form" id="direccion_trabajo" name="direccion_trabajo" value=""/> </td>
            <td ><label>No: </label><input type="text" class="inp2-form" id="num_trabajo" name="num_trabajo" value=""/></td>
            <td><label>Telefono :</label><input type="text" class="inp-form" id="telf_trabajo" name="telf_trabajo" value=""/> </td>
             <td><label>Barrio :</label><input type="text" class="inp-form" id="barrio_trabajo" name="barrio_trabajo" value=""/> </td>
              <td><label>Zona :</label><input type="text" class="inp-form" id="zona_trabajo" name="zona_trabajo" value=""/> </td>
			 
		</tr>
        <tr>
         <td colspan="2"><label>Ingreso que persive Bs:</label><input type="text" class="inp-form" id="ingreso" name="ingreso" value=""/> </td>
             <td><label>Otros Ingresos Bs:</label><input type="text" class="inp-form" id="otros_ingresos" name="otros_ingresos" value=""/> </td>
              <td><label>Total Ingresos Bs:</label><input type="text" class="inp-form" id="total_ingresos" name="total_ingresos" value=""/> </td>
        
        
        </tr>
        
        <td></td>
        <tr> <td>&nbsp;</td></tr>
       
        
      
	
     
	</table>
 
      
        <table border="0" style="background-color:#CEDDF2; width:80%; margin:auto; "  id="tablaReferenciasFamiliares"  class="detalleContrato">
        
	<thead>
        <tr  style="background-color:#333; color:#FFF; font-size:20px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; height:30px; text-align:center;">
          <td colspan="3">&nbsp;</td>
          <td colspan="3">REFERENCIAS FAMILIARES</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>
        <tr>
			
			<td colspan="3"><label>Nombre del Esposo (a) :</label><input type="text" class="inp-form" id="nombre_pareja" name="nombre_pareja" value=""/> </td>
            <td><label>C.I.: </label><input type="text" class="inp2-form" id="ci_pareja" name="ci_pareja" value=""/> </td>
            <td><label>Celular:</label><input type="text" class="inp-form" id="cel_pareja" name="cel_pareja" value=""/> </td>
             <td><label>Centro Trabajo:</label><input type="text" class="inp-form" id="trabajo_pareja" name="trabajo_pareja" value=""/> </td>
              <td><label>Cargo que Ocupa:</label><input type="text" class="inp-form" id="cargo_pareja" name="cargo_pareja" value=""/> </td>
               <td><label>Antiguedad:</label><input type="text" class="inp2-form" id="antiguedad_pareja" name="antiguedad_pareja" value=""/> </td>
			 
		</tr>
        <tr>
        <td colspan="3"><label>Direccion de Trabajo:</label><input type="text" class="inp-form" id="dir_trabajo_pareja" name="dir_trabajo_pareja" value=""/> </td>
        <td><label>No: </label><input type="text" class="inp2-form" id="num_dir_trabajo_pareja" name="num_dir_trabajo_pareja" value=""/> </td>
         <td><label>Telefono trabajo:</label><input type="text" class="inp-form" id="telf_trabajo_pareja" name="telf_trabajo_pareja" value=""/> </td>
        <td><label>Barrio Trabajo:</label><input type="text" class="inp-form" id="barrio_trabajo_pareja" name="barrio_trabajo_pareja" value=""/> </td>
        <td><label>Zona trabajo:</label><input type="text" class="inp-form" id="zona_trabajo_pareja" name="zona_trabajo_pareja" value=""/> </td>
        </tr>
        <tr>
          <td colspan="3"><label>Nombre de Hijos:</label><input type="text" class="inp-form" id="nombre_hijos1" name="nombre_hijos1" value=""/> </td>
            <td><label>Curso:</label><input type="text" class="inp2-form" id="curso_hijos1" name="curso_hijos1" value=""/> </td>
         <td><label>Colegio</label><input type="text" class="inp-form" id="colegio_hijos1" name="colegio_hijos1" value=""/> </td>
         <td><label>Zona Colegio</label><input type="text" class="inp-form" id="zona_hijos1" name="zona_hijos1" value=""/> </td>
        
        </tr>
        <tr>
        <td colspan="3"><label>Nombre de Hijos:</label><input type="text" class="inp-form" id="nombre_hijos2" name="nombre_hijos2" value=""/> </td>
            <td><label>Curso:</label><input type="text" class="inp2-form" id="curso_hijos2" name="curso_hijos2" value=""/> </td>
         <td><label>Colegio</label><input type="text" class="inp-form" id="colegio_hijos2" name="colegio_hijos2" value=""/> </td>
         <td><label>Zona Colegio</label><input type="text" class="inp-form" id="zona_hijos2" name="zona_hijos2" value=""/> </td>
        </tr>
          <tr>
          <td colspan="3"></td>
         <td colspan="3"><label>Otras Referencias: </label><input type="text" class="inp4-form"  id="otras_ref"  name="otras_ref" value=""/></td>
      </tbody>
     
   
	</table >

        <table border="0" style="background-color:#E4E7F8; width:80%; margin:auto; " id="tablaGarante" class="detalleContrato">
        
	
       
        <tr style="background-color:#333; color:#FFF; font-size:20px; font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; height:30px; text-align:center;">
          <td colspan="6">REFERENCIAS DEL GARANTE</td>
          </tr>
        <tr>
			
			<td colspan="3"><label>Nombres:</label><input type="text" class="inp4-form" id="nombre_garante" name="nombre_garante" value=""/> </td>
            <td  colspan=""><label>C.I.: </label><input type="text" class="inp-form" id="ci_garante" name="ci_garante" value=""/> </td>
            <td colspan="2"><label>Remitido en:</label><input type="text" class="inp-form" id="expedido_garante" name="expedido_garante" value=""/> </td>
            
			 
		</tr>
        <tr>
			
			<td colspan="2"><label>Direccion Domicilio:</label><input type="text" class="inp-form" id="dir_garante" name="dir_garante" value=""/> </td>
            <td ><label>No: </label><input type="text" class="inp2-form" id="num_garante" name="num_garante" value=""/></td>
            <td><label>Telefono :</label><input type="text" class="inp-form" id="telf_garante" name="telf_garante" value=""/> </td>
                <td><label>Celular :</label><input type="text" class="inp-form" id="cel_garante" name="cel_garante" value=""/> </td>
			 
		</tr>
        <tr>
         <td colspan="2"><label>Barrio :</label><input type="text" class="inp-form" id="barrio_garante" name="barrio_garante" value=""/> </td>
             <td><label>Zona:</label><input type="text" class="inp-form" id="zona_garante" name="zona_garante" value=""/> </td>
              <td colspan=""><label>Centro Trabajo:</label><input type="text" class="inp-form" id="trabajo_garante" name="trabajo_garante" value=""/> </td>
               <td><label>Cargo Ocupa :</label><input type="text" class="inp-form" id="cargo_garante" name="cargo_garante" value=""/> </td>
                <td><label>Antiguedad:</label><input type="text" class="inp2-form" id="antiguedad_garante" name="antiguedad_garante" value=""/> </td>
        
        
        </tr>
          <tr>
			
			<td colspan="2"><label>Direccion Centro Trabajo:</label><input type="text" class="inp-form" id="dir_trabajo_garante" name="dir_trabajo_garante" value=""/> </td>
            <td ><label>No: </label><input type="text" class="inp2-form" id="num_trabajo_garante" name="num_trabajo_garante" value=""/></td>
            <td><label>Telefono :</label><input type="text" class="inp-form" id="telf_trabajo_garante" name="telf_trabajo_garante" value=""/> </td>
                <td><label>Barrio :</label><input type="text" class="inp-form" id="barrio_trabajo_garante" name="barrio_trabajo_garante" value=""/> </td>
                  <td><label>Zona :</label><input type="text" class="inp-form" id="zona_trabajo_garante" name="zona_trabajo_garante" value=""/> </td>
			 
		</tr>
        
        <td></td>
        <tr> <td>&nbsp;</td></tr>
       
        <tfoot>
   <tr><td>&nbsp;</td><tr>
    <tr><td>&nbsp;</td><tr>
   <tr align="center" >
	<td colspan="2"></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
		<td >
			<input type="submit" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" />
            <input type="hidden" name="idcontratos"  id="idcontratos" value=""/>
              <input type="hidden" name="nuevo"  id="nuevo" value=""/>
              <input type="hidden" name="enviar"  id="enviar" value="enviar"/>
              <input type="hidden" name="idreferencias"  id="idreferencias" />
              <input type="hidden" name="idcredito"  id="idcredito" />

         
        
       
               

               
         
			 <input type="Limpiar" value="" class="form-reset"   onclick="enviarRuta('<?php config::ruta()?>?accion=addReferencias','Desea cancelar la operacion actual?.');" />
		</td>
		
	</tr>
   </tfoot>
       
	
     

  
   
	</table>
    
  
   </fieldset>
     </form>
    </div>
</div>
</div>

 
<div class="clear"></div>
 
	
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