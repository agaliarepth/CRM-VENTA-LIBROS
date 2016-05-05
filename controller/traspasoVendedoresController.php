<?php
require_once("model/traspasosModel.php");
require_once("model/detalle_traspasosModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");

$t=new Traspasos();
$det=new detalleTraspaso();
$kv1=new kardexVendedor();
$v=new Vendedores();

$f=getdate();
$res=$t->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["consulta"])){

    $res=$t->listarTodosMes($_POST["mes"],$_POST["anio"]);


}

$res3=$v->listartodos();

if(isset($_GET["it"]) && isset($_GET["e"]) )
{
    $traspaso=$t->getId($_GET["it"]);
    if($traspaso["idrecibe"]!=$traspaso["idenvia"]&&$traspaso["estado"]=="Enviado") {
        $kv1->borrarRemisionPorVendedorTraspaso($traspaso["idrecibe"], $traspaso["idtraspasos"]);
        $kv1->actualizarEstadoRemitidoPorTraspaso($traspaso["idenvia"], $traspaso["idtraspasos"]);
        $t->updateEstado("ANULADO", $_GET["it"]);



    }
    if($traspaso["idrecibe"]!=$traspaso["idenvia"]&&$traspaso["estado"]=="Sin Enviar") {

        $t->updateEstado("ANULADO", $_GET["it"]);



    }


    //header("Location:" . config::ruta() . "?accion=traspasoVendedores");
}




if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="n")
{  

$res2=$det->getDetalle($_GET["id"]);
$res=$t->getId($_GET["id"]);
	  $cont=0;
if ($res["idenvia"] != $res["idrecibe"]) {
         foreach ($res2 as $v) {
           $f=0;
             $res3= $kv1->todasRemisionesPorCodigoFecha($v["cantidad"], $res["idenvia"], $v["codigo"], $res["fecha"]);

        for($i=0; $i<$v["cantidad"];$i++){

            $res4=$kv1->getId($res3[$f]["idkardexvendedor"]);
            $kv1->fecha_remision=$res4["fecha_remision"];
            $kv1->num_remision=$res4["num_remision"];
            $kv1->fecha_devolucion="";
            $kv1->num_devolucion="";
            $kv1->cod_libro=$res4["cod_libro"];
            $kv1->titulo_libro=$res4["titulo_libro"];
            $kv1->estado_libro="Remitido";
            $kv1->num_contrato="";
            $kv1->reg_ventas="";
            $kv1->nombres_cliente="";
            $kv1->vendedores_idVendedores=$res["idrecibe"];
            $kv1->idlibro=$res4["idlibro"];
            $kv1->idalmacenes=$res4["idalmacenes"];
            $kv1->tomo_libro=$res4["tomo_libro"];
            $kv1->idcontrato="";
            $kv1->cargo=0;
            $kv1->traspaso=0;
            $kv1->idtraspaso=$res["idtraspasos"];
            $kv1->insertar();
            $kv1->actualizarEstadoTraspasoVendedores($res["idenvia"],$res4["idkardexvendedor"],$v["codigo"],$res["idtraspasos"]);

            $f++;


        }
             $kv1->nuevo();



           }


           }
			   $t->updateEstado("Enviado",$res["idtraspasos"]);
			  header("Location:".config::ruta()."?accion=traspasoVendedores");
}

require_once("view/traspasoVendedores.php");


?>