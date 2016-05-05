<?php
require_once("model/contratosModel.php");
require_once("model/PagosModel.php");
require_once("model/vendedoresModel.php");
require_once("model/cobradoresModel.php");
require_once("model/creditoModel.php");



$ven=new Vendedores();
$cobra=new Cobrador();
$credito=new Credito();

$p=new Pago();

$f=getdate();
$res =$credito->getCuentasMes($f["mon"], $f["year"]);
if(isset($_POST["consulta"])){
    if($_POST["filtro"]=="MES") {
        $res = $credito->getCuentasMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
        $res = $credito->listarCuentasRango($_POST["fechainicio"],$_POST["fechafin"]);
    }
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $credito->listarCuentasRango("2013-01-01",$_POST["fechaacumulado"]);

    }
}

require_once("view/relacionCuentasNuevas.php");




?>