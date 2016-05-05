<?php
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/comisionesContratoModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");
$cc=new comisionesContrato();
$res3=$cc->listarTodos();
$ve=new Vendedores();
$kv1=new kardexVendedor();
$li=new Libros();
$la=new librosAlmacenes();
 $det=new detalleContrato();
$c=new Contrato();
$credito=new Credito();
$contado=new Contado();

if(isset($_POST["ienviar"])&&isset($_POST["id_vendedor"])&&isset($_POST["id_supervisor"])){

$nombre_vendedor=$_POST["vendedor"];
$idvendedor=$_POST["id_vendedor"];
$supervisor=$_POST["id_supervisor"];
$nombre_supervisor=$_POST["supervisor"];
$comisiones=$ve-> getComisiones($_POST["id_vendedor"]);

require_once("view/addContrato.php");

}


if(isset($_POST["nuevoContrato"])&&$_POST["nuevoContrato"]=="nuevoContrato" && $_POST["num_filas"]>0){
	
	
	$c->numcontrato=$_POST["numcontrato"];
	$c->tipocontrato="DIFERIDO";
	$c->fechacontrato=$_POST["fecha_contrato"];
	$c->localidad=strtoupper($_POST["localidad"]);
	$c->preciototal=$_POST["monto_total"];
	$c->tipoventa=$_POST["tipoventa"];
	$c->idvendedor=$_POST["idvendedor"];
	$c->idchofer=$_POST["idchofer"];
	$c->nombres=strtoupper($_POST["nombres"]);
	$c->apellidopaterno=strtoupper($_POST["apellidopaterno"]);
	$c->apellidomaterno=strtoupper($_POST["apellidomaterno"]);
	$c->ci=$_POST["carnet"];
	$c->terminado=0;
	$c->nuevo();
    $lastID=Contrato::$lastId;
	
	if($_POST["tipoventa"]=="CREDITO"){
	  $credito->cuotainicial=$_POST["cuota_inicial"]; 	
	  $credito->numcuotas=$_POST["num_pagos"]; 	
	  $credito->montocuotas=$_POST["monto_pagos"]; 	
	  
	  if($_POST["tipocomisioncredito"]=="P"){
	  $credito->montocomision=($_POST["comisioncontrato1"]*$_POST["valorcomisionable1"])/100;	
	  $credito->porcentajecomision=$_POST["comisioncontrato1"];
	  }
	  if($_POST["tipocomisioncredito"]=="M"){
	  $credito->montocomision=($_POST["comisioncontrato1"]);	
	  $credito->porcentajecomision=($_POST["comisioncontrato1"]/$_POST["valorcomisionable1"])*100;
	  }
	  
	  $credito->saldo=$_POST["saldo"]; 	
	  $credito->saldocuota=$_POST["cuota_inicial"]; 	
	  $credito->idcobrador=$_POST["idcobrador"];
	  $credito->numreporte=""; 	
	  $credito->valorcomisionable=$_POST["valorcomisionable1"];
  	  $credito->fechacobranza=$_POST["fechacobranza"];
	  $credito->contratos_idcontratos= $lastID;
      $credito->cuentacomision=$_POST["cuentacomision1"];
	  $credito->nuevo();
		
		}
	
	if($_POST["tipoventa"]=="CONTADO"){
		
	  $credito->cuotainicial=$_POST["montocancelado"];
	  $credito->numcuotas=1;	
	  $credito->montocuotas=$_POST["monto_pagos"];
	  	
	  if($_POST["tipocomisioncontado"]=="P"){
	  $credito->montocomision=($_POST["comisioncontrato"]*$_POST["valorcomisionable1"])/100;	
	  $credito->porcentajecomision=$_POST["comisioncontrato"];
	  }
	  if($_POST["tipocomisioncontado"]=="M"){
	  $credito->montocomision=($_POST["comisioncontrato"]);	
	  $credito->porcentajecomision=($_POST["comisioncontrato"]/$_POST["valorcomisionable1"])*100;
	  }
	  $credito->saldo=$_POST["saldocontado"];
	  $credito->saldocuota=0; 	
	  $credito->idcobrador=0;
	  $credito->numreporte=""; 	
	  $credito->valorcomisionable=$_POST["valorcomisionable"];
	  $credito->contratos_idcontratos=$lastID;
      $credito->cuentacomision=$_POST["cuentacomision"];

        $credito->nuevo();
		}
	
	
	
	$nombreCompleto="".strtoupper($_POST["nombres"])." ".strtoupper($_POST["apellidopaterno"])." ".strtoupper($_POST["apellidomaterno"]);
	$cont=0;
	 $de=new detalleContrato();
	 
	 
	for($i=0; $i<$_POST["num_filas"];$i++){
		 
        if($_POST["cantidad"][$i]>1){

           /* $f=date_parse($_POST["fecha_contrato"]);
            $mes=$f["month"];
            $anio=$f["year"];
		    $list_remi=$kv1->buscarCargosVendedorLibroMes($_POST["idchofer"],$_POST["codigo"][$i],$_POST["cantidad"][$i],$mes,$anio);
		
			 
			 foreach($list_remi as $v){*/
			 
	     $de->cantidad=$_POST["cantidad"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->idkardex=$_POST["idkardex"][$i];
		 $de->sw=1;
		 $de->contratos_idcontratos=$lastID;
		 $de->nuevo(); 
			 //}
			 
		}
	
		else{
		
			 
	     $de->cantidad=1;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->idkardex=$_POST["idkardex"][$i];
		 $de->sw=1;
		 $de->contratos_idcontratos=$lastID;
		 $de->nuevo(); 
			
			
		
		  }
		  
	}
	unset($de);
		  
		 
header("Location:".config::ruta()."?accion=contratos");

}





 if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n" ) {

     $cont = 0;
     $res2 = $det->getDetalle($_GET["id"]);
     $res = $c->getIdKardex($_GET["id"]);
     $nombreCompleto = "" . strtoupper($res["nombres"]) . " " . strtoupper($res["apellidopaterno"]) . " " . strtoupper($res["apellidomaterno"]);

     if ($res["idvendedor"] != $res["idchofer"]) {
         foreach ($res2 as $v) {
           $f=0;
             $res3= $kv1->todasRemisionesPorCodigoFecha($v["cantidad"], $res["idchofer"], $v["codigo"], $res["fechacontrato"]);

        for($i=0; $i<$v["cantidad"];$i++){

            $res4=$kv1->getFilaContrato($res3[$f]["idkardexvendedor"]);
            $kv1->fecha_remision=$res4["fecha_remision"];
            $kv1->num_remision=$res4["num_remision"];
            $kv1->fecha_devolucion="";
            $kv1->num_devolucion="";
            $kv1->cod_libro=$res4["cod_libro"];
            $kv1->titulo_libro=$res4["titulo_libro"];
            $kv1->estado_libro="Diferido";
            $kv1->num_contrato=$res["numcontrato"];
            $kv1->reg_ventas="";
            $kv1->nombres_cliente=$nombreCompleto;
            $kv1->vendedores_idVendedores=$res["idvendedor"];
            $kv1->idlibro=$res4["idlibro"];
            $kv1->idalmacenes=$res4["idalmacenes"];
            $kv1->tomo_libro=$res4["tomo_libro"];
            $kv1->idcontrato=$res["idcontratos"];
            $kv1->cargo=0;
            $kv1->traspaso=0;
            $kv1->insertar();
            $kv1->actualizarEstadoDiferidoTraspaso($res["idchofer"],$res4["idkardexvendedor"],$v["codigo"],$res["numcontrato"],$nombreCompleto, $res["idcontratos"]);
            $f++;


        }
             $kv1->nuevo();



           }


           }
          else{

               foreach($res2 as $v) {
                   $f = 0;
                   $res3 = $kv1->todasRemisionesPorCodigoFecha($v["cantidad"], $res["idchofer"], $v["codigo"], $res["fechacontrato"]);
                   for ($i = 0; $i < $v["cantidad"]; $i++) {
                       $res4= $kv1->getFilaContrato($res3[$f]["idkardexvendedor"]);

                       $kv1->actualizarEstadoDiferido($res4["idkardexvendedor"], $v["codigo"], $res["numcontrato"], $nombreCompleto, $res["idcontratos"]);
                  $f++;
                   }
               }

         }
       // $c->updateTerminado($res["idcontratos"],1);
       header("Location:".config::ruta()."?accion=verificarKardex&id=".$res["idcontratos"]);
        //header("Location:".config::ruta()."?accion=contratos&filtro=mes");


 }

?>
