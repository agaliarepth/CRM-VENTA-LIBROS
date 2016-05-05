<?php require_once("config.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?PHP echo  SUCURSAL;?></title>

<!--<link rel="stylesheet" type="text/css" href="<?php echo config::ruta();?>css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo config::ruta();?>css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery-ui.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery.dataTables.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet"  href="<?php echo config::ruta();?>css/default1.css" media="screen" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo config::ruta();?>css/font-awesome.css">
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/menu.css">
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/alertify.core.css" />
<link rel="stylesheet" type="text/css"href="<?php echo config::ruta();?>css/alertify.default.css" id="toggleCSS" />



<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/modal.js"></script>
<script type="text/javascript" src="<?php echo config::ruta();?>js/zebra_datepicker.js"></script>
<script src="<?php echo config::ruta();?>js/jquery-u-min.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/menu.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/alertify.min.js"></script>
<script>
	function reset () {
			$("#toggleCSS").attr("href", "<?php echo config::ruta();?>css/alertify.default.css");
			alertify.set({
				labels : {
					ok     : "positivo",
					cancel : "Cancelar"
				},
				delay : 5000,
				buttonReverse : false,
				buttonFocus   : "ok"
			});
		}
</script>


 <script>
              $(document).ready(function() {

				   $('#fecha').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab']

		 });
		  $('#fecha2').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab']

		 });
		  $('#fecha3').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab']

		 });


    $('#categorias-table').dataTable( {
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
		 "iDisplayLength": -1,
		"aLengthMenu": [[25,50,100,300,500,1000,-1], [25, 50, 100,300,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"

    } );

} );
		</script>



