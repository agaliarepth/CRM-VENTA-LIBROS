<?php
require_once("model/vendedoresModel.php");
require_once("model/traspasosModel.php");
require_once("model/detalle_traspasosModel.php");
$ve=new Vendedores();
$dev=new Traspasos();




if(isset($_GET["e"])&&$_GET["e"]=="s"){
    $res4=$ve->listartodos();
    $dev=new Traspasos();
    $det=new detalleTraspaso();
    $res2=$dev->getId($_GET["id"]);
    $res3=$det->getDetalle($res2["idtraspasos"]);
    require_once("view/editTraspaso.php");

}



if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
    $cad=explode("||",$_POST["recibeVendedor"]);
    $de=new detalleTraspaso();
    $de->borrarPorTraspaso($_POST["idtraspaso"]);

    unset($de);

    $dev->fecha=$_POST["fecha"];
    $dev->cantidad_total=$_POST["cant_total"];
    $dev->envia=$_POST["envia"];
    $dev->recibe=strtoupper($cad[1]);

    $dev->idusuarios=$_SESSION["ses_id"];
    $dev->nombre_usuarios=$_SESSION["nombres"];
    $dev->cargo_usuarios=$_SESSION["cargo"];
    $dev->obs=$_POST["obs2"];
    $dev->terminado=0;
    $dev->estado="Sin Enviar";
    $dev->idenvia=$_POST["idenvia"];
    $dev->idrecibe=$cad[0];
    $dev->actualizar($_POST["idtraspaso"]);


    $lastID=$_POST["idtraspaso"];

    for($i=0; $i<$_POST["num_filas"];$i++){

        $de=new detalleTraspaso();
        $de->cantidad=$_POST["cantidad"][$i];
        $de->codigo=$_POST["codigo"][$i];
        $de->titulo=$_POST["titulo"][$i];
        $de->volumen=$_POST["tomo"][$i];
        $de->obs=$_POST["obs"][$i];
        $de->libros_idlibros=$_POST["idlibro"][$i];
        $de->traspasos_idtraspasos=$lastID;
        $de->insertar();
        unset($de);

    }
    $de=new detalleTraspaso();
    $de->nuevo();
    unset($de);
    header("Location:".config::ruta()."?accion=verTraspaso&id=".$lastID);


}

?>