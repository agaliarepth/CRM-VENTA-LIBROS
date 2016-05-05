// JavaScript Document


// FUNCIONES PARA alertify

function mensaje(texto,tipo){
	
	
	switch(tipo){
		
		case 'warning':{alertify.alert("<img src='./images/iconos/warning.png'/>"+texto); break;}
		case 'error':{alertify.alert("<img src='./images/iconos/delete.png'/>"+texto); break;}
		case 'info':{alertify.alert("<img src='./images/iconos/info.png'/>"+texto); break;}
		}
		
	}
	
	function confirmForm(form,texto){
		
		alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/info.png'/>"+texto,function (e) {
				if (e) {
					form.submit();
				} else {
					alertify.error(" OPERACION CANCELADA");
				}
		});
		
		}
		
		function enviarRuta(ruta,texto){
		
		alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/help.png'/>"+texto,function (e) {
				if (e) {
					window.location=ruta;
				} else {
					alertify.error(" OPERACION CANCELADA");
				}
		});
		
		}
function ejecutarAccion(texto,id){

alertify.set({ labels: { ok: "Si", cancel: "No" } });
alertify.confirm("<img src='./images/iconos/warning.png'/>"+texto,function (e) {
if(e){

    $.ajax({
        url:"ajax/borrarDetalleContrato.php",
        type:"GET",
        dataType:"json",
        data:{idcontrato:id},
        success:function(res) {
           if(res==1) limpiar();
            else alert("no se pudo");
                             }
        });

    }


});

}

		
		function eliminarRegistro(ruta,texto){
		
		alertify.set({ labels: { ok: "Si", cancel: "No" } });
		alertify.confirm("<img src='./images/iconos/nulo.gif'/>"+texto,function (e) {
				if (e) {
					window.location=ruta;
					
				} else {
					alertify.error(" OPERACION CANCELADA");
				}
		});
		
		}
//*************************
function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  
var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write(ficha.innerHTML);
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
  return false;
} 

function eliminar(ruta){
	
	if(confirm("Realmente desea Eliminar este Registro..?")){
		window.location=ruta;
		
		}
	
	}
	function confirmarVentaContado(ruta){
		if(confirm("SE CONFIRMA  LA VENTA AL CONTADO..?")){
		window.location=ruta;
		
		}
		
		}
	
	function anular(ruta){
	
	if(confirm("REALMENTE DESEA ANULAR ESTA NOTA..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarAlmacen(ruta){
	
	if(confirm("Se enviara La nota  de Devolucion de Obra al Almacen. Desea continuar la Operacion..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarAlmacenCambioObra(ruta){
	
	if(confirm("Se enviara cambio de Obra  al Almacen. Desea continuar la Operacion..?")){
		window.location=ruta;
		
		}
	
	}
	
	function devolver(ruta){
	
	if(confirm("Se actualizara el inventario con las cantidades de la Nota desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	function enviarIngreso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Ingreso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	function enviarRequerimiento(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Requerimiento desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	
	function enviarDevolucion(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Devolucion desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
		function bajaContrato(ruta){
	
	if(confirm("Se  dara de baja el contrato.. desea Continuar?")){
		window.location=ruta;
		
		}
	
	}
	
	
	function enviarTraspaso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Traspaso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function aprobarDevolucionObra(ruta){
	
	if(confirm("SE hara Efectivo LA Nota de Devolucion en El kardex Del Vendedor desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}

	function aprobarDevolucionIngreso(ruta){
	
	if(confirm("SE hara Efectivo La Nota de Ingreso en El Almacen  desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}	
	function crearCuenta(ruta,num,cod){
	
	if(confirm("Se Creara Una Cuenta Para el contrato::"+num+" con Cod Cliente::"+cod+" Desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function rechazarDevolucionObra(ruta){
	
	if(confirm("Se anula el proceso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	function enviarContrato(ruta){
	
	if(confirm("Se Registrara El Contrato como Diferido.. desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarPago(ruta,cuenta){
	
	if(confirm("Se Registrara El Pago PAra La cuenta::"+cuenta+"..Desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarEgreso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Egreso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function imprimir(ruta){
	
	open(ruta,'','top=50,left=300,scrollbars=yes,width=700,height=550') ; 
		
	
	
	}
		function addRemision(ruta){
	
	open(ruta,'','top=50,left=100,scrollbars=yes,width=850,height=550,menubar=si') ; 
		
	
	
	}
	function tipoCambio(ruta){
	
	open(ruta,'','top=180,left=400,width=400,height=250,menubar=no') ; 
		
	
	
	}
	function popup(ruta,alto,ancho){
	
	
	open(ruta,'',"top=50,scrollbars=yes,left=300,width=800,height=500") ; 
		
	
	
	}
	
	function limpiar(){
		
		document.form.reset();
		
		}
		
			
		
		 
  /*  $(function() { 
	var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
	$(".bEnviar").click(function(){  
		$(".error").fadeOut().remove();
		
        if ($(".codigo").val() == "") {  
			$(".codigo").focus().after('<span class="error">Ingrese su codigo</span>');
			return false;  
		}  
		
		
        if ($(".email").val() == "" || !emailreg.test($(".email").val())) {
			$(".email").focus().after('<span class="error">Ingrese un email correcto</span>');  
			return false;  
		}  
        if ($(".asunto").val() == "") {  
			$(".asunto").focus().after('<span class="error">Ingrese un asunto</span>');  
			return false;  
		}  
        if ($(".mensaje").val() == "") {  
			$(".mensaje").focus().after('<span class="error">Ingrese un mensaje</span>');   
			return false;  
		}  
    });  
	$(".nombre, .asunto, .mensaje").bind('blur keyup', function(){  
        if ($(this).val() != "") {  			
			$('.error').fadeOut();
			return false;  
		}  
	});	
	$(".email").bind('blur keyup', function(){  
        if ($(".email").val() != "" && emailreg.test($(".email").val())) {	
			$('.error').fadeOut();  
			return false;  
		}  
	});
});
 */