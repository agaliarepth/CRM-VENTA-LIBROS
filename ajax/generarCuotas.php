<?php

require_once("../helpers/conexion.php");
require_once("../helpers/Helpers.php");


function generar() {
    global $db;

    $sql ="SELECT idcredito,saldo,numcuotas,montocuotas,fechadoc FROM credito WHERE saldo >0 AND  numcuenta!=0 AND idcredito BETWEEN 501 AND  1000";
    $res=$db->query($sql)->fetchAll();
   // print_r($res);
foreach( $res as $r) {
    generarcuotas($r["fechadoc"],$r["numcuotas"],$r["saldo"],$r["idcredito"]);




}
}

function generarcuotas($fd,$nc,$s,$id){

    global $db;
    $array_cuotas = Helpers::planPagos($fd, 0, $nc * 30, $nc, $s);

     $sql="INSERT INTO CUOTAS (monto,fechavencimiento,numcuota,estado,sw,credito_idcredito) VALUES";
    foreach ($array_cuotas as $r) {

          $sql.="(".$r["monto"].",'".$r["fecha"]."',"."'".$r["numcuota"]."'".","."1".","."1".",".$id."),";
    }



    $sql=substr($sql, 0, -1);
    $result=$db->query($sql);
}


generar();
?>