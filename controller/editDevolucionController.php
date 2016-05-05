
<?php
require_once("model/vendedoresModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/almacenesModel.php");
require_once("model/kardexVendedorModel.php");
$ve=new Vendedores();
$dev=new Devolucion();
$li=new Libros();
$la=new librosAlmacenes();
$kv=new kardexVendedor();
$al=new Almacen();
$det=new detalleDevolucion();

$res2=$al->autocompletar();



if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
    $de=new detalleDevolucion();
    $de->borrarPorNotaDevolucion($_POST["iddevolucion"]);

    unset($de);
    $dev->nombre_vendedor=$_POST["nombre_vendedor"];
    $dev->almacen=$_POST["desc_almacen"];
    $dev->fecha=$_POST["fecha"];
    $dev->cant_total=$_POST["cant_total"];
    $dev->estado="Sin Enviar";
    $dev->vendedores_idVendedores=$_POST["id_vendedor"];
    $dev->idalmacenes=$_POST["id_almacenes"];
    $dev->idusuarios=$_SESSION["ses_id"];
    $dev->nombres_usuarios=$_SESSION["nombres"];
    $dev->cargo_usuarios=$_SESSION["cargo"];
    $dev->obs=$_POST["obs1"];
    $dev->terminado=0;
    $dev->actualizar($_POST["iddevolucion"]);
    $lastID=$_POST["iddevolucion"];
    $fecha=$dev->getFecha($lastID);

    for($i=0; $i<$_POST["num_filas"];$i++){

        $de=new detalleDevolucion();
        $de->cantidad=$_POST["cantidad"][$i];
        $de->codigo=$_POST["codigo"][$i];
        $de->titulo=$_POST["titulo"][$i];
        $de->volumen=$_POST["tomo"][$i];
        $de->obs=$_POST["obs"][$i];
        $de->libros_idlibros=$_POST["idlibro"][$i];
        $de->devolucion_iddevolucion=$lastID;
        $de->nuevo();
        unset($de);
    }

    header("Location:".config::ruta()."?accion=notasDevolucion");

}




if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="s" ){

    $res4=$dev->getId($_GET["id"]);
    $res3=$det->getDetalle($_GET["id"]);


    require_once("view/editDevolucion.php");


}







?>