</head>
<body>
<div id="wrap">
 <div style="background-color:#50BBDA;width:100%;color:#FFF; font-size:18px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-weight:bold; margin:0; text-align:center ">
    <?php echo SUCURSAL;?>

    </div>
	<header>

		<div class="inner relative">
			<a class="logo" href=""><img src="<?php echo config::ruta();?>images/shared/logo.png" alt="PanamericanBooks" width="100" height="40"></a>
			<a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a>
			<nav id="navigation">
				<ul id="main-menu">


					 <?php if(isset($_SESSION["modulo_catalogo"])){?>
					<li class="parent">
						<a href="<?php echo config::ruta();?>?accion=libros"><img src="<?php echo config::ruta();?>images/iconos/libros.png" height="17" width="17"/> CATALOGO</a>
						<ul class="sub-menu">
							<li><a href="<?php echo config::ruta();?>?accion=libros"><i class="icon-book"></i> LIBROS</a></li>
                            <li><a href="<?php echo config::ruta();?>?accion=librosResumido"><i class="icon-tasks"></i> VISTA RESUMIDA</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=categorias"><i class="icon-bookmark"></i> CATEGORIAS</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=editoriales"><i class="icon-share"></i> EDITORIALES</a></li>

						</ul>
					</li>
                    <?php }?>


                     <?php if(isset($_SESSION["modulo_vendedores"])){?>
					<li class="parent">
						<a href="<?php echo config::ruta();?>?accion=vendedores"><img src="<?php echo config::ruta();?>images/iconos/vendedores.png" height="17" width="17"/> VENDEDORES</a>
						<ul class="sub-menu">
							<li><a href="<?php echo config::ruta();?>?accion=vendedores"><i class="icon-user"></i> LISTA DE VENDEDORES</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=addVendedores"><i class="icon-plus"></i> NUEVO VENDEDOR</a></li>


						</ul>
					</li>
                    <?php }?>


                    	 <?php if(isset($_SESSION["modulo_almacenes"])){?>
					<li class="parent">
						<a href="<?php echo config::ruta();?>?accion=almacenes"><img src="<?php echo config::ruta();?>images/iconos/inventario.png" height="17" width="17"/>  ALMACENES</a>
						<ul class="sub-menu">
							<li><a href="<?php echo config::ruta();?>?accion=notasRequerimiento"><i class="icon-credit-card"></i> N.REQUERIMIENTO</a></li>
							<li><a class="parent"  href="<?php echo config::ruta();?>?accion=notasRemision"><i class="icon-credit-card"></i> N.REMISION</a>
                            <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=relacionNotasRemision">RELACION N.REMISION</a></li>

								</ul>
                            </li>
							<li><a class="parent" href="<?php echo config::ruta();?>?accion=notasDevolucion"><i class="icon-credit-card"></i> N.DEVOLUCION</a>
                             <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=relacionNotasDevolucion">RELACION N.DEVOLUCION</a></li>

								</ul>


                            </li>
							<li><a   class="parent" href="<?php echo config::ruta();?>?accion=notasIngreso"><i class="icon-credit-card"></i> N.INGRESO</a>

                             <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=reporteIngreso">RELACION N.INGRESO</a></li>

								</ul>
                            </li>
							<li><a class="parent" href="<?php echo config::ruta();?>?accion=notasEgreso"><i class="icon-credit-card"></i> N.EGRESO</a>
                             <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=reporteEgreso">RELACION N.EGRESO</a></li>

								</ul>

                            </li>
                            <li>
								<a class="parent" href="#"><i class="icon-credit-card"></i> N.TRASPASOS</a>
								<ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=traspasoVendedores">TRASPASO VENDEDORES</a></li>
									<li><a href="<?php echo config::ruta();?>?accion=traspasoAlmacen">TRASPASO ALMACENES</a></li>

								</ul>
							</li>
                             <li>
                             <a class="parent" href="#"><i class="icon-credit-card"></i>  DEVOLUCION / CAMBIO OBRAS</a>

                             <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=devolucionObras"> DEVOLUCION VENTAS</a></li>
									<li><a href="<?php echo config::ruta();?>?accion=cambioObrasAlmacen">CAMBIO OBRAS COBRANZA</a></li>

								</ul>
							</li>

							<li>
                                <a class="parent"  href="<?php echo config::ruta();?>?accion=kardexVendedor"><i class="icon-folder-open-alt"></i> KARDEX VENDEDOR</a>

                                <ul class="sub-menu">
                                    <li><a  href="<?php echo config::ruta();?>?accion=gestionCargos"> GESTION DE CARGOS</a></li>

                                </ul>
                            </li>



                      <li><a   class="parent" href="<?php echo config::ruta();?>?accion=notasIngreso"><i class="icon-credit-card"></i> REPORTES</a>

                             <ul class="sub-menu">
                               <li><a  href="<?php echo config::ruta();?>?accion=almacenes"><i class="icon-file"></i> STOCK INVENTARIO</a></li>
										<li><a  href="<?php echo config::ruta();?>?accion=kardexMayor"><i class="icon-suitcase"></i> KARDEX MAYOR</a></li>
                                        <li><a  href="<?php echo config::ruta();?>?accion=movimientoItems"><i class="icon-suitcase"></i> MOVIMIENTO ITEMS</a></li>
                                        <li><a  href="<?php echo config::ruta();?>?accion=movimientoVendedor"><i class="icon-suitcase"></i> MOVIMIENTO VENDEDOR</a></li>

								</ul>
                            </li>
						</ul>
					</li>
                    <?php }?>


                     <?php if(isset($_SESSION["modulo_ventas"])){?>
					<li class="parent">
						<a href="#"><img src="<?php echo config::ruta();?>images/iconos/compras.gif" height="17" width="17"/> VENTAS</a>
						<ul class="sub-menu">
							<li><a href="<?php echo config::ruta();?>?accion=contratos"><i class="icon-shopping-cart"></i> CONTRATOS DIFERIDOS</a></li>

							<li><a  href="<?php echo config::ruta();?>?accion=contratoVenta"><i class="icon-shopping-cart"></i> CONTRATOS VENTA</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=contratosBaja"><i class="icon-m"></i> CONTRATOS BAJA</a></li>

                            <li><a href="<?php echo config::ruta();?>?accion=devolucionVentas"><i class="icon-arrow-down"></i>DEVOLUCION OBRAS</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=contratosAnulados"><i class="icon-lock"></i> CONTRATOS ANULADOS</a></li>
                            	<!--<li><a  href="<?php echo config::ruta();?>?accion=ventas"><i class="icon-credit-card"></i> REPORTES</a></li>-->

                           <li><a class="parent"  href="#"><i class="icon-calendar"></i>AGENDA</a>
                            <ul class="sub-menu">
                            <li><a  href="<?php echo config::ruta();?>?accion=cuotasIniciales"><i class="icon-money"></i>COBRO CUOTAS </a></li>
                            </ul>
                           </li>
                                <li><a class="parent"  href="#"><i class="icon-tasks"></i> REPORTES</a>
                            <ul class="sub-menu">
                            <li><a  href="<?php echo config::ruta();?>?accion=Ventas">PLANILLA PRODUCCION</a></li>
									<li><a  href="<?php echo config::ruta();?>?accion=produccionDiariaVentas">PRODUCCION DIARIA</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=produccionOrganizacion">CUADRO DE PRODUCCION DE VENTAS</a></li>
                            <li><a  href="<?php echo config::ruta();?>?accion=produccionMensualVentas">PRODUCCION POR ORGANIZACION</a></li>
                             <li><a   href="<?php echo config::ruta();?>?accion=comportamientoVentas">COMPORTAMIENTO DE VENTAS</a></li>

                            <li><a   href="<?php echo config::ruta();?>?accion=relacionObrasVendidas">RELACION OBRAS VENDIDAS</a></li>

								</ul>
                            </li>
                          <li><a   href="<?php echo config::ruta();?>?accion=reportePagosCuotaInicial">RECIBOS / FACTURAS</a></li>


						</ul>
					</li>
                    <?php }?>



                     <?php if(isset($_SESSION["modulo_cobranzas"])){?>
					<li class="parent">

						<a href="<?php echo config::ruta();?>?accion=cobranzas"> <img src="<?php echo config::ruta();?>images/iconos/pagar.png" height="17" width="17"/> COBRANZAS</a>
						<ul class="sub-menu">


                          <li><a  class="parent" href="<?php echo config::ruta();?>?accion=cuentas"><i class="icon-suitcase"></i>CUENTAS</a>

                            <ul class="sub-menu">
									<li><a  href="<?php echo config::ruta();?>?accion=crearCuenta">NUEVA CUENTA</a></li>

								</ul>


                            </li>
                            	<!--<li><a  href="<?php echo config::ruta();?>?accion=contratosFacturados"><i class="icon-credit-card"></i> CONTRATOS FACTURADOS</a></li>!-->
                                                      <li><a href="<?php echo config::ruta();?>?accion=addReferencias"><i class="icon-list"></i> REFERENCIAS DE CONTRATOS</a></li>

							<li><a href="<?php echo config::ruta();?>?accion=cobradores"><i class="icon-user"></i> COBRADORES</a></li>



							<li class="parent"><a  href="<?php echo config::ruta();?>?accion=listaPagos"><i class="icon-list"></i> PAGOS</a>
                    <ul class="sub-menu">
											<li>
												<a  href="<?php echo config::ruta();?>?accion=listaPagos"><i class="icon-list"></i>LISTAR PAGOS</a></li>
											</li>
                    	<li>
                    		<a  href="<?php echo config::ruta();?>?accion=addPago"><i class="icon-plus"></i>REGISTRAR PAGOS</a></li>
                    	</li>
												<li><a  href="<?php echo config::ruta();?>?accion=cuotas"><i class="icon-credit-card"></i> PLAN DE PAGOS</a></li>
                    </ul>

							</li>


							<li><a  href="<?php echo config::ruta();?>?accion=devolucionVentasCobranza"><i class="icon-arrow-down"></i> DEVOLUCION COBRANZA</a></li>
                            <li><a  href="<?php echo config::ruta();?>?accion=listarCambioObras"><i class="icon-refresh"></i> CAMBIO DE OBRAS</a></li>
                            <li><a  href="<?php echo config::ruta();?>?accion=refinanciamiento"><i class="icon-money"></i> REFINANCIAMIENTO</a></li>

						   <li><a  class="parent" href="<?php echo config::ruta();?>?accion=cuentas"><i class="icon-suitcase"></i>REPORTES</a>

                            <ul class="sub-menu" style="">
                                <li><a  href="<?php echo config::ruta();?>?accion=relacionCuentasNuevas"></i> RELACION CUENTAS NUEVAS</a></li>
								<li><a  href="<?php echo config::ruta();?>?accion=asignaciones"> ASIGNACIONES</a></li>
                                <li><a href="<?php echo config::ruta();?>?accion=produccion">PRODUCCION</a></li>
                                <li><a href="<?php echo config::ruta();?>?accion=relacionDevolucionCobranza">RELACION DE DEVOLUCIONES</a></li>
                                <li><a href="<?php echo config::ruta();?>?accion=relacionCambioObra">RELACION DE CAMBIO DE OBRA</a></li>

								</ul>


                            </li>
						</ul>
					</li>
                    <?php }?>
					<?php if(isset($_SESSION["modulo_administracion"])){?>
					<li class="parent">
						<a href="<?php echo config::ruta();?>?accion=admin"><img src="<?php echo config::ruta();?>images/iconos/user.png" height="17" width="17"/>ADMINISTRACION</a>
						<ul class="sub-menu">
							<li><a href="<?php echo config::ruta();?>?accion=usuarios"><i class="icon-user"></i> USUARIOS</a></li>
							<!--<li><a  href="<?php echo config::ruta();?>?accion=usuariosVendedor"><i class="icon-credit-card"></i> USUARIOS VENDEDORES</a></li>-->

                            <li><a  href="<?php echo config::ruta();?>?accion=cierres"><i class="icon-credit-card"></i> CIERRE / APERTURAS</a></li>
                            <!--<li><a  href="<?php echo config::ruta();?>?accion=pasarCargos"><i class="icon-credit-card"></i> PASAR CARGOS</a></li>-->

                                                        <li><a href="<?php echo config::ruta();?>?accion=VentasAdmin"><i class="icon-shopping-cart"></i> CORRECCION DE CONTRATOS</a></li>


                            <li><a href="<?php echo config::ruta();?>?accion=almacenAdmin"><i class="icon-truck"></i>ALMACENES</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=roles"><i class="icon-reorder"></i> ROLES DE USUARIO</a></li>
                            	<!--<li><a  href="<?php echo config::ruta();?>?accion=comisionContratos"><i class="icon-tasks"></i> COMISIONES DE CONTRATO</a></li>-->
                            <!--<li><a href="<?php echo config::ruta();?>?accion=devolucionObrasAdmin"><i class="icon-arrow-down"></i>DEVOLUCION CONTRATO</a></li>-->
							<li><a  href="<?php echo config::ruta();?>?accion=deudores"><i class="icon-hand-down"></i> CENTRAL DE RIESGO</a></li>

							<li><a class="parent"  href="#"><i class="icon-tasks"></i> BASE DE DATOS</a>
                            <ul class="sub-menu">
                            <li><a  href="<?php echo config::ruta();?>?accion=respaldarDb"><i class="icon-reorder"></i>RESPALDAR </a></li>
									<li><a  href="<?php echo config::ruta();?>?accion=restaurarDb"><i class="icon-reorder"></i>RESTAURAR</a></li>

								</ul>
                            </li>

						</ul>
					</li>
                    <?php }?>
                    <li class="parent">
						<a href="<?php echo config::ruta();?>?accion=admin"><img src="<?php echo config::ruta();?>images/iconos/text_page.png" height="17" width="17"/>REGISTROS</a>
						<ul class="sub-menu">
                        							<li><a href="<?php echo config::ruta();?>?accion=registroCatalogo"><i class="icon-book"></i> CATALOGO</a></li>

							<li><a href="<?php echo config::ruta();?>?accion=registroInventario"><i class="icon-reorder"></i> INVENTARIO</a></li>
							<li><a  href="<?php echo config::ruta();?>?accion=registroKardexVendedor"><i class="icon-credit-card"></i> KARDEX VENDEDORES</a></li>
                            <li><a  href="<?php echo config::ruta();?>?accion=registroContratos"><i class="icon-credit-card"></i> CONTRATOS</a></li>



						</ul>
					</li>
					<li><a href="<?php echo config::ruta();?>?accion=logout"> <img src="<?php echo config::ruta();?>images/iconos/salir.png" height="17" width="17"/> SALIR</a></li>
				</ul>
			</nav>
			<div >
            </div>
		</div>
	</header>

</div>

<!-- Start: page-top-outer -->

<!-- End: page-top-outer -->

<div class="clear">&nbsp;</div>

<!--  start nav-outer-repeat................................................................................................. START -->
