<?php
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");


$kv=new kardexVendedor();
$v=new Vendedores();


if(isset($_GET["iv"])&&($_GET["iv"]!="")){
    $f=date_parse($_GET["fecha"]);
    $mes=$f["month"];
    $anio=$f["year"];
    $res=$kv->todosCargosMes($_GET["iv"],$mes,$anio);
    $nombres= $v->getNombresVendedor($_GET["iv"]);

    require_once("view/verResumenCargosMes.php");

}
if(isset($_POST['cargos'])){

    $res=$kv->todosCargosMes($_POST["id"],$_POST["mes"],$_POST["anio"]);
    $nombres= $v->getNombresVendedor($_POST["id"]);
    $mes=$_POST["mes"];
    $anio=$_POST["anio"];
    require_once("view/verResumenCargosMes.php");

}



?>